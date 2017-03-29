<!DOCTYPE html>
<html>
<head>
<title>Users</title>
<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<?php
		require_once('../../../php/connect.php');
		$db = new dbconnection();
		$response = $db->get_table("user");
		if($response) {
			echo '<div class="tbl_data">';
			echo '<table>
				<tr>
					<td><b>User ID</b></td>
					<td><b>Is Active</b></td>
					<td><b>Registration Date</b></td>
					<td><b>Last Login</b></td>
					<td><b>User Type</b></td>
					<td><b>User Name</b></td>
					<td><b>Email</b></td>
				</tr>';
			while($row = mysqli_fetch_array($response)) {
				echo '<tr><td>' . $row['user_id']. '</td><td>'
					.$row['is_active']. '</td><td>'.
					$row['reg_date']. '</td><td>'.
					$row['last_login']. '</td><td>' .
					$row['user_type'] . '</td><td>' .
					$row['user_name'] . '</td><td>' .
					$row['email'] . '</td></tr>';
			}
			echo '</table>';
			echo '</div>';
		} else {
			echo "Couldn't issue database query.";
		}
	?>
</body>
</html>
