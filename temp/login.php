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
                                setcookie('user_id', $user_info['user_id']);
                                setcookie('user_type', $user_info['user_type']);
                                setcookie('logged_out', "", time()-1);
				if($user_info['user_type'] == 'restaurant') {
					header('Location: restaurant_homepage.php');
				} else {
					echo "<p>diner</p>";
				}
			}
		} elseif(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) == 'GET') {
                    $utype = filter_input(INPUT_COOKIE, 'user_type', FILTER_SANITIZE_STRING);
                    if($utype == 'restaurant') {
                        header('Location: restaurant_homepage.php');
                    } else {


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