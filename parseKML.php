<?php
	$route = $_GET["route"];
	$startIndex = 0;
    $query = '<SimpleData name="route_short_name">'.$route.'</SimpleData>';
	$file = fopen("assets/Metro_Transit_Bus_Routes.kml", "r");
	$line = "";
	$count = 0;
	$lines = array();
	while (!feof($file)) {
		$line = fgets($file);
		$lines[$count] = $line;
		if(strpos($line, $query) !== false){
		    $startIndex = $count;
		}
		$count ++;
	}
	fclose($file);
	echo $lines[$startIndex + 4];
?>