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
            require_once('/home/jlye/.php/.dbc.php');
            require_once('output_functs.php');
            $db = new db_connection;
            echo util::to_html_table(util::active_user_v_headings(), $db->dblink()->query("SELECT * FROM active_user_v"));
            
            
	?>
	
</body>
</html>
