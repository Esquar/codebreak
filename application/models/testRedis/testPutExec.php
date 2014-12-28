<?php

require "/var/www/application/models/abstractCompiler/redis/predis/autoload.php";
Predis\Autoloader::register();
 

try {
    $redis = new Predis\Client();
    echo "Successfully connected to Redis";
}
catch (Exception $e) {
    echo "Couldn't connected to Redis";
    echo $e->getMessage();
}
print "começou: " . strtotime("now") . "\n";


$redis->hmset("a1", array(
                     "k" => "1",
                     "v" => "a1"
                  )
            );
               

print "terminou: " . strtotime("now") . "\n";
