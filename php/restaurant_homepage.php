<?php
    if(filter_input(INPUT_COOKIE,'logged_out', FILTER_SANITIZE_NUMBER_INT) == 1) {
        header('Location: logout.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Restaurant</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class="nav-bar">
		<li><a href="logout.php">Logout</a></li>
		<li><a href="add_location.php">Add Location</a></li>
	</ul>    
	<?php
            $chk_id = filter_input(INPUT_COOKIE, 'rest_id', FILTER_SANITIZE_NUMBER_INT);
            require_once('display_locs.php');
            require_once('dbtools.php');
            if(!chk_id) {
                setcookie('rest_id', get_id(filter_input(INPUT_COOKIE, 'user_id', FILTER_SANITIZE_NUMBER_INT), USER_TO_REST));
            }
            echo "<h2>Restaurants</h2>";
            echo restaurants_table();
            echo "<h2>Locations</h2>";
            echo locations_table();
	?>
</body>
</html>