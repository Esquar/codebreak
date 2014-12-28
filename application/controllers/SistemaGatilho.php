<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SistemaGatilho extends controller{

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
      
      $nome     = '';
      $tipo     = '';
      $sc       = '';
      $tb       = '';
      $funcao   = '';
      $insercao      = '';
      $alteracao     = '';
      $exclusao      = '';
      $ocorrefinal   = '';

      $data = $this->getData();

      foreach($data['row'] as $item){

         if($item['key'] == 'AplicativoId'){
            $sc = $item['value'];
         }

         if($item['key'] == 'TabelaId'){
            $tb = $item['value'];
         }
         
         if($item['key'] == 'FuncaoId'){
            $funcao = $item['value'];
         }

         if($item['key'] == 'Nome'){
            $nome = $item['value'];
         }
         
         if($item['key'] == 'Tipo'){
            if($item['value'] == 1){
               $tipo = ' BEFORE ';
            }else{
               $tipo = ' AFTER ';
            }
         }
         
         if($item['key'] == 'Insercao'){
            $insercao = $item['value'];
         }
         
         if($item['key'] == 'Alteracao'){
            $alteracao = $item['value'];
         }
         
         if($item['key'] == 'Exclusao'){
            $exclusao = $item['value'];
         }
         
         if($item['key'] == 'OcorreNoFinal'){
            if($item['value'] == 't'){
               $ocorrefinal = ' CONSTRAINT ';
            }else{
               $ocorrefinal = '';
            }
         }

      }
      
      if($nome != '' &&
         $tipo != '' &&
         $funcao != ''){

         // Descubro o nome da tabela correspondente ao ID
         $data['schema'] = $sc;
         $data['table']  = $tb;
         $this->modelmaster->setData($data);
         $comp = $this->modelmaster->getCompPart();

         //busco o nome da função, baseado no ID
         $func = array(
                  'schema' => 'Sistema',
                  'table'  => 'Funcao',
                  'row'    => array(
                                 array(
                                    'key'   => 'AplicativoId',
                                    'value' => $sc
                                 ),
                                 array(
                                    'key'   => 'Id',
                                    'value' => $funcao
                                 )
                              )
                  );
         $this->modelmaster->setData($func);
         $this->modelmaster->select();
         
         $func = $this->modelmaster->getRet();
         //$func[0]->Nome;

         if (!isset($func[0]->Nome) || $func[0]->Nome == ''){
            die("Não foi possível localizar o nome da função");
         }
         
         // CREATE TRIGGER check_update
         // BEFORE INSERT OR UPDATE ON accounts
         // FOR EACH ROW
         // EXECUTE PROCEDURE check_account_update();
         $sql = 'CREATE ' . $ocorrefinal . ' TRIGGER "' . $nome . '" ';
         $sql .= $tipo;
         
         $evento = '';
         if($insercao == 't'){
            $evento = ' INSERT ';
         }

         if($alteracao == 't'){
            if($evento == ''){
               $evento = ' UPDATE ';
            }else{
               $evento .= ' OR UPDATE ';
            }
         }
         
         if($exclusao == 't'){
            if($evento == ''){
               $evento = ' DELETE ';
            }else{
               $evento .= ' OR DELETE ';
            }
         }

         $sql .= $evento;
         $sql .= ' ON "' . $comp['AplicativoNome'] . '"."' . $comp['Nome'] . '" FOR EACH ROW ';
         $sql .= ' EXECUTE PROCEDURE "' . $comp['AplicativoNome'] . '"."' . $func[0]->Nome . '"()';

         $this->modelmaster->sql($sql);

      }else{
         // erro
         print_r($data);
         die('Nome ou tipo estão vazios');
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

         // DROP TRIGGER [ IF EXISTS ] name ON table
         $sql = 'DROP TRIGGER IF EXISTS "' . $nome  . '" ON "' . $schema . '"."' . $tabela . '" ';
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

/* End of file SistemaGatilho.php */
/* Location: ./application/controllers/SistemaGatilho.php */