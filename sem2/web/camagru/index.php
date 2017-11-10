<?php session_start();
	include "dbman.php";
	/* TODO

		Add image likability - keep table for each img that stores previous likes
			(LATER) - on hover show usernames of likers
		Add commentability - Load comments to add own

	*/	
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