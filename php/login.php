<!DOCTYPE html>
<html>
<head>
	<title>Input: Login</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class="nav-bar">
		<li><a href="../index.html">Home</a></li>
	</ul>
	<?php
		require_once('utility.php'); //has valid_user() function
		$db = new dbconnection;
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		$user_id = $db->login($username, $password);
		if(!$user_id) {
			echo '<p>User is not valid</p>';
		} else {
			echo "<p>User is valid</p>";
			session_start();
			$type = $db->get_usertype($user_id);
			if($type == 'diner') {
				$_SESSION["grub_diner"] = new diner($username, $user_id);
				header('Location: diner_homepage.php');
			} elseif($type == 'restaurant') {
				$_SESSION["grub_restaurant"] = new restaurant($username, $password);
				header('Location: restaurant_homepage.php');
			}
			
		}
	?>
</body>
</html>