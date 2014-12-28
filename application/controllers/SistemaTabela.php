<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemaTabela extends controller{

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
      
      $nome  = '';
      $sc    = '';
      $data  = $this->getData();

      foreach($data['row'] as $item){

         if($item['key'] == 'AplicativoId'){
            $sc = $item['value'];
         }
         
         if($item['key'] == 'Nome'){
            $nome = $item['value'];
         }

      }
      
      if($nome != ''){
         
         $data['schema'] = $sc;
         $data['table']  = '';
         $this->modelmaster->setData($data);
         $comp = $this->modelmaster->getCompPart();

         // executa um script próprio para inclusão do campo no banco de dados.
         $sql = 'CREATE TABLE "' . $comp['AplicativoNome'] . '"."' . $nome . '" ()';
         $this->modelmaster->sql($sql);

      }else{
         // erro
         print_r($data);
         die('Nome está vazio');
      }

   }

   public function Delete(){
   
      $data = $this->getData();
      
      $data['schema'] = $data['row'][0]->AplicativoId;
      $data['table']  = $data['row'][0]->Id;

      $this->modelmaster->setData($data);
      $comp = $this->modelmaster->getCompPart();
      
      $schema = $comp['AplicativoNome'];
      $tabela = $comp['Nome'];

      if($tabela != ''){

         if( $tabela == 'Tabela'){
            die('N�o fa�a cagada novamente, deletando a tabela TABELA');
         }

         // executa um script próprio para inclusão do campo no banco de dados.
         $sql = 'DROP TABLE "' . $schema . '"."' . $tabela . '" CASCADE';
         $this->modelmaster->sql($sql);

      }else{
         // erro
         print_r($data);
         die('Nome est� vazio');
      }
   
   }
   
}

/* End of file SistemaTabela.php */
/* Location: ./application/controllers/SistemaTabela.php */