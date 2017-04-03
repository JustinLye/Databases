<!DOCTYPE html>
<html>
<head>
	<title>Diner Homepage</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<?php
		require_once('utility.php');
		session_start();
		$diner = $_SESSION["grub_diner"];
		echo "<p>Username: " . $diner->get_name() . "</p>";
		echo "<p>User Id: " . $diner->get_id() . "</p>";
		
	?>
</body>
</html>