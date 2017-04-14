<!DOCTYPE html>
<html>
<head>
	<title>Testing</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class="nav-bar">
		<li><a href="../index.html">Home</a></li>
	</ul>
	<?php
            require_once('dbtools.php');
            echo get_id(49, USER_TO_REST);
            echo get_id(8, REST_TO_USER);
            
            
            
	?>
	
</body>
</html>
