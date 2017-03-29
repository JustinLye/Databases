
<!DOCTYPE html>
<html>
<head>
<title>Users</title>
<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class="nav-bar">
		<li><a href="../index.html">Home</a></li>
	</ul>
	<?php
		require_once('utility.php');
		$db = new dbconnection();
		$response = $db->get_table("user");
		
		if($response) {
			util::to_html_table(util::$active_user_v_headings, $response);
		} else {
			echo "Couldn't issue database query.";
		}
	?>
</body>
</html>
