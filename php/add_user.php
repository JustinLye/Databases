<!DOCTYPE html>
<html>
<head>
	<title>Input: Add User</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class = "nav-bar">
		<li><a href="../add_user.html">Go Back</a></li>
	</ul>
	<?php
		require_once('utility.php');	
		$user_name = $_POST['user_name'];
		$pass_word = $_POST['pass_word'];
		$user_type = $_POST['user_type'];
		$user_email = $_POST['user_email'];
		$db = new dbconnection();
		if($db->add_user($user_name, $user_email, $pass_word, $user_type)) {
			echo '<p>User Added. Will add snackbar notification if time allows.</p>';
		} else {
			echo '<p>User was not added. Will add snackbar notification if time allows.</p>';
			echo '<p>' . $db.get_error() . '</p>';
		}
	?>
</body>
</html>
