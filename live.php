<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$DATA = simplexml_load_file("live.xml");
$X = null;

$app->contentType('application/json');
$app->get("/:compet/", function ($compet) use ($DATA,$X) {

    foreach($DATA->liveevents as $le){
		if($le["league"] == $compet) $X = $le;
	}


print_r(json_encode(array($X),JSON_PRETTY_PRINT));

});

$app->get("/:compet/:date", function ($compet,$date) use ($DATA,$X) {

    foreach($DATA->liveevents as $le){
		if($le["league"] == $compet && $le["ut"] == $date) $X = $le;
	}


print_r(json_encode(array($X),JSON_PRETTY_PRINT));

});


$app->get("/:compet/:date/:heurematch", function ($compet,$date,$hour) use ($DATA,$X) {

    foreach($DATA->liveevents as $le){
		if($le["league"] == $compet && $le["ut"] == $date)
			foreach($le->liveevent as $nodeliveevent) 
			{
			 	if($nodeliveevent["date"] == "$date $hour") $X = $nodeliveevent;
			}
	}

print_r(json_encode(array($X),JSON_PRETTY_PRINT));

});


$app->get("/:compet/:date/:heurematch/:nomequipe", function ($compet,$date,$hour,$nomequipe) use ($DATA,$X) {

    foreach($DATA->liveevents as $le){
		if($le["league"] == $compet && $le["ut"] == $date)
			foreach($le->liveevent as $node) 
			{
				if($node["date"] == "$date $hour") 
			 		foreach($node->results as $noderesults) 
					{
					 	if($noderesults["participantname"] == "$nomequipe") $X = $noderesults;
					}
			}
	}

print_r(json_encode(array($X),JSON_PRETTY_PRINT));

});



$app->run();


?>