<?php
	$link = mysqli_connect('localhost', 'root', '', 'test');
	$data = mysqli_query($link, "SELECT * FROM goods");
	while ($temp = mysqli_fetch_assoc($data)) {
		$res[] = $temp;
	}
	foreach ($res as $key => $value) {
		$list .= "<div class='good'>
			<h3>{$value["title"]}</h3>
			<img src='{$value["img_url"]}'></img>
			<figure>
				<p>Price: {$value["price"]}$</p>
				<p>Weight: {$value["weight"]} kg</p>
				<a href='details.php?id={$value["id"]}'>More info...</a>
			</figure>
		</div>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<a class="refs" href="create.php"><input type="button" value="Add a good"></a>
	<a class="refs" href="manage.php"><input type="button" value="Content manager"></a>
	<div class="wrapper"><?=$list ?></div>
</body>
</html>