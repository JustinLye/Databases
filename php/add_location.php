<!DOCTYPE html>
<html>
<head>
	<title>Add Location</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
    	<ul class="nav-bar">
		<li><a href="restaurant_homepage.php">Go Back</a></li>
	</ul>
	<?php
            require_once('dbtools.php');
            $mode = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
            switch($mode) {
                case "GET":
                    if(!filter_input(INPUT_COOKIE, 'logged_out', FILTER_SANITIZE_NUMBER_INT) == 1) {
                    echo add_location_form();
                    } else {
                        header('Location: ../index.html');
                    }
                    break;
                    
                case "POST":
//                    setcookie('add_loc_result',0);
                    echo "<p>" . __LINE__ . "</p>";
                
                $db = new db_connection();
		$link = $db->dblink();
		$name = $link->real_escape_string(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
		$country = $link->real_escape_string(filter_input(INPUT_POST,'country', FILTER_SANITIZE_STRING));
		$state = $link->real_escape_string(filter_input(INPUT_POST,'state', FILTER_SANITIZE_STRING));
		$city = $link->real_escape_string(filter_input(INPUT_POST,'city', FILTER_SANITIZE_STRING));
		$street = $link->real_escape_string(filter_input(INPUT_POST,'street', FILTER_SANITIZE_STRING));
		$zip = $link->real_escape_string(filter_input(INPUT_POST,'zip', FILTER_SANITIZE_STRING));
		$phone = $link->real_escape_string(filter_input(INPUT_POST,'phone', FILTER_SANITIZE_STRING));
                $rest_id = $link->real_escape_string(filter_input(INPUT_COOKIE, 'rest_id', FILTER_SANITIZE_STRING));
                $stmt = $link->prepare("INSERT INTO location VALUES(
                    NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('isssssss',$rest_id,
                        $name, $country, $state, $city, $street, $zip, $phone);
                $stmt->execute();
                header('Location: restaurant_homepage.php');
                    break;
            }
	?>
</body>
</html>