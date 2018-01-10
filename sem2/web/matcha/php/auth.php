<?php session_start();

	include "db_func.php";

	if (isset($_POST))
	{
		if (isset($_POST['reg-usrname']))
		{
			$user = newUser($_POST);
			if ($user != NULL)
			{
				//sendEmail($_POST, "verif");
				$_SESSION['active-usr'] = $user['usrname'];
				echo "true";
			}
			else
				echo "false";
		}
		if (isset($_POST['login-usrname']))
		{
			$user = getUser($_POST['login-usrname']);
			$passwd = hash("sha256", $_POST['login-passwd1']);
			if ($user != NULL && strcmp($passwd, $user['passwd']) == 0)
			{
				$_SESSION['active-usr'] = $user['usrname'];
				echo "true";
			}
			else
				echo "false";
		}
	}
?>