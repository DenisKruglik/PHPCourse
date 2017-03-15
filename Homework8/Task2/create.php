<?php
	function checkName($name,$len,$ind){
		if (in_array($name, scandir("images"))) {
			$arr = array_count_values(scandir("images"));
			$name = substr_replace($name, "(".$ind.")", strpos($name, ".")-$len, $len);
			$len = 3;
			$ind++;
			return in_array($name, scandir("images")) ? checkName($name,$len,$ind) : $name;
		}else{
			return $name;
		}
	}

	if(isset($_POST["title"]) && ($_FILES["pic"]["type"] == "image/jpeg" || $_FILES["pic"]["type"] == "image/png")){
		$file_location = "images/".checkName($_FILES["pic"]["name"],0,1);
		copy($_FILES["pic"]["tmp_name"], $file_location);
		$link = mysqli_connect('localhost', 'root', '', 'test');
		$res = mysqli_query($link, "INSERT INTO goods VALUES(default, '{$_POST['title']}', {$_POST['price']}, {$_POST['weight']}, '$file_location', '{$_POST['description']}')");
		if (!$res) {
			$err = mysqli_error($link);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="styles/create.css">
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<input type="file" name="pic" required>
		<label>
			<span>Title</span>
			<input type="text" name="title" required>
		</label>
		<label>
			<span>Price</span>
			<input type="number" name="price"
			min="0" step="any" required>
		</label>
		<label>
			<span>Weight</span>
			<input type="number" name="weight" step="any" required>
		</label>
		<label>
			<span>Description</span>
			<textarea name="description" required></textarea>
		</label>
		<input type="submit" value="Submit" name="submit">
	</form>
	<div class="home"><a href="index.php">Back home</a></div>
	<p><?=$err?></p>
</body>
</html>