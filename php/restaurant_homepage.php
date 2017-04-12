<!DOCTYPE html>
<html>
<head>
	<title>Restaurant Homepage</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<?php
		require_once('/home/jlye/.php/.dbc.php');
                $db = new db_connection;
                $link = $db->dblink();
                if(isset($_COOKIE['user_id'])) {
                    $user_id = $link->real_escape_string(filter_input(INPUT_COOKIE, 'user_id', FILTER_SANITIZE_STRING));
                    $stmt = $link->prepare("SELECT restaurant_id FROM restaurant WHERE user_id = ?");
                    $stmt->bind_param('s',$user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    setcookie('rest_id', $result->fetch_array(MYSQLI_ASSOC)['restaurant_id']);
                }
	?>
	<ul class="nav-bar">
		<li><a href="logout.php">Logout</a></li>
		<li><a href="../html/add_location.html">Add Location</a></li>
	</ul>
	
</body>
</html>