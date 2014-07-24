<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$DATA = simplexml_load_file("https://raw.githubusercontent.com/J3K/GitHub-REPO/master/result.xml");
$X = null;

 	
$app->get("/:compet/", function ($compet) use ($DATA,$X) {

    foreach($DATA->events as $e){
		if($e["league"] == $compet) $X = $e;
	}


echo "<pre>";
print_r(json_encode(array($X)));
echo "</pre>";

});

$app->get("/:compet/:date", function ($compet,$date) use ($DATA,$X) {

    foreach($DATA->events as $e){
		if($e["league"] == $compet && $e["ut"] == $date) $X = $e;
	}


echo "<pre>";
print_r(json_encode(array($X)));
echo "</pre>";

});


?>