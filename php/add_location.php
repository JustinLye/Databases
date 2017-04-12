<!DOCTYPE html>
<html>
<head>
	<title>Add Location</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<?php
		require_once('/home/jlye/.php/.dbc.php');
                $db = new db_connection();
		$link = $db->dblink();
		$name = $link->real_escape_string(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
		$country = $link->real_escape_string(filter_var($_POST['country'], FILTER_SANITIZE_STRING));
		$state = $link->real_escape_string(filter_var($_POST['state'], FILTER_SANITIZE_STRING));
		$city = $link->real_escape_string(filter_var($_POST['city'], FILTER_SANITIZE_STRING));
		$street = $link->real_escape_string(filter_var($_POST['street'], FILTER_SANITIZE_STRING));
		$zip = $link->real_escape_string(filter_var($_POST['zip'], FILTER_SANITIZE_STRING));
		$phone = $link->real_escape_string(filter_var($_POST['phone'], FILTER_SANITIZE_STRING));
                
	?>
</body>
</html>