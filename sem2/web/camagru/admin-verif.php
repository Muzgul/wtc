<?php session_start();
	/* Code based on assumption that passed info is valid, js to validate live */
	include "php/admin-func.php";


	if (!(isset($_POST['usr-log-in'])) && !(isset($_POST['usr-register'])) && !(isset($_GET['usr-verif']))) {
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
					$_SESSION['usr-log'] = $user['login'];
					header("Location: index.php");
				}
				else
				{
					$response = "Welcome " . $user['login'] . ", please verify your account.";
					$button = "";
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
				echo sendEmail($_POST);
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

	if (isset($_GET['usr-verif']))
	{
		if (verifUser($_GET['usr-name'], $_GET['usr-hash']))
		{
			$response = "User " . $_GET['usr-name'] . " verified!";
			$button = "Go to Gallery";
			$link = "index.php";
			$_SESSION['usr-log'] = $_GET['usr-name'];
		}
		else
		{
			$response = "Error verifying user!";
			$button = "Unknown Error";
			$link = "#";
		}
	}

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