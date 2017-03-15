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
</head>
<body>
	<pre><?php print_r($info) ?></pre>
	<h1><?=$info["title"] ?></h1>
	<img src="<?=$info['img_url'] ?>">
</body>
</html>