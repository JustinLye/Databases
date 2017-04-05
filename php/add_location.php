<!DOCTYPE html>
<html>
<head>
	<title>Add Location</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<?php
		require_once('utility.php');
		session_start();
		$restaurant = $_SESSION['grub_restaurant'];
		$loc = new location_info;
		$loc->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$loc->country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
		$loc->state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
		$loc->city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
		$loc->street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);
		$loc->zip = filter_var($_POST['zip'], FILTER_SANITIZE_STRING);
		$loc->phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
		if(!$restaurant->add_location($loc)) {
			echo "<p>Location failed to be added.";
			
		} else {
			echo "<p>Location added.</p>";
			header('Location: restaurant_homepage.php');
		}
	?>
</body>
</html>