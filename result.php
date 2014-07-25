<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$DATA = simplexml_load_file("result.xml");
$X = null;

$app->contentType('application/json');
// First Parameter ... user can set CompetionName (Premier League, Liga BBVA ...)  or Date (2011-03-01, ...)
$app->get("/:compet", function ($compet) use ($DATA,$X) {

$i=0;
if(validateDate($compet)){

	foreach($DATA->events as $e){
		if($e["ut"] == $compet) { $X[$i] = $e; $i++; }
	}

} else {

	foreach($DATA->events as $e){
		if($e["league"] == $compet) $X = $e;
	}

}

print_r(json_encode(array($X),JSON_PRETTY_PRINT));

return json_encode(array($X)).".json";

});





// First Parameter + Second Parameter
$app->get("/:compet/:date", function ($compet,$date) use ($DATA,$X) {

    foreach($DATA->events as $e){
		if($e["league"] == $compet && $e["ut"] == $date) $X = $e;
	}


print_r(json_encode(array($X),JSON_PRETTY_PRINT));

});



function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

$app->run();


?>