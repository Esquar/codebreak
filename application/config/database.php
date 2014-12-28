<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/
//$active_group = 'www';


$active_record = TRUE;
   
if (CACHED_ENV_NAME != ''){
   //die(BASEPATH);
   require_once( str_replace('system/', 'application/models/redis.php', BASEPATH) );

   $CacheDB = null;

   try{
      //inicializo o Redis no DB de configuração referente ao ambiente que estou carregando o DB

      $CacheDB = new RedisCli("tcp", "127.0.0.1", 6379, CACHED_ENV_CONFIG);
      
      $myConfig = $CacheDB->Get('db_config');

      $db[CACHED_ENV_NAME]['hostname'] = $myConfig['hostname'];
      $db[CACHED_ENV_NAME]['username'] = $myConfig['username'];
      $db[CACHED_ENV_NAME]['password'] = $myConfig['password'];
      $db[CACHED_ENV_NAME]['database'] = $myConfig['database'];
      $db[CACHED_ENV_NAME]['dbdriver'] = $myConfig['dbdriver'];
      $db[CACHED_ENV_NAME]['dbprefix'] = $myConfig['dbprefix'];
      $db[CACHED_ENV_NAME]['pconnect'] = $myConfig['pconnect'];
      $db[CACHED_ENV_NAME]['db_debug'] = $myConfig['db_debug'];
      $db[CACHED_ENV_NAME]['cache_on'] = $myConfig['cache_on'];
      $db[CACHED_ENV_NAME]['cachedir'] = $myConfig['cachedir'];
      $db[CACHED_ENV_NAME]['char_set'] = $myConfig['char_set'];
      $db[CACHED_ENV_NAME]['dbcollat'] = $myConfig['dbcollat'];
      $db[CACHED_ENV_NAME]['swap_pre'] = $myConfig['swap_pre'];
      $db[CACHED_ENV_NAME]['autoinit'] = $myConfig['autoinit'];
      $db[CACHED_ENV_NAME]['stricton'] = $myConfig['stricton'];
      $db[CACHED_ENV_NAME]['port']     = $myConfig['port']    ;
      
      unset($CacheDB);
      $active_group = CACHED_ENV_NAME;
      
      
   }catch(Exception $ex){
      die($ex.getMessage());
   }   
   
   
}else{
/*
   $db['www']['hostname'] = 'localhost';
   $db['www']['username'] = 'postgres';
   $db['www']['password'] = 'teste';
   $db['www']['database'] = 'master';
   $db['www']['dbdriver'] = 'postgre';
   $db['www']['dbprefix'] = '';
   $db['www']['pconnect'] = true;
   $db['www']['db_debug'] = true;
   $db['www']['cache_on'] = false;
   $db['www']['cachedir'] = '';
   $db['www']['char_set'] = 'utf8';
   $db['www']['dbcollat'] = 'utf8_general_ci';
   $db['www']['swap_pre'] = '';
   $db['www']['autoinit'] = TRUE;
   $db['www']['stricton'] = FALSE;
   $db['www']['port']     = 5432;


   $db['teste1']['hostname'] = 'localhost';
   $db['teste1']['username'] = 'felipe';
   $db['teste1']['password'] = 'c0debre4k123';
   $db['teste1']['database'] = 'felipe_teste1';
   $db['teste1']['dbdriver'] = 'postgre';
   $db['teste1']['dbprefix'] = '';
   $db['teste1']['pconnect'] = true;
   $db['teste1']['db_debug'] = true;
   $db['teste1']['cache_on'] = false;
   $db['teste1']['cachedir'] = '';
   $db['teste1']['char_set'] = 'utf8';
   $db['teste1']['dbcollat'] = 'utf8_general_ci';
   $db['teste1']['swap_pre'] = '';
   $db['teste1']['autoinit'] = TRUE;
   $db['teste1']['stricton'] = FALSE;
   $db['teste1']['port']     = 5432;

   $db['videotec']['hostname'] = 'localhost';
   $db['videotec']['username'] = 'felipe';
   $db['videotec']['password'] = 'c0debre4k123';
   $db['videotec']['database'] = 'felipe_videotec';
   $db['videotec']['dbdriver'] = 'postgre';
   $db['videotec']['dbprefix'] = '';
   $db['videotec']['pconnect'] = true;
   $db['videotec']['db_debug'] = true;
   $db['videotec']['cache_on'] = false;
   $db['videotec']['cachedir'] = '';
   $db['videotec']['char_set'] = 'utf8';
   $db['videotec']['dbcollat'] = 'utf8_general_ci';
   $db['videotec']['swap_pre'] = '';
   $db['videotec']['autoinit'] = TRUE;
   $db['videotec']['stricton'] = FALSE;
   $db['videotec']['port']     = 5432;

   if(!defined('SITE')){
      die("Erro ao carregar ambiente. Favor contate o administrador!");
   }
   //die('--->>> ' . SITE);
   if(!array_key_exists(SITE, $db) ){
      die("Sub-Domínimo não reconhecido = " + SITE);
   }

   $active_group = ( defined('SITE') && array_key_exists(SITE, $db) ) ? SITE : 'www';
*/

}


/* End of file database.php */
/* Location: ./application/config/database.php */
