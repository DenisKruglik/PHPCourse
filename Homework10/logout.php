<?php
	setcookie('user_hash', '', time() - 1, '/');
	header('Location:'.$_SERVER['HTTP_REFERER']);
?>