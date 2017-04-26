<!DOCTYPE html>
<html>
<head>
	<title>Test file uploade</title>
	<link rel="stylesheet" href="../css/default.css">
</head>
<body>
	<ul class="nav-bar">
		<li><a href="../index.html">Home</a></li>
	</ul>
	<?php
		
		require_once('utility.php');
		$db = new dbconnection;
		
		if($db->upload_image_db($_FILES["file_to_upload"], $_POST["submit"])) {
			echo "<p>File was uploaded.</p>";
		} else {
			echo "<p>File upload failed.</p>";
		}
		
	?>

</body>
</html>