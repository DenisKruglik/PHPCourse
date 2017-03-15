<?php
	$id = intval($_GET["id"]);
	$link = mysqli_connect('localhost', 'root', '', 'test');
	$data = mysqli_query($link, "SELECT img_url FROM goods WHERE id = $id");
	$pic = mysqli_fetch_assoc($data);
	// print_r($pic);
	if (strpos($pic["img_url"], "images/") === 0) {
		unlink($pic["img_url"]);
	}
	$res = mysqli_query($link, "DELETE FROM goods WHERE id=$id");
	header('Location:'.$_SERVER['HTTP_REFERER']);
?>