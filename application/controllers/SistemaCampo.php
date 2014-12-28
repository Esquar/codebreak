<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemaCampo extends controller{

   public $data;
   public $schema;
   public $table;
   
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
 * @return the $table
 */
   public function getTable () {
      return $this->table;
   }

/**
 * @param field_type $table
 */
   public function setTable ($table) {
      $this->table = $table;
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
      
      $notnull = '';
      $default = '';
      $nome    = '';
      $tipo    = '';
      $sc      = '';
      $tb      = '';
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
         
         if($item['key'] == 'NotNull'){

            if($item['value'] == 't'){
               $notnull = ' NOT NULL';
            }
         }
         
         if($item['key'] == 'Default'){
            $default = $item['value'];
         }

      }
      
      if($nome != '' &&
         $tipo != ''){

         // Descubro o nome da tabela correspondente ao ID
         $data['schema'] = $sc;
         $data['table']  = $tb;
         $this->modelmaster->setData($data);
         $comp = $this->modelmaster->getCompPart();
         
         $schema = $this->getSchema();
         if(!isset($schema)){
            $schema = $comp['AplicativoNome'];
         }
         
         $table = $this->getTable();
         if(!isset($table)){
            $table = $comp['Nome'];
         }

         // executa um script próprio para inclusão do campo no banco de dados.
         $sql = 'ALTER TABLE "' . $schema . '"."' . $table . '" ';
         $sql .= 'ADD COLUMN "' . $nome . '" ' . $tipo;
         $sql .= ' ' . $notnull;

         if($default != ''){
            $sql .= ' DEFAULT ' . $default;
         }
      
         $this->modelmaster->sql($sql);

      }else{
         // erro
         print_r($data);
         die('Criação de campo. Nome ou tipo estão vazios');
      }
      
   }
   
   
   public function Delete(){
   
      $data = $this->getData();
      $nome = $data['row'][0]->Nome;
      
      $data['schema'] = $data['row'][0]->AplicativoId;
      $data['table']  = $data['row'][0]->TabelaId;

      $this->modelmaster->setData($data);
      $comp = $this->modelmaster->getCompPart();
      
      $schema = $comp['AplicativoNome'];
      $tabela = $comp['Nome'];
      
      if($nome != ''){
         // executa um script próprio para inclusão do campo no banco de dados.
         $sql = 'ALTER TABLE "' . $schema . '"."' . $tabela . '" ';
         $sql .= 'DROP COLUMN "' . $nome . '"';
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

/* End of file SistemaCampo.php */
/* Location: ./application/controllers/SistemaCampo.php */