<?php
	header("Content-Type: text/html;charset=utf-8");
	
	function throwError($str){
		global $error;
		global $form;
		global $exit;
		global $err_display;
		$err_display = 'block';
		$error = $str;
		$form = 'none';
		$exit = 'none';
	}

	function checkUser($user){
		global $username;
		global $form;
		global $exit;
		if ($user) {
			$username = $user['username'];
			$form = 'none';
			$exit = 'block';
		}else{
			throwError('Invalid login or password');
		}
	}

	$link = mysqli_connect('localhost', 'root', '', 'random_site');
	$username = 'guest';
	$form = 'block';
	$exit = 'none';
	$err_display = 'none';
	if (isset($_COOKIE['user_hash'])) {
		$hash = $_COOKIE['user_hash'];
		$data = mysqli_query($link, "SELECT id, username FROM users WHERE hash = '$hash'");
		if (!$data) {
			throwError('Invalid login or password');
		}else{
			$user = mysqli_fetch_assoc($data);
			$hash = $user['hash'];
			checkUser($user);
			// setcookie('user_hash', $hash, time() + 3600*24*30, '/');
		}
	}elseif (isset($_POST['login_email']) && isset($_POST['login_password'])) {
		$email = $_POST['login_email'];
		$password = $_POST['login_password'];
		$data = mysqli_query($link, "SELECT id, username, hash FROM users WHERE email = '$email' AND password = '$password'");
		if (!$data) {
			echo mysqli_error($link);
			throwError('Invalid login or password');
		}else{
			$user = mysqli_fetch_assoc($data);
			$hash = $user['hash'];
			checkUser($user);
			setcookie('user_hash', $hash, time() + 3600*24*30, '/');
		}
	}elseif (isset($_POST['signin_username'])) {
		$password = $_POST['signin_password'];
		$repeat_password = $_POST['signin_repeat_password'];
		$email = $_POST['signin_email'];
		$name = $_POST['signin_username'];
		if ($password == $repeat_password) {
			$data = mysqli_query($link, "SELECT email FROM users");
			while ($temp = mysqli_fetch_assoc($data)) {
				$emails[] = $temp['email'];
			}
			if ($emails) {
				if (in_array($email, $emails)) {
					throwError('An account with the same email already exists');
				}else{
					$hash = md5(time().$email);
					$data = mysqli_query($link, "INSERT INTO users VALUES (default, '$hash', '$name', '$password', '$email')");
				}
			}else{
				$hash = md5(time().$email);
				$data = mysqli_query($link, "INSERT INTO users VALUES (default, $hash, $name, $password, $email)");
				echo mysqli_error($link);
			}
			
		}else{
			throwError('Password is repeated incorrectly');
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
	<h1>Hello, <?=$username?></h1>
	<form id="login" method="POST" style="display: <?=$form?>">
		<label>
			<span>E-mail</span>
			<input type="email" name="login_email" required>
		</label>
		<label>
			<span>Password</span>
			<input type="password" name="login_password" required>
		</label>
		<input type="submit" name="login" value="Log In">
	</form>
	<form id="signin" method="POST" style="display: <?=$form?>">
		<label>
			<span>Name</span>
			<input type="text" name="signin_username" required>
		</label>
		<label>
			<span>E-mail</span>
			<input type="email" name="signin_email" required>
		</label>
		<label>
			<span>Password</span>
			<input type="password" name="signin_password" required>
		</label>
		<label>
			<span>Repeat password</span>
			<input type="password" name="signin_repeat_password" required>
		</label>
		<input type="submit" name="signin" value="Sign In">
	</form>
	<a href="logout.php" style="display: <?=$exit?>">Log Out</a>
	<div style="display: <?=$err_display?>">
		<?=$error?><br>
		<a href=".">Go to home page</a>
	</div>
</body>
</html>