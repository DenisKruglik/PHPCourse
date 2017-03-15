<?php
	$id = intval($_GET["id"]);
	if (isset($_POST["title"])) {
		$link = mysqli_connect('localhost', 'root', '', 'test');
		$res = mysqli_query($link, "UPDATE goods
			SET title = '{$_POST["title"]}',
				price = {$_POST["price"]},
				weight = {$_POST["weight"]},
				description = '{$_POST["description"]}'
			WHERE id=$id");
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
	<form method="POST">
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