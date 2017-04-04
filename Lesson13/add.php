<?php
	require_once "comments_model.php";

	$comment = new Comment(date("H:i:s"), $_POST['text']);
	$model = new CommentsModel();
	$model->putComment($comment);
	header("Location: index.php");
?>