<!DOCTYPE html>
<html>
<head>
	<title>Search: User</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class="nav-bar">
		<li><a href="../index.html">Home</a></li>
		<li class="dropdown">Search
			<span class="dropdown-content">
			<a href="../search_user.html">By User</a>
			</span>
		</li>
	</ul>
	<?php
		require_once('utility.php');
		$name = $_POST['target_user_name'];
		$db = new dbconnection();
		$result = $db->user_search($name, "name", true);
		if(!$result) {
			echo "User was not found or some problem occurred.\n";
		} else if($result->num_rows <= 0) {
			echo "<p>No users with name <strong> $name </strong> were found.</p>";
		} else {
			util::to_html_table(util::active_user_v_headings(), $result);
		}
	?>
</body>
</html>