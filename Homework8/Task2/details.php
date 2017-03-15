<?php
	$id = intval($_GET["id"]);
	$link = mysqli_connect('localhost', 'root', '', 'test');
	$data = mysqli_query($link, "SELECT * FROM goods WHERE id=$id");
	while ($temp = mysqli_fetch_assoc($data)) {
		$res[] = $temp;
	}
	$info = $res[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="styles/details.css">
</head>
<body>
	<h1><?=$info["title"] ?></h1>
	<img src="<?=$info['img_url'] ?>">
	<figure>
		<p>Price: <?=$info["price"]?>$</p>
		<p>Weight: <?=$info["weight"]?> kg</p>
		<span>Description:</span>
		<div><?=$info["description"]?></div>
	</figure>
	<div class="home"><a href="index.php">Back home</a></div>
</body>
</html>