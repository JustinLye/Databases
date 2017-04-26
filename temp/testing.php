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
            echo __LINE__;
            $r = get_table_description('location');
            echo __LINE__;
            var_dump($r);
            //var_dump($r);
            
            
            
            
	?>
	
</body>
</html>
