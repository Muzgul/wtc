<?php session_start();
	include "dbman.php";
	
	if (!isset($_SESSION['usr-log']))
	{
		$_SESSION['usr-log'] = "Guest";
		$usr_vip = "disabled";
	}
	else
	{
		if ($_SESSION['usr-log'] == "Guest")
			$usr_vip = "disabled";
		else
			$usr_vip = "";
	}
	$imgs = fetchImgs("");
?>

<!DOCTYPE html>
<html>
<head>
	<title>make-me-magic</title>
</head>
<body>
	<p>Hello 
	<?php 
		echo $_SESSION['usr-log'];
		if (strcmp($_SESSION['usr-log'], "Guest") != 0)
		{
			echo ', please click <a href="capture.php">here</a> to take your own.';
		}
	?></p>
	<table><?php echo $imgs; ?></table>
</body>
</html>