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
                <li class="dropdown">Locations
                    <span class="dropdown-content">
                        <a href="add_location.php">New Location</a>
                        <a href="#">Edit Location</a>
                    </span>
                    </li>
		<li class="dropdown">Entrees
                    <span class="dropdown-content">
                        <a href="../html/add_entree.html">New Entree</a>
                        <a href="#">Edit Entree</a>
                    </span>
                </li>
                
	</ul>    
	<?php
			
            require_once('display_locs.php');
            require_once('dbtools.php');
            //If the rest_id cookie is not set, then set the cookie and get the restaurant_id using the user_id cookie
            if(($id = filter_input(INPUT_COOKIE, 'rest_id', FILTER_SANITIZE_NUMBER_INT)) === NULL) {
                set_rest_id_cookie();
                $id = get_id(filter_input(INPUT_COOKIE, 'user_id', FILTER_SANITIZE_NUMBER_INT), USER_TO_REST);
            }            
            echo "<h2>Restaurants</h2>";
            echo restaurants_table();
            echo "<h2>Locations</h2>";
            echo locations_table();
            echo "<h2>Menu</h2>";
            echo util::to_html_table_chg_width(array('Location', 'Entree', 'Description', 'Price'), get_menu_all_locs($id), "50%");
	?>
</body>
</html>