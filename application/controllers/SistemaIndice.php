<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemaIndice extends controller{

   public $data;
   
   /**
 * @return the $data
 */
   public function getData () {
      return $this->data;
   }

/**
 * @param field_type $data
 */
   public function setData ($data) {
      $this->data = $data;
   }

   function __construct($data){
      parent::__construct();
      
      $this->setData($data);
   }

   public function Insert(){
      $nome    = '';
      $tipo    = '';
      $sc      = '';
      $tb      = '';
      $field   = null;
      $data = $this->getData();

      foreach($data['row'] as $item){

         if($item['key'] == 'AplicativoId'){
            $sc = $item['value'];
         }

         if($item['key'] == 'TabelaId'){
            $tb = $item['value'];
         }
         
         if($item['key'] == 'Nome'){
            $nome = $item['value'];
         }

         if($item['key'] == 'Tipo'){
            $tipo = $item['value'];
         }
         
         if($item['key'] == 'CampoId'){
            
            $pgsqlArr = $item['value'];
            
            preg_match('/^{(.*)}$/', $pgsqlArr, $matches);
            
            if(isset($matches[1])){
               $field = str_getcsv($matches[1]);
            }else{
               $field = null;
            }
         }
      }

      if($field != null &&
         $tipo != '' &&
         $nome != ''){

         $data['schema'] = $sc;
         $data['table']  = $tb;
         $this->modelmaster->setData($data);
         $comp = $this->modelmaster->getCompPart();

         switch($tipo){

            case 'PrimaryKey':
               
               // executa um script próprio para inclusão da primary key
               $sql = 'ALTER TABLE "' . $comp['AplicativoNome'] . '"."' . $comp['Nome'] . '" ';
               $sql .= 'ADD CONSTRAINT "' . $nome . '" PRIMARY KEY (';

               $CampoSql = '';
               foreach ($comp['Campo'] as $campo){

                  foreach ($field as $cp){

                     if($cp == $campo['Id']){
               
                        if($CampoSql != ''){
                           $CampoSql .= ', ';
                        }
               
                        $CampoSql .= '"' . $campo['Nome'] . '"';
                     }

                  }

               }
               
               $sql .= $CampoSql;
               $sql .= ');';

               //ALTER TABLE distributors ADD PRIMARY KEY (dist_id);

               $this->modelmaster->sql($sql);

            break;
            
            case 'UniqueIndex':
               
               // executa um script próprio para inclusão do unique index.
               $sql = 'ALTER TABLE "' . $comp['AplicativoNome'] . '"."' . $comp['Nome'] . '" ';
               $sql .= 'ADD CONSTRAINT ' . $nome . ' UNIQUE (';
               
               $CampoSql = '';
               foreach ($comp['Campo'] as $campo){
               
                  foreach ($field as $cp){
               
                     if($cp == $campo['Id']){
                         
                        if($CampoSql != ''){
                           $CampoSql .= ', ';
                        }
                         
                        $CampoSql .= '"' . $campo['Nome'] . '"';
                     }
               
                  }
               
               }
                
               $sql .= $CampoSql;
               $sql .= ');';
               
               $this->modelmaster->sql($sql);
               
            break;
            
            case 'Index':
               
               //CREATE INDEX title_idx ON films (title);
               
               // executa um script próprio para inclusão do unique index.
               $sql = 'CREATE INDEX ' . $nome . ' ON "' . $comp['AplicativoNome'] . '"."' . $comp['Nome'] . '" (';

               $CampoSql = '';
               foreach ($comp['Campo'] as $campo){
                   
                  foreach ($field as $cp){
                      
                     if($cp == $campo['Id']){
                         
                        if($CampoSql != ''){
                           $CampoSql .= ', ';
                        }
                         
                        $CampoSql .= '"' . $campo['Nome'] . '"';
                     }
                      
                  }
                   
               }

               $sql .= $CampoSql;
               $sql .= ');';

               $this->modelmaster->sql($sql);
               
            break;
            
            default:
               $sql = 'DELETE FROM "Sistema"."Indice" WHERE "Nome" = \'' . pg_escape_string($nome) . '\'';
               $this->modelmaster->sql($sql);
               die("O tipo " . $tipo . " não está disponível. Use uma das opções (PrimaryKey | Index | UniqueIndex)");
            break;
         }

      }else{
         // erro
         print_r($data);
         die('Nome ou tipo estão vazios');
      }
      
   }
   
   
   public function Delete(){
   
      $data = $this->getData();
      $nome = $data['row'][0]->Nome;
      $tipo = $data['row'][0]->Tipo;
      
      $data['schema'] = $data['row'][0]->AplicativoId;
      $data['table']  = $data['row'][0]->TabelaId;

      $this->modelmaster->setData($data);
      $comp = $this->modelmaster->getCompPart();
      
      $schema = $comp['AplicativoNome'];
      $tabela = $comp['Nome'];
      
      if($nome != '' &&
         $tipo != ''){

         if($tipo == 'Index'){
            //DROP INDEX name
            
            $sql = 'DROP INDEX "' . $nome . '"';
            $this->modelmaster->sql($sql);
            
         }else{
            
            // ALTER TABLE distributors DROP CONSTRAINT distributors_pkey

            $sql = 'ALTER TABLE "' . $schema . '"."' . $tabela . '" ';
            $sql .= 'DROP CONSTRAINT "' . $nome . '"';
            $this->modelmaster->sql($sql);
         }
   
      }else{
         // erro
         print "<br><br><br><br><pre>";
         print_r($data);
         print "</pre>";
         die('Nome está vazio');
      }
   
   }
   
}

/* End of file SistemaIndice.php */
/* Location: ./application/controllers/SistemaIndice.php */