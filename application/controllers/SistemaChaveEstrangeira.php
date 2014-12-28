<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemaChaveEstrangeira extends controller{

   public $data;
   public $result;

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

   /**
 * @return the $result
 */
   public function getResult () {
      return $this->result;
   }

/**
 * @param field_type $result
 */
   public function setResult ($result) {
      $this->result = $result;
   }

   function __construct($data){
      parent::__construct();
      
      $this->setData($data);
   }

   public function Insert(){

      $sc      = '';
      $scRef   = '';
      $tb      = '';
      $tbRef   = '';
      $field      = '';
      $fieldRef   = '';
      $nome    = '';
      $real    = '';

      $data = $this->getData();

      foreach($data['row'] as $item){

         if($item['key'] == 'AplicativoId'){
            $sc = $item['value'];
         }

         if($item['key'] == 'TabelaId'){
            $tb = $item['value'];
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
         
         if($item['key'] == 'AplicativoRefId'){
            $scRef = $item['value'];
         }
         
         if($item['key'] == 'TabelaRefId'){
            $tbRef = $item['value'];
         }
         
         if($item['key'] == 'CampoRefId'){

            $pgsqlArr = $item['value'];
            
            preg_match('/^{(.*)}$/', $pgsqlArr, $matches);
            
            if(isset($matches[1])){
               $fieldRef = str_getcsv($matches[1]);
            }else{
               $fieldRef = null;
            }
         }
         
         if($item['key'] == 'Descricao'){
            $nome = $item['value'];
         }

         if($item['key'] == 'Real'){
            $real = $item['value'];
         }

      }

      // se não for uma fk real, sai fora
      if($real == 'f'){
         return;
      }
      
      if($sc != '' &&
         $tb != '' &&
         $scRef != '' &&
         $tbRef != '' &&
         $field != null &&
         $fieldRef != null){

         // Descubro o nome da tabela correspondente ao ID
         $data['schema'] = $sc;
         $data['table']  = $tb;
         $this->modelmaster->setData($data);
         $comp = $this->modelmaster->getCompPart();
         
         // Descubro o nome da tabela referenciada correspondente ao ID
         $data['schema'] = $scRef;
         $data['table']  = $tbRef;
         $this->modelmaster->setData($data);
         $compRef = $this->modelmaster->getCompPart();

         // executa um script próprio para inclusão do campo no banco de dados.
         $sql = 'ALTER TABLE "' . $comp['AplicativoNome'] . '"."' . $comp['Nome'] . '" ';
         $sql .= 'ADD CONSTRAINT "' . $nome . '" FOREIGN KEY (';
         
         // lista de campos
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
         $sql .= ') REFERENCES "' . $compRef['AplicativoNome'] . '"."' . $compRef['Nome'] . '" (';
         
         // lista de campos referenciados
         $CampoSql = '';

         foreach ($compRef['Campo'] as $campo){

            foreach ($fieldRef as $cp){
               if($cp == $campo['Id']){
         
                  if($CampoSql != ''){
                     $CampoSql .= ', ';
                  }
         
                  $CampoSql .= '"' . $campo['Nome'] . '"';
               }
            }
         }

         $sql .= $CampoSql;

         $sql .= ')  ON DELETE CASCADE ON UPDATE CASCADE;';
      
         //ALTER TABLE distributors ADD CONSTRAINT distfk FOREIGN KEY (address) REFERENCES addresses (address) MATCH FULL;
         
         $this->modelmaster->sql($sql);

      }else{
         // erro
         print_r($data);
         die('Não foi possível inserir a chave estrangeira no banco');
      }
      
   }
   
   
   public function Delete(){
   
      $sc      = '';
      $tb      = '';
      $nome    = '';
      $real    = '';

      $data = $this->getData();
      
      $info = (array) $data['row'][0];

      $sc = $info['AplicativoId'];
      $tb = $info['TabelaId'];
      $nome = $info['Descricao'];
      $real = $info['Real'];

      // se não for uma fk real, sai fora
      if($real == 'f'){
         return;
      }
      
      if($sc != '' &&
         $tb != ''){
         
         $data['schema'] = $sc;
         $data['table']  = $tb;
         $this->modelmaster->setData($data);
         $comp = $this->modelmaster->getCompPart();

         $sql = 'ALTER TABLE  "' . $comp['AplicativoNome'] . '"."' . $comp['Nome'] . '" ';
         $sql .= ' DROP CONSTRAINT "' . $nome . '"';

         $this->modelmaster->sql($sql);
         
      }else{
         // erro
         print "<br><pre>";
         print_r($data);
         print "</pre><br>";
         die('Não foi possível inserir a chave estrangeira no banco');
      }

   }
   
}

/* End of file SistemaChaveEstrangeira.php */
/* Location: ./application/controllers/SistemaChaveEstrangeira.php */