<!DOCTYPE html>
<html>
<head>
	<title>Input: Add User</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class = "nav-bar">
		<li><a href="../html/add_user.html">Go Back</a></li>
	</ul>
	<?php
        require_once('dbtools.php');
        switch(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING)) {
            case "GET":
                get_signup_form("add_user.php");
                break;
            case "POST":
                $result = sign_up(filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_STRING),
                        filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING));
                header('Location:../index.html');
                break;
        }
	?>
</body>
</html>
