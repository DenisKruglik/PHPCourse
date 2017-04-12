<?php
	header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form>
		<div>
			<label>
				<span>Название</span>
				<input type="text" name="title" id="title">
			</label>
		</div>
		<div>
			<label>
				<span>Цена от</span>
				<input type="number" name="from" min="0" step="0.01" id="from">
			</label>
		</div>
		<div>
			<label>
				<span>Цена до</span>
				<input type="number" name="to" min="0" step="0.01" id="to">
			</label>
		</div><input type="button" name="submit" value="Искать" id="search">
	</form>
	<div class="goods">
		
	</div>
	<script type="text/javascript" src="scripts/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>