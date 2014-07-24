<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

 	
$app->get("/:id", function ($id) {
    echo "<h1>Hello World".$id."</h1>";
});



$app->run();


?>