<?php
	header("Content-Type: text/html;charset=UTF-8");
	// header("Content-Type: image/jpeg");
	// $image = file_get_contents("orange.jpg");
	// echo $image;


	// switch ($_POST["act"]) {
	// 	case '+':
	// 		$res = $_POST["a"]+$_POST["b"];
	// 		break;
	// 	case '-':
	// 		$res = $_POST["a"]-$_POST["b"];
	// 		break;
	// 	case '/':
	// 		$res = $_POST["a"]/$_POST["b"];
	// 		break;
	// 	case '%':
	// 		$res = $_POST["a"]%$_POST["b"];
	// 		break;
	// }


	// file_put_contents("data.csv", $_GET['name'].";".$_GET['age'].";".$_GET['wage']."\n", FILE_APPEND);

	foreach ($_FILES["my_file"] as $key => $value) {
		copy($_FILES["my_file"]["tmp_name"], "files/".$_FILES["my_file"]["name"]);
	}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- <form method="POST">
		<input type="number" name="a">
		<input type="number" name="b">
		<select name="act">
			<option value="+">+</option>
			<option value="-">-</option>
			<option value="/">/</option>
			<option value="%">%</option>
		</select>
		<input type="submit" name="submit">
	</form>
	<div>Result: <?=$res ?></div> -->

	<!-- <form action="">
		<label for=""><span>Имя</span><input type="text" name="name"></label>
		<label for=""><span>Возраст</span><input type="number" min="0" max="100" name="age"></label>
		<label for=""><span>З/п</span><input type="number" min="0" name="wage"></label>
		<input type="submit" name="submit" value="Добавить">
	</form> -->

	<form enctype="multipart/form-data" method="POST">
		<input type="file" name="my_file" multiple="multiple" />
		<input type="submit" name="submit"/>
	</form>
	<pre><?php print_r($_FILES); ?></pre>
</body>
</html>