<?php
	$link = mysqli_connect('localhost', 'root', '', 'test');
	$req = trim($_GET["req"]);
	if (strpos(strtoupper($req), "SELECT ") === 0) {
		$data = mysqli_query($link, $req);
		if ($data == false && mysqli_error($link) != "") {
			$err = mysqli_error($link);
		}elseif ($data != false) {
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
				$tbody  .= "</tr>";
			}
			$table .= "<table>$thead$tbody</table>";
		}
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form action="">
		<textarea name="req"></textarea>
		<input type="submit" name="">
	</form>
	<?php
		echo $table;
	?>
	<p class="error"><?=$err ?></p>
</body>
</html>