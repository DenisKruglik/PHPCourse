<?php header("Content-Type: text/html; charset=UTF-8");?>
<?php
	// $a=array(1,2,3,4);
	// $b=count($a);
	// for ($i=0; $i < $b; $i++) { 
	// 	$a[]=$a[$i];
	// }
	// print_r($a);


	// $a=array(
	// 	"name" => "Alexey",
	// 	"age" => 10,
	// 	"children" => 7);
	// $a[]=1;
	// $a[]=1;
	// $a[]=1;
	// print_r($a);


	// function fact($a){
	// 	return $a==0 ? 1 : $a*fact($a-1);
	// }
	// echo fact(5);


	// function compare($a, $b){
	// 	if ($b%4 < $a%4) {
	// 		return -1;
	// 	}else{
	// 		return 1;
	// 	}
	// }

	// $a=array(1,6,18,37,25,10);
	// usort($a, "compare");
	// print_r($a);


	$s=file_get_contents("lorem.txt");
	$arr=explode(" ", $s);
	$len=count($arr);
	$new=array();
	for ($i=0; $i < $len; $i++) { 
		if (strlen($arr[$i])>=3) {
			array_push($new, $arr[$i]);
		}
	}
	function compare($a,$b){
		if (strlen($a) > strlen($b)) {
			return -1;
		}else return 1;
	}
	usort($new, "compare");
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<pre><?php print_r($new); ?></pre>
</body>
</html>