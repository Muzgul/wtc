<?php
	/* Code based on assumption that passed info is valid, js to validate live */
	include "dbman.php";

	if (!(isset($_POST['usr-log-in'])) && !(isset($_POST['usr-register'])) && !(isset($_POST['usr-verif']))) {
		#Entered page randomly, redirect to home
		header("Location: index.php");
	}

	$response = "No info";
	$button = "Go back";
	$link = "admin.html";
	
	if (isset($_POST['usr-log-in']))
	{
		$user = getUser($_POST['usr-name']);
		if (isset($user))
		{
			$pass = hash("sha256", $_POST['usr-passwd']);
			if (strcmp($pass, $user['passwd']) == 0)
			{				
				if ($user['verif'] != 0)
				{
					$response = "Welcome " . $user['login'] . "!";
					$button = "Go to Gallery";
					$link = "index.php";
				}
				else
				{
					$response = "Welcome " . $user['login'] . ", please verify your account.";
					$button = "Resend email";
					$link = "#";
				}
			}
			else
			{
				$response = "Incorrect username/pasword!";
				$button = "Go back";
				$link = "admin.html";
			}
		}
		else
		{
			$response = "Incorrect username/pasword!";
			$button = "Go back";
			$link = "admin.html";
		}
	}

	if (isset($_POST['usr-register']))
	{
		$user = getUser($_POST['usr-name']);
		if (!isset($user))
		{
			$user = newUser($_POST);
			if (isset($user))
			{
				$response = "Welcome " . $user['login'] . ", please verify your account.";
				$button = "Resend email";
				$link = "#";
			}
			else
			{
				$response = "Unknown error, please retry.";
				$button = "Go back";
				$link = "admin.html";
			}
		}
		else
		{
			$response = "User " . $user['login'] . " already exists!";
			$button = "Go back";
			$link = "admin.html";
		}
	}
/*
	if (isset($_POST['usr-verif']))
	{
		if (verifUser($_POST['usr-name']))
		{
			$response = "User " . $user['login'] . " verified!";
			$button = "Go to Gallery";
			$link = "index.php";
		}
		else
		{
			$response = "User " . $user['login'] . " already verified!";
			$button = "Go to Gallery";
			$link = "index.php";
		}
	}
	*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>ayyyyy</title>
</head>
<body>
	<h2><?php echo $response; ?></h2>
	<?php echo '<a href="' . $link . '">' . $button . '</a>'; ?>
</body>
</html>