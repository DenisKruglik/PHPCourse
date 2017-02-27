<?php
	header("Content-Type: text/html;charset=UTF-8");
	
	#task 1

	$people = file_get_contents("http://retarcorp.by/edu/php/data.csv");
	$people = explode("\n", $people);
	$firstrow = explode(";", array_shift($people));
	$person_length = count($firstrow);
	$people_length = count($people);
	for ($i = 0; $i < $people_length; $i++) { 
		$people[$i] = explode(";", $people[$i]);
		for ($j=0; $j < $person_length; $j++) { 
			$people[$i][$firstrow[$j]] = $people[$i][$j];
			unset($people[$i][$j]);
		}
	}
	for ($i = 0; $i < $people_length; $i++) { 
		$people[$i]["name"]=explode(" ", $people[$i]["name"]);
		$people[$i]["name"]["last_name"] = $people[$i]["name"][0];
		$people[$i]["name"]["first_name"] = $people[$i]["name"][1];
		$people[$i]["name"]["third_name"] = $people[$i]["name"][2];
		for ($j = 0; $j < 3; $j++) { 
			unset($people[$i]["name"][$j]);
		}
	}
	array_pop($people);


	$res = array();
	foreach ($people as $key => $value) {
		if ((($_GET["prof"] == $value["job"]) || ($_GET["prof"] == "")) && ($_GET["age_from"] <= $value["age"]) && ($value["age"] <= $_GET["age_to"]) && ($_GET["balance_from"] <= $value["balance"]) && ($value["balance"] <= $_GET["balance_to"])) {
			$res[] = implode(" ", $value["name"]).", ".$value["age"]." лет, баланс: ".$value["balance"];
		}
	}
	$res = implode("\n", $res);

	#task2

	function checkName($name,$len,$ind){
		if (in_array($name, scandir("files"))) {
			$arr = array_count_values(scandir("files"));
			$name = substr_replace($name, "(".$ind.")", strpos($name, ".")-$len, $len);
			$len = 3;
			$ind++;
			return in_array($name, scandir("files")) ? checkName($name,$len,$ind) : $name;
		}else{
			return $name;
		}
	}

	if ($_FILES["my_file"]["type"] == "image/jpeg" || $_FILES["my_file"]["type"] == "image/png") {
		$file_location = "files/".checkName($_FILES["my_file"]["name"],0,1);
		copy($_FILES["my_file"]["tmp_name"], $file_location);
		$post = $_POST["name"].";".date("d F Y H:i").";".$_POST["message"].";".$file_location."\n";
		file_put_contents("data.csv", $post, FILE_APPEND);
		header('Location:'.$_SERVER['HTTP_REFERER']);
	}
	$keys = array("name", "date", "message", "file");
	$list = "";
	if (is_file("data.csv")) {
		$posts = file_get_contents("data.csv");
		$posts = explode("\n", $posts);
		array_pop($posts);
		foreach ($posts as $key => $value) {
			$value = explode(";", $value);
			$value = array_combine($keys, $value);
			$list .= "<div class='post'>
				<img src='".$value["file"]."'>
				<span>".$value["name"]."</span><br>
				<span>".$value["date"]."</span>
				<div>".$value["message"]."</div>
			</div>";
		}
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<section class="task1">
		<form>
			<label><span>Профессия</span><input type="text" name="prof"></label>
			<label><span>Возраст от</span><input type="number" name="age_from" required min="0"></label>
			<label><span>Возраст до</span><input type="number" name="age_to" required min="0"></label>
			<label><span>Баланс от</span><input type="number" name="balance_from" required min="0"></label>
			<label><span>Возраст до</span><input type="number" name="balance_to" required min="0"></label>
			<input type="submit" name="submit">
		</form>
		<div class="log">
			<pre><?php print_r($res) ?></pre>
		</div>
	</section>
	<hr>
	<section class="task2">
		<form enctype="multipart/form-data" method="POST">
			<input type="file" name="my_file" multiple="multiple" required/>
			<label>
				<span>Имя: </span>
				<input type="text" name="name" required>
			</label>
			<label>
				<span>Текст: </span>
				<textarea name="message" required></textarea>
			</label>
			<input type="submit" name="submit1"/>
		</form>
		<div class="container"><?php
			echo $list;
		?></div>
	</section>
</body>
</html>