<!DOCTYPE html>
<html>
<head>
<title>Add User</title>
</head>
<body>
<?php
require_once('../../cs4433/php/connect.php');
$user_name = $_POST['user_name'];
$pass_word = $_POST['pass_word'];
$user_type = $_POST['user_type'];
$user_email = $_POST['user_email'];
$insert_str = "INSERT INTO user VALUES (NULL, TRUE, NOW(), NOW(), $user_type, $user_name, $user_email, $pass_word)";
echo '<p>Here is the SQL string: ' . $insert_str . '</p>';
?>
</body>
</html>
