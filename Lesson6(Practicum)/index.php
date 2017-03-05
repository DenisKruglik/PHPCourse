<?php
	header("Content-Type: text/html;charset=utf-8");
	$content = json_decode(file_get_contents('data'), true);
	
	function insertGenres($x){
		foreach ($x as $key => $value) {
			$res += "<li>
				{$value['name']}
				<ul>".insertArtists($value["artists"])."</ul>
			</li>";
		}
		return $res;
	}

	function insertArtists($x){
		foreach ($x as $key => $value) {
			$res += "<li>
				$key
				<ul>".insertReleases($value["releases"])."</ul>
			</li>";
		}
		return $res;
	}

	function insertReleases($x){
		foreach ($x as $key => $value) {
			$res += "<li>{$value[$key]['name']} ({$value[$key]['type']})</li>";
		}
		return $res;
	}

	$list = "<ul>".insertGenres($content)."</ul>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?=$list ?>
	<pre><?php print_r($content) ?></pre>
</body>
</html>