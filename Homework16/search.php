<?php

	require_once "goods_model.php";

	header("Content-Type: text/html; charset=utf-8");

	$model = new GoodsModel();

	$data = $model->search($_GET['title'], $_GET['from'], $_GET['to']);

	foreach ($data as $item) {
		$res[] = array('title' => $item->getTitle(), 'image' => $item->getImage(), 'description' => $item->getDescription(), 'price' => $item->getPrice());
	}

	$res = json_encode($res);

	echo $res;

?>