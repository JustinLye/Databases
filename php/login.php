<!DOCTYPE html>
<html>
<head>
	<title>Input: Login</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<?php session_start() ?>
	<ul class="nav-bar">
		<li><a href="../index.html">Home</a></li>
	</ul>
	<div class="usr-form">
		<form action="login.php" method="post" id="user_login">
			<table>
				<tr>
					<td>User Name</td>
					<td><input type="text" name="username" placeholder="Enter User Name..." /></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password" placeholder="Enter Password..." /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Login" /></td>
				</tr>
			</table>
		</form>
	</div>	
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			//require_once('utility.php'); //has valid_user() function
			require_once('../../../.php/.grub.php');
			$db = new grub_db;
			$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
			$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
			if(!$user_info = $db->login($username, $password)) {
				echo '<p>User not valid.</p>';
				header('Location: login.php');
			} else {
				$_SESSION['grub_user'] = $user_info;
				if($user_info['user_type'] == 'restaurant') {
					header('Location: restaurant_homepage.php');
				} else {
					echo "<p>diner</p>";
				}
			}
		} else {
			if(isset($_SESSION['logged_in']) and isset($_SESSION['grub_user'])) {
				if($_SESSION['logged_in']) {
					if($_SESSION['grub_user']['user_type'] == 'restaurant') {
						header('Location: restaurant_homepage.php');
					} else {
						echo "<p>diner</p>";
					}
				}
			}
		}
		/*$user_id = $db->login($username, $password);
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
			
		}*/
	?>
</body>
</html>