<?php session_start();

	if (isset($_GET['session']))
	{
		if ((isset($_SESSION['active_usr']) && $_SESSION['active_usr'] != "guest"))
			echo "trrre";
		else
			echo "false";
	}
?>