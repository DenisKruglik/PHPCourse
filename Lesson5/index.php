<?php
	header("Content-Type: text/html");

	// $img = imagecreatefrompng("eye.png");
	// // imagejpeg($img, "res/eye2.jpeg");
	// imagejpeg($img);



	// $img = imagecreatetruecolor(500, 500);
	// for ($i=0; $i < 500; $i++) { 
	// 	for ($j=0; $j < 500; $j++) { 
	// 		$color = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
	// 		imagesetpixel($img, $j, $i, $color);
	// 	}
	// }
	// imagejpeg($img, "colorfulnoise.jpg", 100);

	// $img1 = imagecreatetruecolor(500, 500);
	// for ($i=0; $i < 500; $i++) { 
	// 	for ($j=0; $j < 500; $j++) { 
	// 		$tone = rand(0,255);
	// 		$color = imagecolorallocate($img1, $tone, $tone, $tone);
	// 		imagesetpixel($img1, $j, $i, $color);
	// 	}
	// }
	// imagejpeg($img1, "monochromenoise.jpg", 100);

	// $img2 = imagecreatetruecolor(500, 500);
	// $step = 500/$_GET["accuracy"];
	// $white = imagecolorallocate($img2, 255, 255, 255);
	// imagefill($img2, 250, 250, $white);
	// $color = imagecolorallocate($img2, 0, 0, 0);
	// $y1 = 0;
	// for ($i=0; $i < 500; $i+=$step) { 
	// 	$y2 = (pow($i, 3)+pow($i, 2)-14*$i+16)/600000;
	// 	imageline($img2, $i, $y1, $i+$step, $y2, $color);
	// 	$y1 = $y2;
	// }
	// imagejpeg($img2, "graph.jpg", 100);


	$str = "info@example.com";
	$matches = array();
	preg_match_all("/([a-zA-Z0-9\-\_\.]{3,})\@([a-z]{2,}\.[a-z]{2,})/", $str, $matches);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<img src="colorfulnoise.jpg">
	<img src="monochromenoise.jpg">
	<img src="graph.jpg">
	<pre><?php print_r($matches) ?></pre>
</body>
</html>