<!DOCTYPE html>
<html>
<head>
	<title>Input: Add User</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class = "nav-bar">
		<li><a href="../html/add_user.html">Go Back</a></li>
	</ul>
	<?php
		require_once('utility.php');	
		$user_name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
		$pass_word = filter_var($_POST['pass_word'], FILTER_SANITIZE_STRING);
		$user_type = filter_var($_POST['user_type'], FILTER_SANITIZE_STRING);
		$user_email = filter_var($_POST['user_email'], FILTER_SANITIZE_STRING);
		$db = new dbconnection();
		if($db->add_user($user_name, $user_email, $pass_word, $user_type)) {
			echo '<p>User Added. Will add snackbar notification if time allows.</p>';
			header('Location:../index.html');
		} else {
			echo '<p>User was not added. Will add snackbar notification if time allows.</p>';
			echo '<p>' . $db.get_error() . '</p>';
		}
	?>
</body>
</html>
