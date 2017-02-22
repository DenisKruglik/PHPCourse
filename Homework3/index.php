<?php header("Content-Type: text/html; charset=UTF-8");
	function dirsize($path){
		$dir = opendir($path);
		chdir($path);
		$res = 0;
		while ($d = readdir($dir)) {
			if (is_dir($d) && ($d != ".") && ($d != "..")) {
				$res+=dirsize($d);
				chdir("..");
			}else if (!is_dir($d)){
				$res+=filesize($d);
			}
		}
		closedir($dir);
		return $res;
	}

	function deletedir($path){
		$dir = opendir($path);
		chdir($path);
		while ($d = readdir($dir)) {
			if (is_dir($d) && ($d != ".") && ($d != "..")) {
				deletedir($d);
			}else if (!is_dir($d)) unlink($d);
		}
		chdir("..");
		closedir($dir);
		rmdir($path);
	}

	function showdir($path){
		$contents=array();
		$dir = opendir($path);
		chdir($path);
		while ($d = readdir($dir)) {
			if (is_dir($d) && ($d != ".") && ($d != "..")) {
				$contents[$d] = showdir($d);
				chdir("..");
			}else  if (!is_dir($d)) $contents[] = $d;
		}
		closedir($dir);
		return $contents;
	}

	function create_csv($names,$profs,$cities){
		$names = explode("\r\n",file_get_contents($names));
		$profs = explode("\n",file_get_contents($profs));
		$cities = explode("\n",file_get_contents($cities));
		$names_len = count($names);
		$profs_len = count($profs);
		$cities_len = count($cities);
		$people = array();
		foreach ($names as $key => $value) {
			$people[$key]["name"] = $value;
			$people[$key]["job"] = $profs[rand(0,$profs_len-1)];
			$people[$key]["city"] = $cities[rand(0,$cities_len-1)];
			$people[$key]["age"] = rand(0,90);
			$people[$key]["children"] = rand(0,4);
			$people[$key]["balance"] = rand(0,1000000);
		}
		shuffle($people);
		array_unshift($people, array_keys($people[0]));
		foreach ($people as $key => $value) {
			$people[$key] = implode(";", $value);
		}
		$people = implode("\n", $people);
		file_put_contents("data.csv", $people);
		print_r($people);
	}

	// create_csv("names.txt","profs.txt","cities.txt");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<pre><?php create_csv("names.txt","profs.txt","cities.txt") ?></pre>
</body>
</html>