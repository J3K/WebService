<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$DATA = simplexml_load_file("https://raw.githubusercontent.com/J3K/GitHub-REPO/master/live.xml");
$X = null;

 	
$app->get("/:compet/", function ($compet) use ($DATA,$X) {

    foreach($DATA->liveevents as $le){
		if($le["league"] == $compet) $X = $le;
	}


echo "<pre>";
print_r(json_encode(array($X)));
echo "</pre>";

});

$app->get("/:compet/:date", function ($compet,$date) use ($DATA,$X) {

    foreach($DATA->liveevents as $le){
		if($le["league"] == $compet && $le["ut"] == $date) $X = $le;
	}


echo "<pre>";
print_r(json_encode(array($X)));
echo "</pre>";

});


$app->get("/:compet/:date/:heurematch", function ($compet,$date,$hour) use ($DATA,$X) {

    foreach($DATA->liveevents as $le){
		if($le["league"] == $compet && $le["ut"] == $date)
			foreach($le->liveevent as $nodeliveevent) 
			{
			 	if($nodeliveevent["date"] == "$date $hour") $X = $nodeliveevent;
			}
	}

echo "<pre>";
print_r(json_encode(array($X)));
echo "</pre>";

});


$app->get("/:compet/:date/:heurematch/:nomequipe", function ($compet,$date,$hour,$nomequipe) use ($DATA,$X) {

    foreach($DATA->liveevents as $le){
		if($le["league"] == $compet && $le["ut"] == $date)
			foreach($le->liveevent as $node) 
			{
				if($node["date"] == "$date $hour") 
			 		foreach($node->results as $noderesults) 
					{
						echo $noderesults["participantname"];
					 	if($noderesults["participantname"] == "$nomequipe") $X = $noderesults;
					}
			}
	}

echo "<pre>";
print_r(json_encode(array($X)));
echo "</pre>";

});









$app->run();


?>