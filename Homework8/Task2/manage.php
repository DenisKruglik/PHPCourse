<?php
	$link = mysqli_connect('localhost', 'root', '', 'test');
	$data = mysqli_query($link, "SELECT * FROM goods");
	while ($temp = mysqli_fetch_assoc($data)) {
		$res[] = $temp;
	}
	$thead = array_keys($res[0]);
	$thead = implode("</td><td>", $thead);
	$thead = "<thead><tr><td>$thead</td></tr></thead>";
	foreach ($res as $key => $value) {
		$tbody .= "<tr>";
		foreach ($value as $key => $val) {
			$tbody .= "<td>$val</td>";
		}
		$tbody .= "<td><a href='change.php?id={$value['id']}'>Change</a></td>
		<td><a href='delete.php?id={$value['id']}'>Delete</a></td>";
		$tbody  .= "</tr>";
	}
	$table .= "<table>$thead$tbody</table>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="styles/manager.css">
</head>
<body>
	<?=$table ?>
	<div class="home"><a href="index.php">Back home</a></div>
</body>
</html>