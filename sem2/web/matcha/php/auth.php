<?php session_start();

	include "db_func.php";

	if (isset($_POST))
	{
		if (isset($_POST['reg-usrname']))
		{
			$user = newUser($_POST['reg-usrname'], $_POST['reg-passwd1'], $_POST['reg-email']);
			sendEmail($_POST, "verif");
			$_SESSION['active-usr'] = $user['login'];
		}
	}

?>