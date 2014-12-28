<?php

require_once ('compiler.class.php');

class modelmaster extends CI_Model {
   
   private $data;
   private $ret;
   private $field;
   private $status;
   private $comp;
   
   public $StructDigest;  


 /**
 * @return the $comp
 */
   public function getComp () {
      return $this->comp;
   }

/**
 * @param field_type $comp
 */
   public function setComp ($comp) {
      $this->comp = $comp;
   }

   function __construct(){            
      
      
      $this->comp = new compiler(CACHED_ENV_NAME);            
      $this->StructDigest = $this->getCompile();
      
      parent::__construct();
      
      
   }

   
   /**
    * @return the $field
    */
   public function getField () {
      return $this->field;
   }
   
   /**
    * @param field_type $field
    */
   public function setField ($field) {
      $this->field = $field;
   }
   
   /**
 * @return the $status
 */
   public function getStatus () {
      return $this->status;
   }

/**
 * @param field_type $status
 */
   public function setStatus ($status) {
      $this->status = $status;
   }

/**
    * @return the $data
    */
   public function getData () {
      return $this->data;
   }

   /**
    * @param Hash $data
    */
   public function setData ($data) {
      $this->data = $data;
   }

   /**
    * @return the $ret
    */
   public function getRet () {
      return $this->ret;
   }
   
   /**
    * @param Hash $ret
    */
   public function setRet ($ret) {
      $this->ret = $ret;
   }

   /**
    *
    * @return: array multidimensional com a compilação
    * @TODO: sistema de obtenção do levelDB
    *
    * */
    
   public function getCompile(){      

      return $this->comp->CacheDB->GetAll();
      //print('<pre>');
      //print(var_dump($this->StructDigest));
      //print('</pre>');
   } 
    
   /**
    *
    * */
   public function Compile(){
      
      $this->comp->DoCompile();
      $this->StructDigest = $this->comp->CacheDB->GetAll();
      
   }
   
     
   
   /**
    * @desc: Efetua a query baseada na $data definida.
    * @param Hash $data
    * */
   public function select() {

      // se tem data definida,significa que o user quer montar os elementos do select
      if( isset($this->data['data']) ){

         foreach($this->data['data'] as $item){

            // elementos necessários para o select
            // prefixo = nome da tabela, ou alias name
            // key = nome do campo no banco
            // value = alias de retorno do campo
            
            if(isset($item['prefix'])){
               $this->db->select($item['prefix'] . '."' . $item['key'] . '" AS "' . $item['value'] . '"');
            }else{
               $this->db->select($item['key'] . ' AS "' . $item['value'] . '"');
            }

         }

      }else{
         // se o user nao selecionou o que quer buscar, traz tudo

         $this->db->select('*');
      }

      $this->db->from($this->data['schema'] .".". $this->data['table']);
      
      
      //$this->db->join('comments', 'comments.id = blogs.id', 'left');
      // quando quer se inserir um left join, deve-se utilizar a seguinte sintaxe:
      /* 'left' => array('schema' => 'NomeSchema',
                         'table'  => 'NomeTabela',
                         'prefix' => 'aliasnametabela',
                         'on' => array(
                               'key' => 'prefix."NomeColuna"',
                               'value' => 'tabelaoriginal'."NomeColuna"
                            )
                        )
      */
      if( isset($this->data['left']) ){
         foreach($this->data['left'] as $item){
            
            if(isset($item['data'])){
               foreach($item['data'] as $el){
               
                  // elementos necessários para o select
                  // prefixo = nome da tabela, ou alias name
                  // key = nome do campo no banco
                  // value = alias de retorno do campo
                  if(isset($el['prefix'])){
                     $this->db->select($el['prefix'] . '."' . $el['key'] . '" AS "' .$el['value'] . '"');
                  }else{
                     $this->db->select($el['key'] . ' AS "' . $el['value'] . '"');
                  }
               
               }
            }
            
            $stringOn = '';
            
            if(isset($item['on'])){
               foreach($item['on'] as $on){
   
                  if($stringOn != ''){
                     
                     // Code Igniter possui um bug muito feio...
                     // ele se perde com o quote das colunas, a partir da segunda query
                     // vamos tratar manualmente
                     $stringkeyon = '';
                     $onkey = explode('.', $on['key']);
                     foreach($onkey as $onk){
                        if($stringkeyon != ''){
                           $stringkeyon .= '.';
                        }
                        $stringkeyon .= '"' . $onk . '"';
                     }
                     
                     $stringvalon = '';
                     $onvalue = explode('.', $on['value']);
                     foreach($onvalue as $onv){
                        if($stringvalon != ''){
                           $stringvalon .= '.';
                        }
                        $stringvalon .= '"' . $onv . '"';
                     }
                     
                     $stringOn .= ' AND ';
                     $stringOn .= $stringkeyon . ' = ' . $stringvalon;
   
                  }else{
                     $stringOn .= $on['key'] . ' = ' . $on['value'];
                  }
   
               }

               $first = '"' . $item['schema'] . '"."' . $item['table'] . '" ' . $item['prefix'];
   
               $this->db->join($first, $stringOn, 'left');
            }
            
         }
      }

      if(!empty($this->data['row'])){
          
         foreach($this->data['row'] as $item){
            $this->db->where($this->data['schema'] .".". $this->data['table'] . "." . $item['key'], $item['value']);
         }
         
      }
      
      // primariamente, ordena pela pk
      $pk = $this->getCompPrimaryKey();

      foreach($pk as $pkKey=>$pkValue){

         $this->db->order_by($this->data['schema'] .".". $this->data['table'] . "." . $pkKey, 'ASC');
      }
      
      $query = $this->db->get();
      
      /*print "<br><br><br>";
      print "-->>>" . $this->db->last_query();*/
      
      if ($query->num_rows >= 1) {

         $this->setStatus(1);
         $this->setRet($query->result());
      }else{
         
         $this->setStatus(0);
      }

      $query->free_result();
   }
   
   /**
    * @desc: Efetua a query baseada na $data definida.
    * @param Hash $data
    * */
   public function update() {
   
      foreach($this->data['data'] as $item){
         if($item['value'] != ''){
            $this->db->set($item['key'], $item['value']);
         }else{
            $this->db->set($item['key'], null);
         }
      }

      foreach($this->data['row'] as $item){
         $this->db->where($item['key'], $item['value']);
      }
   
      $query = $this->db->update($this->data['schema'] .".". $this->data['table']);
   
      if ($this->db->affected_rows() >= 1) {
   
         $this->setStatus(1);
         $this->setRet($this->db->affected_rows());
      }else{
         $this->setStatus(0);
      }
   }
   
   /**
    * @desc: Efetua a query baseada na $data definida.
    * @param Hash $data
    * */
   public function delete() {
      
      if(!empty($this->data['row'])){
         foreach($this->data['row'] as $item){
            $this->db->where($item['key'], $item['value']);
         }
      }

      $query = $this->db->delete($this->data['schema'] .".". $this->data['table']);

      if ($this->db->affected_rows() >= 1) {

         $this->setStatus(1);
         $this->setRet($this->db->affected_rows());
      }else{

         $this->setStatus(0);
      }

   }
      
   /**
    * @desc: Efetua a query baseada na $data definida.
    * @param Hash $data
    * */
   public function insert() {

      $value = array();

      foreach($this->data['row'] as $item){

         $v = $item['value'];

         if(!empty($v)){

            $value[$item['key']] = $v;

         }

      }

      $str = $this->db->insert_string($this->data['schema'] .".". $this->data['table'], $value);

      $this->sql($str . ' RETURNING *');

   }
   
   /**
    * @desc: Efetua a query baseada na string de entrada. Usada para interações fora do CRUD básico
    * @param: String $sql
    * */
   public function sql($sql){
      
      $query = $this->db->query($sql);
   
      if ($this->db->affected_rows() >= 1){

         $this->setStatus(1);
         
         if(is_object($query)){
            if($query->num_rows() > 0){
   
               $this->setRet($query->result_array());
            }
         }

      }else{
         $this->setStatus(0);
      }
   }
   
   /**
    *
    * @return: array de menu
    *
    * */
   public function getMenu(){
      // verifica nivel de acesso do usuário
      // caso seja usuário desenvolvedor, mostra a schema de Sistema.
      $menu = array();
      
      if(is_file(BASEPATH . '/compile.xml')){

         /*print "<br><br><br><pre>";
         print_r($this->comp);
         print "</pre>";
         */
         $menu = array();

         foreach($this->StructDigest as $sc){
            
            if($this->checkPermission($sc['Id'])){

               $nome = $sc['Nome'];
   
               $menu[$nome]['Table'] = array();
               $menu[$nome]['Descricao'] = $sc['Descricao'];
   
               if(isset($sc['Tabela'])){
   
                  foreach($sc['Tabela'] as $tb){
   
                     // armazena na var $registro o conteudo de uma tag tabela
                     // $registro = simplexml_load_string($tb->asXML());
                     if(!isset($tb['Visualizacao']) ||
                        $tb['Visualizacao'] == '' ||
                        $tb['Visualizacao'] == '1'){
   
                        $nometb = $tb['Nome'];
                        $desctb = $tb['Descricao'];
      
                        $menu[$nome]['Table'][$nometb] = $desctb;
                     }
   
                  }
               }
            }
         }
          
      }
      return $menu;
   }

   /**
    *
    * @desc esta função tem por objetivo retornar da compilação apenas a parte correspondente {a schema e table referenciada pelo user.
    * @param Hash $data com a descrição da schema e da table
    *
    * */
   public function getCompPart(){
      
      $array = array();
      
      foreach($this->comp as $comp){
         
         // A schema pode vir como numeração(id), ao invés do próprio nome
         if(is_numeric($this->data['schema'])){
            if($comp['Id'] == $this->data['schema']){
               
               // necessito deste dado antes de verificar se tem table.
               // pois quando se cria uma nova schema, ela nao tem tabela
               $array['AplicativoNome'] = $comp['Nome'];
               
               if(isset($comp['Tabela'])){
                  foreach($comp['Tabela'] as $tabela){
                      
                     // A tabela pode vir como numeração(id), ao invés do próprio nome
                     if($tabela['Id'] == $this->data['table']){
                         
                        $array = $tabela;
                        $array['AplicativoNome'] = $comp['Nome'];
                         
                     }
                      
                  }
               }
                
            }
         }else{
            if($comp['Nome'] == $this->data['schema']){
               
               // necessito deste dado antes de verificar se tem table.
               // pois quando se cria uma nova schema, ela nao tem tabela
               $array['AplicativoNome'] = $comp['Nome'];
               
               foreach($comp['Tabela'] as $tabela){
   
                  // A tabela pode vir como numeração(id), ao invés do próprio nome
                  if($tabela['Nome'] == $this->data['table']){
                     
                     $array = $tabela;
                     $array['AplicativoNome'] = $comp['Nome'];
   
                  }
   
               }
               
            }
         }
      }
      
      return $array;
      
   }
   
   
   /**
    *
    * @desc esta função tem por objetivo retornar da compilação apenas a parte correspondente {a schema e table referenciada pelo user.
    * @param Hash $data com a descrição da schema e da table
    *
    * */
   public function getCompPrimaryKey(){
   
      $array = array();
      
      foreach($this->StructDigest as $comp){

         if($comp['Nome'] == $this->data['schema']){
   
            foreach($comp['Tabela'] as $tabela){
   
               if($tabela['Nome'] == $this->data['table']){
   
                  if(isset($tabela['ChavePrimaria'])){

                     $pk = (array) $tabela['ChavePrimaria'];

                     $campos = (array) $pk['PKCampo'];

                     if( !isset($campos['CampoId']) ){

                        foreach( $campos as $campo){
                           // apenas para conversão de tipo
                           $cp = (array) $campo;
                           $array[$cp['CampoNome']] = $cp['CampoId'];

                        }

                     }else{

                        $array[$campos['CampoNome']] = $campos['CampoId'];
                     }
                  }

               }

            }// tabela correta

         }//schema correta

      }
   
      return $array;
   
   }
   
   
   // Check Permissões
   public function checkPermission($appId){
      
      $check = false;
      
      $tipo = $this->session->userdata('Tipo');
      
      if(empty($tipo)){
         return $check;
      }
      
      // as vezes a entrada é o id da schema... outras vezes é o nome dela.
      if(is_numeric($appId)){
         $comparacao = 'Id';
      }else{
         $comparacao = 'Nome';
      }

      foreach($this->comp as $sc){

         if($sc[$comparacao] == $appId){
            // estou no aplicativo certo

            // transformo em array para ser mais fácil de manipular
            $perm = $sc['Permissao'];

            if(isset($perm[0])){
               if(is_array($perm[0])){
                  $perm = $perm[0];
               }
   
               // percorro as permissões
               for($a=0; $a< count($perm); $a++){
                  // Se houver alguma permissão para o tipo de usuário, retorna true
                  
                  if($perm[$a] == $tipo){
                     $check = true;
                  }
               }
            }

         }

      }

      return $check;
   }
   
   public function getLeftJoin($comp, $ofk){
      
      // preciso da compilação da tabela que estou apontando, para poder fazer o left join
      $data = array();
      
      if(!is_array($ofk)){
         $ofk = (array) $ofk;
      }
      
      $this->setData(
            array(
                  'schema' => $ofk['AplicativoRefId'],
                  'table'  => $ofk['TabelaRefId']
            ));
      
      $compRef = $this->getCompPart();
      
      // preciso percorrer os campos, correlacionados com a FK.
      // para descobrir os nomes, e poder montar o left abaixo.
      $data['prefix'] = 'fk_' . $ofk['Id'];
      $data['schema'] = $compRef['AplicativoNome'];
      $data['table']  = $compRef['Nome'];
      
      $data['on'] = array();
      $field = array();
      $n = 0;

      $fk = (array) $ofk['ChaveEstrangeiraCampo'];

      if( !isset($fk[0]) ){
         $fk = array($fk);
      }

      foreach($fk as $fkcampo){

         $fkeyCampo = (array) $fkcampo;

         // busca o valor correspondente ao campoRef (tabela referenciada)
         // busca o valor correspondente ao campo (tabela de origem)

         $key = 'fk_' . $ofk['Id'] . '.';

         $key .= $compRef['Campo'][$fkeyCampo['CampoRefId']]['Nome'];

         $value  = $comp['AplicativoNome'] . '.';
         $value .= $comp['Nome'] . '.';
         $value .= $comp['Campo'][$fkeyCampo['CampoId']]['Nome'] . '';

         $on[$n] = array('key'   => $key,
                         'value' => $value
         );
      
         $field[$n]['Id']   = $comp['Campo'][$fkeyCampo['CampoId']]['Id'];
         $field[$n]['Nome'] = $comp['Campo'][$fkeyCampo['CampoId']]['Nome'];
      
         $n++;
      }
      
      // ultimo campo = $field[$n-1];
      
      $data['on'] = $on;
      
      // preciso saber o campo descritor, para poder fazer o data, indicando o select
      $descritor = '';
      foreach($compRef['Campo'] as $campoRef){
          
         if(isset($campoRef['Descritor']) &&
               ($campoRef['Descritor'] == 't' ||
                     $campoRef['Descritor'] == '1') ){
      
            $descritor = $campoRef['Nome'];
         }
      }
      $prefix = 'fk_' . $ofk['Id'];
      $value  = '_r_' . $field[$n-1]['Nome'];

      // vou checar se o último campo é array.
      // se for, não é possível efetur um left join.
      /// a resolução será um sub-select
      
      if($comp['Campo'][$field[$n-1]['Id']]['Array'] == '1'){
         $data = null;

         // quando for um array, iremos construir um sub-select
         /*$key = 'ARRAY(SELECT
                        COALESCE(prefix.campo::text,'')
                     FROM
                        "SchemaRef"."TabelaRef" AS "prefix",
                        UNNEST(campo) AS "prefix2"
                     WHERE
                        "Schema"."Tabela"."Campo" = prefix."CampoRef" AND
                        "Schema"."Tabela"."Campo" = prefix."CampoRef" AND
                        prefix2."CampoRef" = prefix."Campo"';*/
               
         $key = 'ARRAY(SELECT ' . $prefix . '."'. $descritor .'"';
         $key .= 'FROM "' . $compRef['AplicativoNome'] . '"."' . $compRef['Nome'] . '" AS ' . $prefix;
         
         $campo  = '"' . $comp['AplicativoNome'] . '"."';
         $campo .= $comp['Nome'] . '"."';
         $campo .= $comp['Campo'][$field[$n-1]['Id']]['Nome'] . '"';
         
         $key .= ' , UNNEST(' .  $campo . ') AS fkcampo_' . $ofk['Id'] . ' (value) ';
         $key .= ' WHERE ';
         
         $where = '';
         
         // percorro o $on, até o penultimo elemento
         if($n > 0){
            for($i=0; $i< ( $n -1 ) ; $i++){
               
               if($where != ''){
                  $where .= ' AND ';
               }
   
               $keyW = explode('.', $on[$i]['key']);
               $where .= '"' . $keyW[0] .'"."' . $keyW[1] . '" = ';
               
               $valueW = explode('.', $on[$i]['value']);
               $where .= '"' . $valueW[0] .'"."' . $valueW[1] . '"."' . $valueW[2] . '" ';
               
            }
         }
         
         if($where != ''){
            $where .= ' AND ';
         }

         $where .= 'fkcampo_' . $ofk['Id'] . '.value = ';
         
         $keyW = explode('.', $on[$n-1]['key']);
         $where .= '"' . $keyW[0] .'"."' . $keyW[1] . '" ';
         
         $key .= $where . ')';
         
         $data['data'][0] = array(
                              'key'    => $key,
                              'value'  => $value);
         
      }else{
         if($descritor != ''){
         
            $data['data'][] = array('prefix'  => $prefix,
                  'key'    => $descritor,
                  'value'  => $value);
         }
      }
      
      
      return $data;
   }
   
}


// End of file M.pm
