<?php

require "/var/www/application/models/abstractCompiler/redis/predis/autoload.php";
Predis\Autoloader::register();
 
// since we connect to default setting localhost
// and 6379 port there is no need for extra
// configuration. If not then you can specify the
// scheme, host and port to connect as an array
// to the constructor.
try {
    $redis = new Predis\Client();
/*
    $redis = new PredisClient(array(
        "scheme" => "tcp",
        "host" => "127.0.0.1",
        "port" => 6379));
*/
    echo "Successfully connected to Redis";
}
catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
}

if ($redis->exists("a1")) {
   $a = $redis->hgetall("a1");
   var_dump($a) . "\n";
}
