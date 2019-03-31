<?php 
	$result = "";
	$route = $_GET["chosen"];
	$problem = FALSE;
	if (empty($route)||$route == "undefined") {
		$problem = True;
	}
	if ($problem) {
		echo "Invalid Arguments";
	} else {
		$file = fopen("stops.csv", "r");
		$line = "";
		while (!feof($file)) {
			$line = fgetcsv($file);
			if (strpos($line[19], ',') !== false) {
				$pieces = explode(",", $line[19]);
				for ($x = 0; $x < count($pieces); $x++) {
					if ($pieces[$x] == $route) {
						$result = $result.$line[7].
						"*".$line[8]."*".$line[3].
						"?";
					}
				}
			} else {
				if ($line[19] == $route) {
					$result = $result.$line[7].
					"*".$line[8]."*".$line[3].
					"?";
				}
			}
		}
	fclose($file);
	echo $result;
}?>
