<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controller extends CI_Controller {

   public $data;
   public $error;
   public $where;
   


   function __construct(){
      
      
      
      parent::__construct();
      
      
   }


   /**
 * @return the $where
 */
   public function getWhere () {
      return $this->where;
   }

/**
 * @param field_type $where
 */
   public function setWhere ($where) {
      $this->where = $where;
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

   public function getError(){
      return $this->error;
   }
   
   public function setError($error){
      $this->error = $error;
   }
   
/**
    * @Desc: Funcao inicial do m�todo. Checka se o login esta ativo, se estiver, encminha para o metodo solicitado.
    *
    * */
   public function index(){
      
      // verifica se o login esta ativo
      $checklogin = $this->validateLogin();

      if(!$checklogin){
         
         // nao estando ativo, direciona para a pagina de login
#die('teste login');         	
$this->load->view('Login');

      }else{
         
         $this->load->view('Inicial');
         
      }
      
   }

   /**
    * @Desc: Verifica se a sessao do usuário esta ativa
    * @TODO: Verificar se existe cookie do usuario, existindo, autenticar.
    * */
   public function validateLogin(){
      
      $logged = $this->session->userdata('logged');
      
      if (!isset($logged) || $logged != true) {
         return false;
      }else{
         return true;
      }
   }
   
   /**
    * @Desc: Verifica se o login esta correto conforme o banco de dados.
    *        Estando, efetua a criacao da sessao
    * @TODO: Criar o cookie, caso esteja marcado pelo usuario.
    * */
   public function doLogin(){
	#die('tete');
      if( ($this->input->post('Login') == null) ||
          ($this->input->post('Pass')  == null) ){

         //redirect('controller/index/Erro-usuario-ou-senha-vazios');
         //$this->output->set_header('refresh:0; url='.base_url() . 'controller/index/Erro-usuario-ou-senha-vazios');
         $this->redireciona('controller/index/Erro-usuario-ou-senha-vazios');
      }

      $this->setData(array(
                        'schema' => 'Sistema',
                        'table' => 'Usuario',
                        'row'    => array(
                                       array(
                                          'key'   => 'Email',
                                          'value' => $this->input->post('Login')
                                       ),
                                       array(
                                             'key'   => 'Senha',
                                             'value' => md5($this->input->post('Pass'))
                                       )
                                    )
                        ));

      $this->modelmaster->setData($this->getData());

      $this->modelmaster->select();
      
      // se o retorno foi de login com sucesso, submete para a pagina principal.
      // caso contrario, retornar para a página de login, com erro.
      if($this->modelmaster->getStatus() == 1){

         $ret = $this->modelmaster->getRet();
         $this->session->set_userdata('logged',   '1');
         $this->session->set_userdata('Id',       $ret[0]->Id);
         $this->session->set_userdata('Nome',     $ret[0]->Nome);
         $this->session->set_userdata('Tipo',     $ret[0]->Tipo);
         
	# die($this->session->userdata('Nome'));
         $this->load->view('Inicial');
      }else{
         print "<script>alert('Usuario ou senha incorretos')</script>";
         $this->index();
      }
   }
   
   public function Logout(){
      $this->session->sess_destroy();
      $this->index();
   }
   
   
   /**
    *
    * @desc: Funcao Acesso tem por objetivo, abrir a tela da tabela acessada. Demonstrando inicialmente a tela de listagem
    *
    * */
   
   public function Acesso(){
      
      if(!$this->validateLogin()){
         print "<script>alert('Voce precisa logar primeiro')</script>";
         $this->index();
         return;
      }
      
      
      // O terceiro elemento da url, refere-se a tabela requisitada
      $table = $this->uri->segment(3);
      
      if($table == 'Compilar'){
         // Acessa a compilacao.
         
         $this->modelmaster->Compile();
         
         if (ENVIRONMENT == 'testing'){
         
            echo('<br><br><br><pre>');
            print_r($this->modelmaster->comp->CacheDB->GetAll('*idx*'));
            echo('</pre>');
            
         }
         
         //$this->modelmaster->setComp( $this->modelmaster->getCompile() );
         print "<script>alert('Compilacao executada com sucesso')</script>";
         $this->index();
         return;
      }
      
      // O quarto elemento da url, metodo(insert, select, update, delete).
      // Quando vazio, eh listagem
      $tp = $this->uri->segment(4);

      if (empty($tp)){
         $tp = 'Browse';
      }
      
      $sctb    = explode ( '.' , $table);
      $schema  = $sctb[0];
      $tb      = $sctb[1];

      $this->modelmaster->setData(array('schema' => $schema, 'table' => $tb) );

      //Preciso obter da compilacao, os dados completos desta tabela.
      $comp = $this->modelmaster->getCompPart();
      
      // verifico se o usuario tem permissao de acessar o aplicativo
      if( !$this->modelmaster->checkPermission($comp['AplicativoId']) ){
         print "<script>alert('Voce esta executando uma operacao ilegal')</script>";
         $this->index();
         return;
      }
      
      $menu = $this->modelmaster->getMenu();
      
      $pk = $this->modelmaster->getCompPrimaryKey();

      $this->setData(array(
                        'comp' => (array) $comp,
                        'pkey' => (array) $pk,
                        'menu' => $menu,
                        'C'     => $this
                     ));

      // Realiza o switch entre as operacoes
      switch($tp){
         case 'Browse':

            $this->Browse($schema, $tb, $comp, $pk);

         break;
         case 'Insert':

            $this->load->view('Incluir', $this->getData());
            
         break;
         case 'Update':

            $dataM = $this->modelmaster->getData();
            
            $data = $this->getData();
            $data['row'] = array();
            //transforma o $_get em where para o select, e retorna
            foreach($_GET as $key => $value){
               array_push($data['row'], array('key'=> $key, 'value'=>$value) );
            }
            
            $dataM['row'] = $data['row'];
            
            if (isset($comp['ChaveEstrangeira_ParaOutros'])){
            
               $dataM['left'] = array();
               $i            = 0;
            
               foreach($comp['ChaveEstrangeira_ParaOutros'] as $ofk){
            
                  $left = $this->modelmaster->getLeftJoin($comp, $ofk);
            
                  if($left != null){
            
                     $dataM['left'][$i] = $left;
                      
                     $i++;
                  }
            
               }
                
               // agora que fez os lefts, monta o $data['data'], com as colunas da tabela principal
               foreach($comp['Campo'] as $campo){
            
                  $dataM['data'][] = array('prefix' => $comp['AplicativoNome'] . '"."' . $comp['Nome'] . '"',
                        'key'    => $campo['Nome'],
                        'value'  => '_v_' . $campo['Nome']);
               }
            
            }

            $this->modelmaster->setData($dataM);
            
            $this->modelmaster->select();
            $row   = $this->modelmaster->getRet();

            $data['row']   = $row;

            $this->setData($data);
            $this->load->view('Alterar', $data);

         break;
         case 'Select':
            
            $this->Select($schema, $tb, $comp, $pk);

         break;
         
         case 'Delete':
         
            $dataM = $this->modelmaster->getData();

            $data = $this->getData();
            $data['row'] = array();

            //transforma o $_get em where para o select, e retorna
            foreach($_GET as $key => $value){
               array_push($data['row'], array('key'=> $key, 'value'=>$value) );
            }

            $dataM['row'] = $data['row'];
            
            $this->modelmaster->setData($dataM);
            $this->modelmaster->select();
            $row   = $this->modelmaster->getRet();

            $this->modelmaster->delete();

            $data['row']   = $row;
            $this->setData($data);
            
            // verifica se tem alguma classe que extenda a C.
            $SchemaTable = $schema . $tb;
            $file = './application/controllers/' . $SchemaTable . '.php';
            
            if( file_exists($file) ){
               include $file;
            
               if( class_exists($SchemaTable) ) {

                  $obj = new $SchemaTable($data);
            
                  if( is_callable(array($obj, "setSchema") ) ){
                     $obj->setSchema($schema);
                  }

                  if( is_callable(array($obj, "Delete") ) ){
                     $obj->Delete();
                  }

               }else{
                  die('deveria ter a classe');
               }
            }
            
            print "<script>alert('Registro deletado com sucesso')</script>";
            
            $this->recompila($schema);
            
            //$this->Browse($schema, $tb, $comp, $pk);
            //redirect('controller/Acesso/' . $schema . '.' . $tb . '/Browse');
            //$this->output->set_header('refresh:0; url='.base_url() . 'controller/Acesso/' . $schema . '.' . $tb . '/Browse');
            $this->redireciona('controller/Acesso/' . $schema . '.' . $tb . '/Browse');

         break;
         
         default:
            
            $this->Browse($schema, $tb, $comp, $pk);
         break;
      }
   }

   public function Executar(){

      if(!$this->validateLogin()){
         print "<script>alert('Voce precisa logar primeiro')</script>";
         $this->index();
         return;
      }

      // verifico se o usuario tem permissao de acessar o aplicativo

      $action = $this->input->post('Acao');

      switch ($action){

         case  'Incluir':

            $post = array();
            $post_master = array();

            $cont = 0;

            // no post, pode vir vais de uma tabela, entao, monto um array por "tabela"
            foreach($this->input->post() as $key => $value){

               // não sendo um dos parâmetros
               if($key != 'Acao' &&
                  $key != 'MasterSchemaId' &&
                  $key != 'MasterTableId'){

                  // o nome do campo vem com separacao por underline Schema_Tabela_Campo
                  $campo = explode('_', $key);
                  
                  //$campo[0] = schema
                  //$campo[1] = table
                  //$campo[2] = campo

                  if($campo[0] == $this->input->post('MasterSchemaId') &&
                     $campo[1] == $this->input->post('MasterTableId')){
                     
                     // Caso a operacao seja com a tabela master, gravo separado.
                     // ela terá que ser executada primeiro.

                        $post_master[$campo[0]]['Table'] = $campo[1];

                        if(is_array($value)){
                           $myArray = '{';
                           foreach($value as $val){
                              
                              if($myArray != '{'){
                                 $myArray .= ', ';
                              }
                              if(is_numeric($val)){
                                 $myArray .= $val;
                              }else{
                                 $myArray .= "'" . $val . "'";
                              }
                           }

                           $myArray .= '}';
                           
                           if($myArray == "{''}" || $myArray == "{}"){
                              $myArray = NULL;
                           }

                           $post_master[$campo[0]]['row'][] = array('key'   => $campo[2],
                                                                    'value' => $myArray);

                        }else{
                           $post_master[$campo[0]]['row'][] = array('key'   => $campo[2],
                                                                    'value' => $value);
                        }

                  }else{

                     if(!isset($post[$campo[0]][$cont]['Table'])){
   
                        $post[$campo[0]][$cont]['Table'] = $campo[1];
   
                     }else{
   
                        // troca o cont para que seja a proxima tabela
                        if($post[$campo[0]][$cont]['Table'] != $campo[1]){

                           $cont++;
                           $post[$campo[0]][$cont]['Table'] = $campo[1];
                        }
                     }
   
                     $post[$campo[0]][$cont]['row'][] = array('key'   => $campo[2],
                                                              'value' => $value);
                  }

               }

            }
            
            // terminou a montagem do array que separa tabela a tabela


            // Primeiro, insere a tabela principal
            foreach($post_master as $schema => $tabela){

               // verifico se o usuario tem permissao de acessar o aplicativo
               if( !$this->modelmaster->checkPermission($schema) ){
                  print "<script>alert('Voce esta executando uma operacao ilegal')</script>";
                  $this->index();
                  return;
               }
            
               $data = array('row' => array());
            
               $data['row'] = $tabela['row'];

               $data['schema'] = $schema;
               $data['table']  = $tabela['Table'];
         
               $this->modelmaster->setData($data);
               $this->modelmaster->insert();

               // obtem o retorno do insert
               $result = $this->modelmaster->getRet();
               $this->setData($data);

               // verifica se teve sucesso na inclusao
               if($this->modelmaster->getStatus() != 1){
         
                  print "<script>alert('Ocorreu algum erro no processo de inclusao')</script>";
         
                  $SchemaTable = $this->input->post('MasterSchemaId') . '.' . $this->input->post('MasterTableId');
                  //$this->output->set_header('refresh:0; url='.base_url() . 'controller/Acesso/' . $SchemaTable . '/Insert');
                  $this->redireciona('controller/Acesso/' . $schema . '.' . $table . '/Insert');
         
                  return;
               }
               
               // finaliza executando a execucao da extensão do C da classe master, quando houver.
               
               $SchemaTable = $this->input->post('MasterSchemaId') . $this->input->post('MasterTableId');
               
               // verifica se tem alguma classe que extenda a C.
               
               $file = './application/controllers/' . $SchemaTable . '.php';
               
               if( file_exists($file) ){
                  include $file;
               
                  if( class_exists($SchemaTable) ) {
               
                     $obj = new $SchemaTable($data);

                     if( is_callable(array($obj, "Insert") ) ){
                        $obj->Insert();
                     }
               
                  }else{
                     // se tem o arquivo, deveria ter a classe
                     die('classe nao existe: ' . $SchemaTable);
                  }
               
               }
               
               $this->recompila($this->input->post('MasterSchemaId'));

            }//foreach

            // TERMINOU A INCLUSAO DO PRINCIPAL

            $this->modelmaster->setData(array('schema' => $data['schema'], 'table' => $data['table']) );

            //Preciso obter da compilacao, os dados completos desta tabela.
            $comp = $this->modelmaster->getCompPart();


            // Preciso da PK da tabela master.
            // isto, aliado ao retorno dos dados da insercao, posso inserir as demais tabelas
            $pkey = $this->modelmaster->getCompPrimaryKey();

            $Master_Pkey = array();

            // monta as rows de insercao da pk
            /* Estrutura da pk
             * Array
                  (
                      [AplicativoId] => 21
                      [TabelaId] => 22
                      [Id] => 23
                  )
             * */
            foreach($result[0] as $res_key => $res_value){

               if( isset($pkey[$res_key]) ){
                  $Master_Pkey[$pkey[$res_key]] = array('key'   => $res_key,
                                                        'value' => $res_value);
               }
            }

            // estrutura resultante do $Master_Pkey
            /*
             * array(
             *       [21] => array('key'   => 'AplicativoId',
             *                     'value' => 55)
             * )
             *
             * */


            // depois de inserir a tabela principal, insere as relacionadas
            foreach($post as $schema => $tabela){

               // verifico se o usuario tem permissão de acessar o aplicativo
               if( !$this->modelmaster->checkPermission($schema) ){
                  print "<script>alert('Voce esta executando uma operacao ilegal')</script>";
                  $this->index();
                  return;
               }

               $data = array('row' => array());

               // percorre cada uma das tabelas que serao inseridas
               for($i=0; $i<count($tabela); $i++){

                  $this->modelmaster->setData( array('schema' => $schema, 'table' => $tabela[$i]['Table']) );
                  
                  //Preciso obter da compilacao, os dados completos desta tabela.
                  $comp_rel = $this->modelmaster->getCompPart();
                  $pkey     = array();
                  
                  // com os dados obtidos da pk da tabela master, preciso alimentar a pk da tabela relacionada
                  // faremos isso com a leitura da compilacao da tabela pai
                  foreach($comp_rel['ChaveEstrangeira_ParaOutros'] as $c_rel){
                     
                     if($c_rel['AplicativoRefId'] == $comp['AplicativoId'] &&
                        $c_rel['TabelaRefId']     == $comp['Id']){

                        // estou na relacao entre as tabelas correta
                        // @TODO: problema em potencial em tabelas que possuem auto-relacionamento
                        // ou que possuem 2 fks com a mesma tabela

                        // percorre cada um dos campos que fazem relacao.
                        // aqueles que estiverem relacionados com a PK da tabela master
                        // serao adicionados aos dados que serao inseridos
                        foreach($c_rel['ChaveEstrangeiraCampo'] as $fk_campo){

                           $fk = (array) $fk_campo;
                           
                           if(isset($Master_Pkey[$fk['CampoRefId']]) ){
                              $pkey[$fk['CampoId']] = $Master_Pkey[$fk['CampoRefId']]['value'];
                           }
                        }
                        /*
                         * Resultado da montagem da $pkey
                         * array(
                         *    '21' => '55',
                         *    '22' => '66'
                         * )
                         *
                         *sendo que o indice, eh o id da tabela relacionada
                         *e o valor, eh o resultado da tabela principal
                         * */
                     }
                  }

                  
                  $pkey_rel = array();

                  // com a pkey montada, preciso saber os nomes dos campos que correspondem aos ids
                  foreach($comp_rel['Campo'] as $key => $value){

                     if( isset($pkey[$key]) ){

                        $pkey_rel[] = array('key'   => $value['Nome'],
                                            'value' => $pkey[$key]);
                     }

                  }

                  $data['schema'] = $schema;
                  $data['table']  = $tabela[$i]['Table'];

                  // as tabelas que estao junto, sao do tipo array
                  // logo, tenho que iterar e efetuar o insert por cada um

                  for($n=0; $n<count($tabela[$i]['row'][0]['value']); $n++){

                     // zera
                     $row_rel     = array();
                     $data['row'] = array();

                     foreach($tabela[$i]['row'] as $row){
                        $row_rel[] = array('key'   => $row['key'],
                                           'value' => $row['value'][$n]);
                     }

                     // concatena o array com as pks da tabela master, mais os campos da tabela filha
                     $data['row'] = array_merge($pkey_rel, $row_rel);

                     $this->modelmaster->setData($data);

                     // cada insercao na tabela eh inserida individualmente
                     $this->modelmaster->insert();
                  
                     // verifica se teve sucesso na inclusao
                     if($this->modelmaster->getStatus() != 1){

                        print "<script>alert('Ocorreu algum erro no processo de inclusao')</script>";

                        $SchemaTable = $this->input->post('MasterSchemaId') . '.' . $this->input->post('MasterTableId');
                        //$this->output->set_header('refresh:0; url='.base_url() . 'controller/Acesso/' . $SchemaTable . '/Insert');
                        $this->redireciona('controller/Acesso/' . $SchemaTable . '/Insert');

                        return;
                     }
   
                     $SchemaTable = $schema . $tabela[$i]['Table'];

                     // verifica se tem alguma classe que extenda a C.

                     $file = './application/controllers/' . $SchemaTable . '.php';

                     if( file_exists($file) ){

                        include_once $file;

                        if( class_exists($SchemaTable) ) {
                           $obj = new $SchemaTable($this->modelmaster->getData());
   /*
                           if( is_callable(array($obj, "setSchema") ) ){
                              $obj->setSchema($schema);
                           }
                           
                           if( is_callable(array($obj, "setTable") ) ){
                              $obj->setSchema($this->input->post('MasterTableId'));
                           }*/

                           if( is_callable(array($obj, "Insert") ) ){
                              $obj->Insert();
                           }
   
                        }else{
                           // se tem o arquivo, deveria ter a classe
                           die('classe nao existe: ' . $SchemaTable);
                        }
                     }

                  }// iteracao de registro a registro da tabela

               }//for por tabela

            }//foreach por schema


            print "<script>alert('Registro incluido com sucesso')</script>";

            
            $this->recompila($this->input->post('MasterSchemaId'));

            //$this->Browse($this->input->post('MasterSchemaId'), $this->input->post('MasterTableId'), null, null);
            //redirect('controller/Acesso/' . $this->input->post('MasterSchemaId') . '.' . $this->input->post('MasterTableId') . '/Browse');
            //$this->output->set_header('refresh:0; url='.base_url() . 'controller/Acesso/' . $this->input->post('MasterSchemaId') . '.' . $this->input->post('MasterTableId') . '/Browse');
            $this->redireciona('controller/Acesso/' . $this->input->post('MasterSchemaId') . '.' . $this->input->post('MasterTableId') . '/Browse');

         break;



         case  'Atualizar':

            $data = array(
                  'schema' => $this->input->post('MasterSchemaId'),
                  'table'  => $this->input->post('MasterTableId'),
                  'row'    => array(),
                  'data'   => array()
            );

            $this->modelmaster->setData($data);
            $comp = $this->modelmaster->getCompPart();
            
            $schema = $comp['AplicativoNome'];
            $table  = $comp['Nome'];

            $data['schema'] = $schema;
            $data['table']  = $table;

            $this->modelmaster->setData($data);
            
            $pk   = $this->modelmaster->getCompPrimaryKey();
            
            foreach($this->input->post() as $key => $value){
               
               if($key != 'MasterSchemaId' &&
                  $key != 'MasterTableId'  &&
                  $key != 'Acao'){

                  $pos = strpos($key, "_");

                  if ($pos === false) {
                     $campo = $key;
                  }else{
                     $campo = explode('_', $key);
                     $campo = $campo[2];
                  }

                  //$campo[0] = schema
                  //$campo[1] = table
                  //$campo[2] = campo
   
                  // nao iremos atualizar as PKs
                  if(isset($pk[$campo])){
               
                     array_push($data['row'], array('key'   => $campo,
                                                    'value' => $value));
                     
                  // nao sendo a pk nem as variaveis de controle de ambiente
                  }else{
   
                     if(is_array($value)){

                        $myArray = '{';
                        foreach($value as $val){
                     
                           if($myArray != '{'){
                              $myArray .= ', ';
                           }
                           if(is_numeric($val)){
                              $myArray .= $val;
                           }else{
                              $myArray .= "'" . $val . "'";
                           }
                        }
                     
                        $myArray .= '}';
                        
                        if($myArray == "{''}" || $myArray == "{}"){
                           $myArray = NULL;
                        }
                     
                        array_push($data['data'], array('key'   => $campo,
                                                        'value' => $myArray));
                     
                     }else{
                        array_push($data['data'], array('key'   => $campo,
                                                        'value' => $value));
                     }
                  }
               }
            }

            $this->modelmaster->setData($data);
            
            $this->modelmaster->update();

            $this->setData($data);

            $status = $this->modelmaster->getStatus() || 0;

            // verifica se teve sucesso na atualizacao
            if($status == 1){

               print "<script>alert('Registro alterado com sucesso')</script>";

               // tenta listar os registros
               //$this->Browse($schema, $table, $comp, $pk);

               $this->recompila($schema);
               
               //redirect('controller/Acesso/' . $schema . '.' . $table . '/Browse');
               //$this->output->set_header('refresh:0; url='.base_url() . 'controller/Acesso/' . $schema . '.' . $table . '/Browse');
               $this->redireciona('controller/Acesso/' . $schema . '.' . $table . '/Browse');

            }else{

               print "<script>alert('Ocorreu algum erro no processo de alteracao')</script>";
               //redirect('controller/Acesso/' . $schema . '.' . $table . '/Insert');
               //$this->output->set_header('refresh:0; url='.base_url() . 'controller/Acesso/' . $schema . '.' . $table . '/Insert');
               $this->redireciona('controller/Acesso/' . $schema . '.' . $table . '/Insert');
            }

         break;

         default:
            print "<script>alert('Voce esta executando uma operacao ilegal')</script>";
            $this->index();
         break;
      }
      
   }
   

   public function Browse($schema, $table, $comp, $pk){
      
      $data = array('schema' => $schema,
                    'table'  => $table,
                    'row'    => array());
      
      
      // seta novamente a data do M para zerar os dados
      $this->modelmaster->setData( $data );

      if(!isset($comp)){
         $comp = $this->modelmaster->getCompPart();
      }

      $post = $this->input->post();
      $get  = $this->input->get();

      if(!isset($post) || $post == null){
         $post = $get;
      }

      $where = array();

      if(isset($post) &&
         $post != null &&
         !isset($post['Acao'])){

         foreach($post as $key => $value){

            if($value != '' &&
               $value != null &&
               $key != 'Acao' &&
               $key != 'MasterSchemaId' &&
               $key != 'MasterTableId'){

               array_push($data['row'], array('key'   => $key,
                                              'value' => $value));
               
               $where[$key] = $value;
            }
         }
      }

      
      // percorre cada uma das fks que eu aponto.
      // cada uma resultara em 1 left join
      if (isset($comp['ChaveEstrangeira_ParaOutros'])){
   
         $data['left'] = array();
         $i            = 0;
      
         foreach($comp['ChaveEstrangeira_ParaOutros'] as $ofk){

            $left = $this->modelmaster->getLeftJoin($comp, $ofk);

            if($left != null){

               $data['left'][$i] = $left;
   
               $i++;
            }

         }
         
         // agora que fez os lefts, monta o $data['data'], com as colunas da tabela principal
         foreach($comp['Campo'] as $campo){

            $data['data'][] = array('prefix' => $comp['AplicativoNome'] . '"."' . $comp['Nome'] . '"',
                                    'key'    => $campo['Nome'],
                                    'value'  => '_v_' . $campo['Nome']);
         }

      }

      // seta novamente a data do M para zerar os dados
      $this->modelmaster->setData( $data );
      
      $data = array(
            'schema' => $schema,
            'table'  => $table,
            'row'    => array(),
            'data'   => array()
      );
      
      if(!isset($pk)){
         $pk   = $this->modelmaster->getCompPrimaryKey();
      }
      
      // monta o menu
      $menu = $this->modelmaster->getMenu();
      
      // reseto a var data
      $data = array(
            'comp'   => (array) $comp,
            'pkey'   => (array) $pk,
            'menu'   => $menu,
            'schema' => $schema,
            'table'  => $table
      );
      
      // seleciona a listagem
      $this->modelmaster->select();

      // obtem a lista de retorno
      $row   = $this->modelmaster->getRet();
/*
      print "<br><br><br><pre>";
      print_r($row);
      print "</pre>";
  */
      $data['row'] = null;
      $data['row'] = $row;
      $data['where'] = $where;

      $this->setData($data);
      
      $this->load->view('Listar', $data);
      
   }
   
   public function Select($schema, $table, $comp, $pk){

      $dataM = $this->modelmaster->getData();

      $data = $this->getData();
      $data['row'] = array();
      
      //transforma o $_get em where para o select, e retorna
      foreach($_GET as $key => $value){
         array_push($data['row'], array('key'=> $key, 'value'=>$value) );
      }
      
      $dataM['row'] = $data['row'];

      if (isset($comp['ChaveEstrangeira_ParaOutros'])){
          
         $dataM['left'] = array();
         $i            = 0;
      
         foreach($comp['ChaveEstrangeira_ParaOutros'] as $ofk){

            $left = $this->modelmaster->getLeftJoin($comp, $ofk);

            if($left != null){

               $dataM['left'][$i] = $left;
   
               $i++;
            }

         }
         
         // agora que fez os lefts, monta o $data['data'], com as colunas da tabela principal
         foreach($comp['Campo'] as $campo){

            $dataM['data'][] = array('prefix' => $comp['AplicativoNome'] . '"."' . $comp['Nome'] . '"',
                                    'key'    => $campo['Nome'],
                                    'value'  => '_v_' . $campo['Nome']);
         }
      
      }
      
      $this->modelmaster->setData($dataM);
      
      $this->modelmaster->select();
      $row   = $this->modelmaster->getRet();
      
      $data['row']   = $row;
      
      $this->setData($data);
      $this->load->view('Visualizar', $data);
   }
   

   /**
    * @desc: Retorna o valor Resolvido de uma determinada Fk
    * @param: Hash $data. Esta hash deve conter os elementos:
    *    Schema = SchemaId
    *    Table  = TableId
    *    ChaveEstrangeiraId = ChaveEstrangeiraId
    */
   public function getFkResolutor(){
      
      // busco a compilacao parcial, pois ali tem praticamente todos os dados
      // que eu preciso

      $this->modelmaster->setData(
                        array(
                           'schema' => $this->data['schema'],
                           'table'  => $this->data['table']
                           )
                       );
      //@TODO: preciso realmente pegar a compilacao parcial novamente? SIM
      $comp = $this->modelmaster->getCompPart();

      if (!isset($comp['ChaveEstrangeira_ParaOutros'])){
         return;
      }

      foreach ($comp['ChaveEstrangeira_ParaOutros'] as $fk) {
         if(!is_array($fk)){
            $fk = (array) $fk;
         }
         
         //ao encontrar a Fk que eu quero resolver, vou buscar no banco qual o campo que eh o descritor desta tabela
         //obs: Pego apenas pela tabela. Nao estou me importando no momento quais os campos compoem essa Fk

         // se nao for o id que estou procurando, pula a iteração
         if ($fk['Id'] != $this->data['ChaveEstrangeiraId']){
            continue;
         }

         $this->modelmaster->setData(array(
                                 'schema' => $fk['AplicativoRefId'],
                                 'table'  => $fk['TabelaRefId']
                              ));

         $compRef = $this->modelmaster->getCompPart();

         $descritor = array();

         foreach($compRef['Campo'] as $campoRef){
         
            if(isset($campoRef['Descritor']) &&
               ($campoRef['Descritor'] == 't' ||
                $campoRef['Descritor'] == '1') ){
         
               $descritor['Nome'] = $campoRef['Nome'];
               $descritor['Id']   = $campoRef['Id'];
            }
         }

         //remonto a data, para agora buscar os registros resolvidos da Fk
         $data = array(
                        'schema' => $compRef['AplicativoNome'],
                        'table'  => $compRef['Nome'],
                        'row'    => array()
                     );

         // Se teve post, tento montar o where do select, filtrando os dados
         $where = $this->getWhere();
         if($where != null){
            foreach($where as $wh){

               if($wh['value'] != '' &&
                  $wh['value'] != null &&
                  $wh['key'] != 'Acao' &&
                  $wh['key'] != 'MasterSchemaId' &&
                  $wh['key'] != 'MasterTableId'){

                  $data['row'][] = array('key'   => $wh['key'],
                                         'value' => $wh['value']);
               }
            }
         }
         // fim do where

         $this->modelmaster->setData($data);
         $this->modelmaster->select();

         //novamente, se o status for 1 eu pego o retorno
         if ($this->modelmaster->getStatus() == 1){

            $res = $this->modelmaster->getRet();
            
            //finalmente, monto o array de retorno. estou retornando todos os dados (nao apenas a Pk+resolutor)
            //pois ainda nao implementei o select com retorno de campos especificos
            $result = array();
            $i = 0;

            foreach($res as $r){
            
               $r = (array) $r;
               
               $result[$i] = array( 'Id' => $r['Id'], 'Resolutor' => $r[$descritor['Nome']]  );
               $i++;
               
               
            }

            $final = array(
                        'schema' => $data['schema'],
                        'table'  => $data['table'],
                        'resolutor' => array('CampoId' => $descritor['Id'], 'CampoDesc' => $descritor['Nome']),
                        'resolved'  => $result
                     );
                     
            //retorno o array
            return $final;
         }else{
            return;
         }
      }
   }
   
   public function recompila($schema){
      if($schema == 'Sistema'){
         $this->modelmaster->StructDigest = $this->Compiler->DoCompile();
         $this->modelmaster->Compile();
         $this->modelmaster->setComp( $this->modelmaster->getCompile() );
      }
   }
   
   
   public function requestFKParcial($el = null){
//      print json_encode(array('error' => 'chegou aqui'));
//return;
      //para funcionar tanto com chamadas externas, quanto internas
      if($el == null){
         $post = $this->input->post();
         $get  = $this->input->get();
         
         if(!isset($post) || $post == null){
            $post = $get;
         }
      }else{
         $post = $el;
      }

      if(isset($post) &&
         $post != null){

         $data = array(
                     'schema' => $post['schema'],
                     'table'  => $post['table'],
                     'ChaveEstrangeiraId' => $post['ChaveEstrangeiraId'],
                  );
         
         $this->modelmaster->setData(
               array(
                     'schema' => $post['schema'],
                     'table'  => $post['table']
               )
         );

         $comp = $this->modelmaster->getCompPart();

         $where = array();
         $n = 0;

         for($i=0; $i<count($post['Campo']); $i++){

            foreach($post['Campo'][$i] as $key => $value){

               if($value != '' &&
                  $value != null &&
                  $key != 'schema' &&
                  $key != 'table' &&
                  $key != 'ChaveEstrangeiraId'){
            
                  foreach($comp['Campo'] as $campo){
                  
                     if($campo['Nome'] == $key){

                        $where[$n] = array('key'   => $key,
                                         'value' => $value,
                                         'Id'    => $campo['Id']);
                        
                        $n++;
                     }
                  }
                  
                  // acha o oposto, fk de destino
                  foreach ($comp['ChaveEstrangeira_ParaOutros'] as $fk) {
                     
                     if(!is_array($fk)){
                        $fk = (array) $fk;
                     }
                  
                     if ($fk['Id'] != $post['ChaveEstrangeiraId']){
                        continue;
                     }
                     
                     // estou na fk certa
                     
                     // busca a compilacao da tabela de destino
                     $this->modelmaster->setData(
                           array(
                                 'schema' => $fk['AplicativoRefId'],
                                 'table'  => $fk['TabelaRefId']
                           )
                     );

                     $compRef = $this->modelmaster->getCompPart();

                     // percorre os campos da fk
                     foreach($fk['ChaveEstrangeiraCampo'] as $fkCampo){
                        
                        if(!is_array($fkCampo)){
                           $fkCampo = (array) $fkCampo;
                        }

                        if($fkCampo['CampoId'] == $where[$n - 1]['Id']){
                           $where[$n - 1]['Oposto'] = $fkCampo['CampoRefId'];

                        }

                     }
                     
                  }

               }

            }// end foreach de campos do post

         }// end for de campos do post

         // percorre o where
         for($i=0; $i<$n; $i++){
            
            foreach($compRef['Campo'] as $campoRef){

               if($campoRef['Id'] == $where[$i]['Oposto']){
                  
                  // achando o id certo, troco o key
                  $where[$i]['key'] = $campoRef['Nome'];
                  
               }

            }
            
         }
         
         $this->setData($data);
         $this->setWhere($where);

         $res = $this->getFkResolutor();
         
         if($el != null){
            return $res;
         }else{
            print json_encode($res);
         }

      }else{
         print json_encode(array('error' => 'nao reconheceu o post'));
      }
   }
   
   
   public function redireciona($url){
      
      echo'
         <script>
            window.location.href = "' . base_url() . $url.'";
         </script>
      ';

   }
   
}




/* End of file C.php */
/* Location: ./application/controllers/controller.php */
