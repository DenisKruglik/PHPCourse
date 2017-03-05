<?php
	#1

	$num = trim($_GET["num"]); 
	$exp = "/([375\+]{3,4})\s*\-*(\d{2})\-*\s*(\d{2})\-*\s*(\d{2})\-*\s*(\d{3})/"; 
	$matches = array(); 
	preg_match_all($exp, $num, $matches);

	#2

	$input = trim($_GET["input"]); 
	$string = "/([httpsw]{2,5})\:\/\/([A-Za-z0-9]{3,})\.*([a-z]*)\.([a-z]{2,})\/*([A-Za-z0-9\/]*)\/*\?*([\w\=\-\+\&\%]*)\#*([\w]*)/"; 
	$matches1 = array(); 
	preg_match_all($string, $input, $matches1);
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form>
		<input type="text" name="num">
		<input type="submit" value="submit">
	</form>
	<pre><?php print_r($matches) ?></pre>
	<form>
		<input type="text" name="input">
		<input type="submit" value="submit">
	</form>
	<pre><?php print_r($matches1) ?></pre>
</body>
</html>