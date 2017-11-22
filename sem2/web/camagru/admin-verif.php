<?php session_start();
	/* Code based on assumption that passed info is valid, js to validate live */
	include "php/admin-func.php";


	if (!(isset($_POST['usr-log-in'])) && !(isset($_POST['usr-register'])) && !(isset($_GET['usr-verif'])) && !(isset($_POST['usr-reset'])) && !(isset($_POST['usr-pass-reset']))) {
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
					$button = "Email sent";
					$link = "#";
					echo sendEmail($_POST, "verif");
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
				echo sendEmail($_POST, "verif");
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

	if (isset($_POST['usr-reset']))
	{
		$user = getUser($_POST['usr-name1']);
		if (isset($user))
		{
			if ($user['verif'] == "1")
			{
				$response = "Reset email sent";
				echo sendEmail($user, "reset");
			}
			else
			{
				$response = "User " . $_POST['usr-name1'] . " not verified!";
				$button = "Email sent";
				$link = "#";
			}
		}
		else
		{
			$response = "User " . $_POST['usr-name1'] . " does not exist!";
			$button = "Go back";
			$link = "admin.html";
		}		
	}

	if (isset($_POST['usr-pass-reset']))
	{
		if ($_POST['passwdnw'] == $_POST['passwdre'])
		{
			$response = "Password changed!";
			changePasswd($_POST['usr-namenw'], $_POST['passwdnw']);
		}
		else
		{
			$response = "New passwords do not match!";
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
	<title>Make Me Magic</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="header">
		<a href="index.php"><div id="header-title"><p>Make Me Magic</p></div></a>
		<a href="index.php?logout=true"><div class="header-clickables"><p>Log out</p></div></a>
		<a href="admin.html"><div class="header-clickables"><p>Log in<p></div></a>
	</div>

	<div id="content">
		<h2><?php echo $response; ?></h2>
		<?php echo '<a href="' . $link . '">' . $button . '</a>'; ?>
	</div>

	<div id="footer">
		<div>by Murray MacDonald</div>
		<!--- Insert social media -->
	</div>
</body>
</html>