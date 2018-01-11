<?php session_start();

	if (isset($_GET['session']))
	{
		if (isset($_SESSION['active-usr']) && $_SESSION['active-usr'] != 'guest')
			echo "true";
		else
			echo "false";
	}
	if (isset($_POST['get_session']))
		echo $_SESSION['active-usr'];
	if (isset($_GET['end_session']))
	{
		if ($_GET['end_session'] == "yes")
			$_SESSION['active-usr'] = "guest";
		header("Location: ../index.html");
	}
?>