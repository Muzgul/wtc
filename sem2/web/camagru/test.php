<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	include "dbman.php";
	
	$post = array(
		"usr-name" => "murray",
		"usr-passwd1" => "1234",
		"usr-email" => "some@email.com"
	);

	$user = newUser($post);
	print_r($user);
?>
<!DOCTYPE html>
<html>
<head>
	<title>ayy</title>
</head>
<body>
	<p><?php echo $response; ?></p>
</body>
</html>