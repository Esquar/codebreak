<?php
   /*
    * Compilador do cache estrutural do CodeBreakEngine
    *
    * Sua principal função é reunir as informações do DB (extendidas ou nao) em um objeto comum,
    * e expo-las de forma que possa ser acessado por todo o M e quem o acessa.
    */

    require_once('redis.php');

class compiler extends CI_Model {

   public $CacheDB;

   function __construct($cacheDbOpt=array())
   {
      try{
        
         //$this->CacheDB = new RedisCli("tcp", "127.0.0.1", 6379, CACHED_ENV_STRUCT);
        
      }catch(Exception $ex){
         die($ex.getMessage());
      }
   }

   public function DoCompile(){
      
      if(!$this->CacheDB->isConnected()){
         die("Impossivel se comunicar com o SchemaDigest");
      }

      //select as Schemas
      $query = $this->db
                     ->select('*')
                     ->from('"Sistema"."Aplicativo"')
                     ->order_by('"Ordem" ASC')
                     ->get();
      $schema = $query->result();

      //select as tabela
      $query = $this->db
                     ->select('*')
                     ->from('"Sistema"."Tabela"')
                     ->order_by('"Ordem" ASC')
                     ->get();

      $tabela = $query->result();

      //select os campos
      $query = $this->db
                     ->select('*')
                     ->from('"Sistema"."Campo"')                     
                     ->order_by('"Ordem" ASC')
                     ->get();
      $campo = $query->result();

      //select as FKs
      $query = $this->db
                    ->select('ch.*, 
                              app."Nome" as "AplicativoRefId_R",
                              tab."Nome" as "TabelaRefId_R",	
                              array(
                                 SELECT cam."Nome" 
                                 FROM
                                    unnest("CampoId") c,
                                    "Sistema"."Campo" cam
                                 WHERE
                                    cam."AplicativoId" = ch."AplicativoId" and
                                    cam."TabelaId"    = ch."TabelaId" and
                                    cam."Id" = c) as "CampoId_R",
                              array(
                                 SELECT cam."Nome" 
                                 FROM
                                    unnest("CampoRefId") c,
                                    "Sistema"."Campo" cam
                                 WHERE
                                    cam."AplicativoId" = ch."AplicativoRefId" and
                                    cam."TabelaId" = ch."TabelaRefId" and
                                    cam."Id" = c) as "CampoRefId_R"')
      					->from('"Sistema"."ChaveEstrangeira" ch')
                     ->join('"Sistema"."Aplicativo" app', ' app.Id = ch."AplicativoRefId" ', 'left')
                     ->join('"Sistema"."Tabela" tab', 'tab.AplicativoId = ch."AplicativoRefId" and tab."Id" = ch."TabelaRefId"', 'left')
      					->order_by('ch."AplicativoId" ASC, ch."TabelaId" ASC, ch."Id" ASC')
      					->get();
      $fk = $query->result();

      //select os índices do tipo primary key
      $query = $this->db
                     ->select('ind.*,
                              array(
                                 SELECT cam."Nome" 
                                 FROM
                                    unnest("CampoId") c,
                                    "Sistema"."Campo" cam
                                 WHERE
                                    cam."AplicativoId" = ind."AplicativoId" and
                                    cam."TabelaId"    = ind."TabelaId" and
                                    cam."Id" = c) as "CampoId_R",')
                     ->from('"Sistema"."Indice" ind')
                     ->where('ind."Tipo"', 'PrimaryKey')
                     ->order_by('ind."AplicativoId" ASC, ind."TabelaId" ASC, ind."Id" ASC')
                     ->get();

      $indice = $query->result();

      //select os usuários
      // não está sendo usado na compilação
      /*$query    = $this->db->get('"Sistema"."Usuario"');
      $usuario  = $query->result();*/

      //Seleciona as permissões dos Tipos de Usuários
      $query      = $this->db->get('"Sistema"."Permissao"');
      $permissao  = $query->result();

      //Realizo o drop de todas as Keys do banco 0, para garantir que nao fique algum dado
      // de compilações passadas

      $this->CacheDB->FlushDb();
      
      
      //esta variavel sera um snapshot do que conterá o Redis::db0
      $StructDigest = array();

      /*
       * @TODO: a partir daqui devo modificar a estrutura do arquivo.
       *        Aqui esta tudo castando para xml e eu preciso deixar como array/hash.
       *
       *       as chaves no Redis sao formadas pelo indice nominal do registro:
       *       Ex: [Aplicativo]/[Tabela]/[Campo]
       *            Sistema    / Campo  / Id
       */
       
      $idxAppData = array(); 
      foreach($schema as $sc){

         //guardo o nome da schema onde estou, pois ela será usada
         // para nomear todos os seus filhos
         $app = $sc->Nome;
         
         array_push($idxAppData, $app);
         
         //crio a chave no snapshot
         $StructDigest[$app] = array(
            'Id'        => $sc->Id,
            'Nome'      => $sc->Nome,
            'Descricao' => $sc->Descricao,
            'Ordem'     => $sc->Ordem);

         //insiro no CacheDb
         $this->CacheDB->Insert($app, $StructDigest[$app]);
         
         //Inicio a criação do array de indices tambem.
         $idxAppTableName = '[idx]'. $sc->Nome . '/Table';
         $idxAppTableData = null;
         $idxAppTableData = array();

         // tabela é filha do aplicativo, entao o foreach fica dentro
         if(!empty($tabela)){
            foreach($tabela as $tb){

               # verificando se houve alguma busca com sucesso
               # Caso contrário, a iteração vai botar todas as tabelas para todos os aplicativos
               if($sc->Id == $tb->AplicativoId){
                  
                  $tab = $app . '/' . $tb->Nome;
                  
                  $idxAppTabFieldName = '[idx]' . $tab . '/Fields';
                  $idxAppTabFieldData = array();
                  
                  array_push($idxAppTableData, $tab);
                  
                  $StructDigest[$tab] = array(
                     'AplicativoId' => $app,
                     'Id'           => $tb->Id,
                     'Nome'         => $tb->Nome,
                     'Descricao'    => $tb->Descricao,
                     'Ordem'        => $tb->Ordem,
                     'Visualizacao' => $tb->Visualizacao);

                  $this->CacheDB->Insert($tab, $StructDigest[$tab]);

                  // Campo é filho da tabela, então fica dentro
                  if(!empty($campo)){

                     foreach($campo as $cp){
                        
                        if($tb->AplicativoId == $cp->AplicativoId &&
                           $tb->Id           == $cp->TabelaId){
                           
                           $cam = $tab . '/' . $cp->Nome;
                           
                           array_push($idxAppTabFieldData, $cam);
                           
                           $arrCampo = array(

                              'AplicativoId' => $app,
                              'TabelaId'     => $tab,
                              'Id'           => $cp->Id,
                              'Nome'         => $cp->Nome,
                              'Descricao'    => $cp->Descricao,
                              'Ordem'        => $cp->Ordem,
                              'Default'      => $cp->Default,
                              'Descritor'    => $cp->Descritor,
                              'NotNull'      => $cp->NotNull,
                              'Exibicao'     => $cp->Exibicao,
                              'Tipo'         => $cp->Tipo,
                              'Handler'      => $cp->Handler
                           );

                           // Se o tipo do campo termina com []
                           // é um array
                           if(substr($cp->Tipo, -2) == '[]'){
                              $arrCampo['Array'] = '1';
                           }else{
                              $arrCampo['Array'] = '0';
                           }

                           $StructDigest[$cam] = $arrCampo;

                           $this->CacheDB->Insert($cam, $StructDigest[$cam]);

                        }
                     }
                     
                  }//Campo
                  
                  $StructDigest[$idxAppTabFieldName] = $idxAppTabFieldData;
                  
                  $this->CacheDB->Insert($idxAppTabFieldName, $StructDigest[$idxAppTabFieldName]);                 
                  

                  
                  // ChaveEstrangeira é filha da tabela, então fica dentro
                  if(!empty($fk)){
                     
                     $idxAppTabFkToMeName = '[idx]' . $tab . '/FKToMe';
                     $idxAppTabFkToMeData = array();
                     
                     $idxAppTabFkToOtherName = '[idx]' . $tab . '/FKToOther';
                     $idxAppTabFkToOtherData = array();
                     

                     foreach($fk as $fkey){

                        // monta aquelas fks que apontam para mim, e não para onde eu aponto.
                        if($tb->AplicativoId == $fkey->AplicativoRefId &&
                           $tb->Id           == $fkey->TabelaRefId){
                              
                           $cha = $tab . '/Fk_ToMe/' . $fkey->Descricao;
                           
                           array_push($idxAppTabFkToMeData, $cha);
                           
                           //die('<pre>' . var_dump($fkey) . '</pre>');
                           
                           $StructDigest[$cha] = array(
                              'AplicativoId'    => $app,
                              'TabelaId'        => $tab,
                              'Id'              => $fkey->Id,
                              'AplicativoRefId' => $fkey->AplicativoRefId_R,
                              'TabelaRefId'     => $fkey->AplicativoRefId_R . '/' . $fkey->TabelaRefId_R,
                              'Descricao'       => $fkey->Descricao);
                              
                           $this->CacheDB->Insert($cha, $StructDigest[$cha]);

                           // $fkey->CampoId é array de campos relacionados da FK.
                           if(!empty($fkey->CampoId)){


                              $fkcampo    = explode(',', trim($fkey->CampoId_R, '{}'));
                              $fkcampoRef = explode(',', trim($fkey->CampoRefId_R, '{}'));
                              
                              $idxFkFieldName = '[idx]' . $cha . '/Fields';
                              $idxFkFieldData = array();
                              
                              for($i=0; $i < count($fkcampo); $i++){

                                 $varfk = $cha . '/Fk_Field/' . $fkcampo[$i];
                                 
                                 array_push($idxFkFieldData, $varfk);
                                 
                                 $StructDigest[$varfk] = array(
                                    'ChaveEstrangeiraId' => $cha,
                                    'CampoId' => $fkcampo[$i],
                                    'CampoRefId' => $fkcampoRef[$i]
                                 );
                                 
                                 $this->CacheDB->Insert($varfk, $StructDigest[$varfk]);
                                 
                                 
                                 

                              }
                              
                              if (count($idxFkFieldData)>0){
                                 $StructDigest[$idxFkFieldName] = $idxFkFieldData;
                                 $this->CacheDB->Insert($idxFkFieldName, $StructDigest[$idxFkFieldName]);
                              }

                           }

                        }

                        // monta aquelas fks para que eu aponto.
                        if($tb->AplicativoId == $fkey->AplicativoId &&
                           $tb->Id           == $fkey->TabelaId){
							   
                           $cha = $tab . '/Fk_ToOther/' . $fkey->Descricao;
                           
                           array_push($idxAppTabFkToOtherData, $cha);
                           
                           $StructDigest[$cha] = array(
                              'AplicativoId'    => $app,
                              'TabelaId'        => $tab,
                              'Id'              => $fkey->Id,
                              'AplicativoRefId' => $fkey->AplicativoRefId_R,
                              'TabelaRefId'     => $fkey->AplicativoRefId_R . '/' . $fkey->TabelaRefId_R,
                              'Descricao'       => $fkey->Descricao
                           );
                           
                           $this->CacheDB->Insert($cha, $StructDigest[$cha]);

                           // $fkey->CampoId é array de campos relacionados da FK.
                           if(!empty($fkey->CampoId)){

                              $fkcampo    = explode(',', trim($fkey->CampoId_R, '{}'));
                              $fkcampoRef = explode(',', trim($fkey->CampoRefId_R, '{}'));
                              
                              $idxFkFieldName = '[idx]' . $cha . '/Fields';
                              $idxFkFieldData = array();

                              for($i=0; $i < count($fkcampo); $i++){
                                 
                                 
                                 $varfk = $cha . '/Fk_Field/' . $fkcampo[$i];
                                 
                                 array_push($idxFkFieldData, $varfk);                                 
                                 
                                 $StructDigest[$varfk] = array(
                                    'ChaveEstrangeiraId' => $cha,
                                    'CampoId' => $fkcampo[$i],
                                    'CampoRefId' => $fkcampoRef[$i]
                                 );
                                 
                                 $this->CacheDB->Insert($varfk, $StructDigest[$varfk]);

                              }
                              
                              if (count($idxFkFieldData)>0){
                                 $StructDigest[$idxFkFieldName] = $idxFkFieldData;
                                 $this->CacheDB->Insert($idxFkFieldName, $StructDigest[$idxFkFieldName]);
                              }                              

                           }

                        }

                     }
                     
                     if (count($idxAppTabFkToMeData)>0){                        
                        $StructDigest[$idxAppTabFkToMeName]    = $idxAppTabFkToMeData;                     
                        $this->CacheDB->Insert($idxAppTabFkToMeName, $StructDigest[$idxAppTabFkToMeName]);
                     }
                     if (count($idxAppTabFkToOtherData)>0){
                        $StructDigest[$idxAppTabFkToOtherName] = $idxAppTabFkToOtherData;
                        $this->CacheDB->Insert($idxAppTabFkToOtherName, $StructDigest[$idxAppTabFkToOtherName]);
                     }
                     
                  }//FK


                  //Monta a primary key da tabela
                  //É essencial para poder selecionar, alterar e excluir
                  if(!empty($indice)){
                     
                     $idxAppTableIndiceName = '[idx]' . $tab . '/Indice';
                     $idxAppTableIndiceData = array();
                     
                     foreach($indice as $uk){

                        if($tb->AplicativoId == $uk->AplicativoId &&
                           $tb->Id           == $uk->TabelaId){
                              
                           $ukey = $tab . '/Pk/' . $uk->Nome;
                           array_push($idxAppTableIndiceData, $ukey);
                           
                           $StructDigest[$ukey] = array(
                              'AplicativoId' => $app,
                              'TabelaId'     => $tab,
                              'Id'           => $uk->Id,
                              'Nome'         => $uk->Nome
                           );
                           
                           $this->CacheDB->Insert($ukey, $StructDigest[$ukey]);

                           // Busca os campos
                           
                           $idxIndiceFieldName = '[idx]' . $ukey . '/Fields';
                           
                           $idxIndiceFieldData = array();                           

                           if(!empty($uk->CampoId_R)){

                              $ukcampo = explode(',', trim($uk->CampoId_R, '{}'));
                              
                              

                              
                              for($i=0; $i < count($ukcampo); $i++){
                                 
                                 $ukeyF = $ukey . '/PkCampo/' . $ukcampo[$i];
                                 array_push($idxIndiceFieldData, $ukeyF); 
                                                                  
                                 $StructDigest[$ukeyF] = array(
                                    'CampoId' => $ukcampo[$i]
                                 );
                                 
                                 $this->CacheDB->Insert($ukeyF, $StructDigest[$ukeyF]);
                              }
                           }
                           if (count($idxIndiceFieldData)>0){
                                 $StructDigest[$idxIndiceFieldName] = $idxIndiceFieldData;
                                 $this->CacheDB->Insert($idxIndiceFieldName, $StructDigest[$idxIndiceFieldName]);
                           }                           


                        }
                     }
                     
                     if(count($idxAppTableIndiceData)){
                        $StructDigest[$idxAppTableIndiceName] = $idxAppTableIndiceData;
                        $this->CacheDB->Insert($idxAppTableIndiceName, $StructDigest[$idxAppTableIndiceName]);
                     }
                     
                  }//indice

               }// Tabela faz parte do aplicativo
               
             

            }//foreach tabela
            
            $StructDigest[$idxAppTableName] = $idxAppTableData;
            $this->CacheDB->Insert($idxAppTableName, $StructDigest[$idxAppTableName]);            

         }//Empty table


         // compila as permissões por aplicativo
         //$pu = $PermissaoUsuario
         
         $idxAppPermissionName = '[idx]' . $app . '/Permission';
         $idxAppPermissionData = array();
         
         foreach($permissao as $pu){
            if($pu->AplicativoId == $sc->Id){
               
               $perm = array('TipoUsuario' => $pu->TipoUsuario );
               
               $StructDigest[$app . '/Permissao/' . $pu->TipoUsuario ] = $perm ;               
               $this->CacheDB->Insert($app . '/Permissao/' . $pu->TipoUsuario , $perm);
               
               array_push($idxAppPermissionData, $app . '/Permissao/' . $pu->TipoUsuario);
               
            }
         }
         
         if (count($idxAppPermissionData)>0){
            $StructDigest[$idxAppPermissionName] = $idxAppPermissionData;
            
            $this->CacheDB->Insert($idxAppPermissionName, $StructDigest[$idxAppPermissionName]);
            
         }

      }
      
      $StructDigest['[idx]App'] = $idxAppData;
      $this->CacheDB->Insert('[idx]App', $idxAppData);
      
      return $StructDigest;
   }
   
   
}
