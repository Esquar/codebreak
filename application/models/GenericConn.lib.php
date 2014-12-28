<?php

   require_once 'vendor/autoload.php';
   require_once 'redis.php';

   /**
    * Classe de conexao externa ao CodeIgniter
    * Ao instancia-la, fica disponivel a Variavel "DBConn", que é uma
    * instancia de QueryBuilder da lib Pixie('https://github.com/usmanhalalit/pixie/')
    */ 
   class GenericConn {
      
      private $CacheDB;
      //private $DBConn;
      public  $QB;
      
      function __construct($service='www'){
         
         //Logo no CacheDB[0] para descobrir pelo serviço qual o banco devo logar
         $this->CacheDB = new RedisCli("tcp", "127.0.0.1", 6379, 0);
         $configIndex = $this->CacheDB->Get($service);
         
         if((!isset($configIndex['CacheConfigIndex'])) && ($service == 'www' )){
            $service = 'localhost';
         }         
         $configIndex = $this->CacheDB->Get($service);
         unset($this->CacheDB);
         
         //Logo no CacheConfigDB para descobrir as configs do banco do cliente
         $this->CacheDB = new RedisCli("tcp", "127.0.0.1", 6379, $configIndex['CacheConfigIndex']);
         $myConfig = $this->CacheDB->Get('db_config');                  
         
         
         new \Pixie\Connection('pgsql', 
            array(
              'driver'   => $myConfig['dbdriver'],
              'host'     => $myConfig['hostname'],
              'database' => $myConfig['database'],
              'username' => $myConfig['username'],
              'password' => $myConfig['password'],
              'charset'  => $myConfig['char_set']),'DBConn');
         
         
         //Inicio a instancia do Pixie
         //$this->QB = new \Pixie\QueryBuilder\QueryBuilderHandler( ); // <--Este ultimo parametro é o alias que o QueryBuilder terá
         
         
         
         
      
      }
      
   }
