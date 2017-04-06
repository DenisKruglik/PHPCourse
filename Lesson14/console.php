<?php
	$link = mysqli_connect('localhost', 'host1316886_u2', 'cdugJmYT', 'host1316886_db2');
	$req = trim($_POST["req"]);
	if ($_POST["req"] !== null) {
		$data = mysqli_query($link, $req);
		$err = $link->error;
		if (strpos(strtoupper($req), "SELECT ") === 0 && $data != false) {
			while ($temp = mysqli_fetch_assoc($data)) {
				$res[] = $temp;
			}
			if ($res !== null) {
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
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="console_style.css">
</head>
<body>
	<form action="" method="post">
		<textarea name="req"><?=$req?></textarea>
		<input type="submit" name="">
	</form>
	<?php
		echo $table;
	?>
	<p class="error"><?=$err ?></p>
</body>
</html>