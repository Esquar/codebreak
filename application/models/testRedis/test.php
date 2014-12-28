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

if ($redis->exists("taxi_car")) {
      if ($redis->exists("taxi_car")){
      die("ops, erro... ainda existe estachave mesmo antes de eu tentar exclui-la");
   }
}else{
   echo "nao deletou";
}

$aaa = array("teste", "teste2");

/*
$redis->hmset("taxi_car", array(
    "brand" => "Toyota",
    "model" => "Yaris",
    "license number" => "RO-01-PHP",
    "year of fabrication" => 2010,
    "nr_stats" => 0
 
    )
);
*/
print "começou: " . strtotime("now") . "\n";
$i = 1;
while($i <= 1000){
   $redis->del("a" . $i);
   print("del a" . $i . "\n");
   $i++;
}
print "terminou: " . strtotime("now") . "\n";
