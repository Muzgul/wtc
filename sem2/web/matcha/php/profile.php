<?php session_start();

	if (!(isset($_SESSION['active-usr']) && $_SESSION['active-usr'] != "guest"))
	{
		header("Location: admin.php");
	}
	else
	{
		if (isset($_GET['view-profile']))
			$user = $_GET['view-profile'];
		else
			$user = $_SESSION['active-usr'];
	}

?>