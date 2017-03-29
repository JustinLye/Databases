<!DOCTYPE html>
<html>
<head>
	<title>Relation: diner</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class='nav-bar'>
		<li><a href="../index.html">Home</a></li>
	</ul>
	<?php
		require_once('../../../php/connect.php');
		$db = new dbconnection();
		$table = $db->get_table("diner");
		if($table) {
			echo '<div class="tbl_data">';
			echo '<table>';
			echo '	<tr><td><b>Diner ID</b></td><td><b>User ID</b></td><td><b>Credability</b></td></tr>';
			while($row = mysqli_fetch_array($table)) {
				echo '	<tr><td>' . $row['diner_id'] . '</td><td> ' . $row['user_id'] . '</td><td>' . $row['cred_lvl'] . '</td></tr>';
			}
			echo '</table></div>';
		} else {
			echo '<p>Query failed</p>';
		}
	?>
</body>
</html>
