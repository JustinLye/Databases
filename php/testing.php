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
            echo "<select name=\"restaurant_name\">" . get_restaurant_select_options(5) . "</select><";
            echo "<select name=\"locations\">" .get_location_select_list_options(5, "Luigi's Bistro") . "</select>";
            
            
            
            
	?>
	
</body>
</html>
