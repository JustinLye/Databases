<!DOCTYPE html>
<html>
<head>
<title>Add User</title>
</head>
<body>
	<?php
		require_once('../../../php/connect.php');
		echo '<p>Add User PHP</p>';
		$user_name = $_POST['user_name'];
		$pass_word = $_POST['pass_word'];
		$user_type = $_POST['user_type'];
		$user_email = $_POST['user_email'];
		$insert_str = "INSERT INTO user VALUES (NULL, TRUE, NOW(), NOW(), '$user_type', '$user_name', '$user_email', '$pass_word')";
		$response = @mysqli_query($dbc, $insert_str);
		if($response) {
			echo '<p>User Added.</p>';
		} else {
			echo '<p>User was not added</p>';
			echo mysqli_error($dbc);
		}
		mysqli_close($dbc);
	?>
</body>
</html>
