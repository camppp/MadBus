<?php 
	$result = "";
	$stop_id = $_GET["id"];

	$file = fopen("stops.csv", "r");
	$line = "";
	while (!feof($file)) {
		$line = fgetcsv($file);
		if ($line[3] == $stop_id) {
			$result = $line[5];
		}
	}
	fclose($file);
	echo $result;
?>
