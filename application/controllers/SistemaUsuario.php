<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemaUsuario extends controller{

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

      $email      = '';

      $data = $this->getData();

      foreach($data['row'] as $item){

         if($item['key'] == 'Email'){
            $email = $item['value'];
         }

      }
      
      if($email != ''){

         // executa um script próprio para inclusão do campo no banco de dados.
         $sql = 'UPDATE "Sistema"."Usuario" SET "Senha" = MD5("Senha") WHERE "Email" = \'' . pg_escape_string($email) . '\'';

         $this->modelmaster->sql($sql);

      }else{
         // erro
         print_r($data);
         die('Email est� vazio');
      }
      
   }

}

/* End of file SistemaUsuario.php */
/* Location: ./application/controllers/SistemaUsuario.php */