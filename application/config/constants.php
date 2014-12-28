<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							         'rb');
define('FOPEN_READ_WRITE',						      'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		   'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					      'ab');
define('FOPEN_READ_WRITE_CREATE',				   'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				   'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		   'x+b');


//die(BASEPATH);
require_once( str_replace('system/', 'application/models/redis.php', BASEPATH) );

$CacheDB = null;





try{
   //inicializo o Redis no DB 0
   $CacheDB = new RedisCli();
   
   $servicename = $_SERVER['HTTP_HOST'];
   
   if($servicename == 'localhost'){
      $servicename = 'www';
   }
   
   //busco as pre-configs do serviço
   $myConfig = $CacheDB->Get($servicename);
   
   if($myConfig){
         
      //populo as constantes
      
      //nome do ambiente
      define('CACHED_ENV_NAME', $myConfig['EnvName']);      
      
      //indice do CacheDB Estrutural (Compilação)
      define('CACHED_ENV_STRUCT', $myConfig['CacheDBIndex']);
      
      //indice do CacheDB de Configuração
      define('CACHED_ENV_CONFIG', $myConfig['CacheConfigIndex']);
   }else{
      die ('Impossivel identificar serviço: ' . $_SERVER['HTTP_HOST'] );
   }
   
   
   unset($CacheDB);
   
}catch(Exception $ex){
   die($ex.getMessage());
}

if (defined(CACHED_ENV_NAME)){

   define('SITE', CACHED_ENV_NAME);
   
}else{
/*
   switch ($_SERVER['HTTP_HOST']){
      case 'localhost':
         define('SITE', 'www');
      break;
      case 'www.codebreak.com.br':
         define('SITE', 'www');
      break;
      case 'teste1.codebreak.com.br':
         define('SITE', 'teste1');
      break;
      case 'videotec.codebreak.com.br':
         define('SITE', 'videotec');
         break;
      default:
         define('SITE', 'zzz');
      break;
      
   }
*/
}






/* End of file constants.php */
/* Location: ./application/config/constants.php */
