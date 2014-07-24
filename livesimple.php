<?php 

// URL : http://127.0.0.1/live.php?league=Premiere%20Leaxgue&tournament=2010/2011

// si rien affecté sur l'url de base .. Premier League est affichés par defaut .. 
$REQUESTED_League = "Premier League";

// TRAITEMENT URL, on demande que la league et la date de la league sur l'URL..
if(isset($_GET["league"])) 
	{
		$REQUESTED_League = $_GET["league"];

		if(isset($_GET["tournament"])) 
		{
			$REQUESTED_Tournament_Date = $_GET["tournament"];
			
		}
	}


// chargement fichier XML sur un ARRAY
$DATA = simplexml_load_file("https://raw.githubusercontent.com/J3K/GitHub-REPO/master/live.xml");


// demande de la league X " Premier League" ou "LIGA BBVA" deja transmise dans l'URL
$X = getRequestedLeague($DATA,$REQUESTED_League);


echo "REQUESTED_League : b JSON ".$REQUESTED_League;

echo "<pre>";
print_r(json_encode(array($X)));
echo "</pre>";
// affichage Array retournée par getRequestedLeague($DATA,$REQUESTED_League);
//echo "<pre>";
//print_r($X);
//echo "</pre>";





function getRequestedLeague($DATA,$REQUESTED_League){

	foreach($DATA->liveevents as $le){

		if($le["league"] == $REQUESTED_League) return $le;

	}

}





?>