<?php
	#1

	$num = trim($_GET["num"]); 
	$exp = "/(\+?375)\s*\-*\s*(\d{2})\s*\-*\s*(\d{2,3})\s*\-*\s*(\d{2})\s*\-*\s*(\d{2,3})/"; 
	$matches = array(); 
	preg_match_all($exp, $num, $matches);
	$res = $matches[1][0]."-".$matches[2][0]."-".$matches[3][0]."-".$matches[4][0]."-".$matches[5][0];

	#2

	$input = trim($_GET["input"]); 
	$string = "/(http|https|ftp|ws)\:\/\/([A-Za-z0-9]{3,})\.*([a-z]*)\.([a-z]{2,})\/*([A-Za-z0-9\/]*)\/*\?*([\w\=\-\+\&\%]*)\#*([\w]*)/"; 
	$matches1 = array(); 
	preg_match_all($string, $input, $matches1);
	if ($matches1[0] != null) {
		$res1 = "Valid URL";
	}else{
		$res1 = "Invalid URL";
	}
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form>
		<span>For telephone number</span>
		<input type="text" name="num">
		<input type="submit" value="submit">
	</form>
	<pre><?=$res ?></pre>
	<form>
		<span>For URL</span>
		<input type="text" name="input">
		<input type="submit" value="submit">
	</form>
	<pre><?=$res1 ?></pre>
</body>
</html>