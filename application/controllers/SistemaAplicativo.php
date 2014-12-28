<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemaAplicativo extends controller{

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
      $data = $this->getData();

      foreach($data['row'] as $item){
         
         if($item['key'] == 'Nome'){
            $nome = $item['value'];
         }

      }
      
      if($nome != ''){

         // executa um script próprio para inclusão da schema no banco de dados.
         $sql = 'CREATE SCHEMA "' . $nome . '"';

         $this->modelmaster->sql($sql);

      }else{
         // erro
         print_r($data);
         die('Nome est� vazios');
      }
      
   }
   
   
   public function Delete(){
   
      $data = $this->getData();
      
      $data['schema'] = $data['row'][0]->Id;
      $data['table']  = '';

      $this->modelmaster->setData($data);
      $comp = $this->modelmaster->getCompPart();

      $schema = $comp['AplicativoNome'];

      if($schema != ''){
         // executa um script próprio para exclus�o da schema no banco de dados.
         $sql = 'DROP SCHEMA "' . $schema . '" CASCADE';

         $this->modelmaster->sql($sql);
   
      }else{
         // erro
         print "<br><br><br><br><pre>";
         print_r($data);
         print "</pre>";
         die('Não foi possível localizar o id da schema está vazio');
      }
   
   }
   
}

/* End of file SistemaAplicativo.php */
/* Location: ./application/controllers/SistemaAplicativo.php */