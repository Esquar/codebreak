<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemaFuncao extends controller{

   public $data;
   public $schema;
   
   /**
 * @return the $schema
 */
   public function getSchema () {
      return $this->schema;
   }

/**
 * @param field_type $schema
 */
   public function setSchema ($schema) {
      $this->schema = $schema;
   }

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

      $sc      = '';
      $nome    = '';
      $tipo    = '';
      $ret     = '';
      $param   = '';
      $codFonte = '';
      $data = $this->getData();

      foreach($data['row'] as $item){
         
         if($item['key'] == 'AplicativoId'){
            $sc = $item['value'];
         }

         if($item['key'] == 'Nome'){
            $nome = $item['value'];
         }

         if($item['key'] == 'Tipo'){
            $tipo = $item['value'];
         }
         
         if($item['key'] == 'Retorno'){
            $ret = $item['value'];
         }
         
         if($item['key'] == 'Parametro'){
            $pgsqlArr = $item['value'];
            
            preg_match('/^{(.*)}$/', $pgsqlArr, $matches);
            
            if(isset($matches[1])){
               $param = str_getcsv($matches[1]);
            }else{
               $param = null;
            }
         }
         
         if($item['key'] == 'CodigoFonte'){
            $codFonte = $item['value'];
         }
      }
      
      if($nome     != '' &&
         $tipo     != '' &&
         $codFonte != '' &&
         $ret      != ''){



         //CREATE FUNCTION dup(in int, out f1 int, out f2 text)
         //AS $$ SELECT $1, CAST($1 AS text) || ' is text' $$
         //LANGUAGE SQL;

      // Descubro o nome da tabela correspondente ao ID
         $data['schema'] = $sc;
         $data['table']  = $tb;
         $this->modelmaster->setData($data);
         $comp = $this->modelmaster->getCompPart();
         
         $schema = $this->getSchema();
         if(!isset($schema)){
            $schema = $comp['AplicativoNome'];
         }
         
         // executa um script próprio para inclusão do campo no banco de dados.
         $sql = 'CREATE OR REPLACE FUNCTION "' . $schema . '"."' . $nome . '" (';
         
         $CampoSql = '';
         if($param != null){
            foreach ($param as $p){
            
               if($CampoSql != ''){
                  $CampoSql .= ', ';
               }
            
               $CampoSql .= $p;
            
            }
         }
         
         $sql .= $CampoSql;
         
         $sql .= ') RETURNS ' . $ret . ' AS $$ ';

         $sql .= $codFonte;
         $sql .= ' $$';
         $sql .= ' LANGUAGE ' . $tipo;
      
         $this->modelmaster->sql($sql);

      }else{
         // erro
         print_r($data);
         die('Faltaram informações para poder criar a função');
      }
      
   }
   
   
   public function Delete(){
   
      $schema = $this->getSchema();
      
      $data = $this->getData();
      $nome = $data['row'][0]->Nome;
      
      if(isset($data['row'][0]->Parametro)){
         $param = $data['row'][0]->Parametro;
      }else{
         $param = '';
      }
      
      $pgsqlArr = $param;

      preg_match('/^{(.*)}$/', $pgsqlArr, $matches);
      
      if(isset($matches[1])){
         $param = str_getcsv($matches[1]);
      }else{
         $param = null;
      }
      
      if($nome  != ''){

         //DROP FUNCTION sqrt(integer);
         $sql = 'DROP FUNCTION "' . $schema . '"."' . $nome . '" (';

         $CampoSql = '';
         if($param != null){
            foreach ($param as $p){
                
               if($CampoSql != ''){
                  $CampoSql .= ', ';
               }
                
               $CampoSql .= $p;
                
            }
         }
          
         $sql .= $CampoSql;
         $sql .= ');';

         $this->modelmaster->sql($sql);
   
      }else{
         // erro
         print "<br><br><br><br><pre>";
         print_r($data);
         print "</pre>";
         die('Nome está vazio');
      }
   
   }
   
}

/* End of file SistemaFuncao.php */
/* Location: ./application/controllers/SistemaFuncao.php */