<?php
   /*
    * Arquivo que contem a abstração de comunicação com o DB NoSQL Redis
    */
require "predis/autoload.php";

class RedisCli {
   
   private $redis = '';
   
   private $connected = false;
   
   public function isConnected(){
      return $this->connected;
   }
   
   public function __construct($protocol="tcp", $host="127.0.0.1", $port=6379, $dbIndex=0){
      
      Predis\Autoloader::register();
      
      //Tento me conectar ao Redis
      try{
         
         $this->redis = new Predis\Client(array(
           "scheme"   => $protocol,
           "host"     => $host,
           "port"     => $port,
           "database" => $dbIndex));           
         
         $this->connected = true;
         
      }catch(Exception $e){
         
         $this->connected = false;
         
         die($e->getMessage());
      }
   }
   
   public function Get($key=""){
      
      if (!$this->isConnected()){
         
         die("Não conectado ao redis-server \n");
         
      }else if($key == ""){
         
         die("Chave não pode ser vazia");
         
      }else{
         
         if (!$this->redis->exists($key)){
            
            return "";
            
         }else{
            
            return $this->redis->hgetall($key);
            
         }
         
      }
      
      
   }
   
   public function Insert($key="", $value=array()){
      
      if (!$this->isConnected()){
         
         die("Insert: Não conectado ao redis-server \n");
         
      }else if($key == ""){
         
         die("Chave não pode ser vazia");
         
      }else{
         
         try{
            
            $this->redis->hmset($key, $value);
            
         }catch(Exception $e){
            
            die($e->getMessage());
            
         }
         
      }
      
      
   }
   
   public function Del($key=""){
      
      if (!$this->isConnected()){
         
         die("Del: Não conectado ao redis-server \n");
         
      }else if($key == ""){
         
         die("Chave não pode ser vazia");
         
      }else{
         
         try{
            
            $this->redis->del($key);
            
         }catch(Exception $e){
            
            die($e->getMessage());
            
         }
         
      }
      
      
   }   
   
   public function FlushDb($dbIdx = ''){
      
      $this->redis->flushdb();
      
   }
   
   public function GetAll($patt='*'){
      
      $Digest = array();
      
      $keys = $this->redis->keys($patt);
      $keysLen = count($keys);
      
      for( $i = 0; $i < $keysLen; $i++){
         $Digest[$keys[$i]] = $this->Get($keys[$i]);
      }
      ksort($Digest);
      return $Digest;
   }
   
}

if (!debug_backtrace()){
   //exec via shell apenas pode ser feita para casos em que o Redis esta local
   if ($argc >= 3){
            
      $reg = new RedisCli();
      
      if ($argv[1] == "get"){
         
         print_r($reg->Get($argv[2]));
         
      }else if ($argv[1] == "insert"){
         
         $reg->Insert($argv[2], (array) $argv[3] );
         
         print("Inseriu chave: " . $argv[3] );
         
      }else if ($argv[1] == "del"){
         
         $reg->Del($argv[2]);
         
         print("Excluiu chave: " . $argv[3] . "\n");
         
      }
      
   }
}
