<?php session_start();

	if (isset($_POST))
	{
		if (isset($_POST['reg-usrname']))
		{
			$user = newUser($_POST['reg-usrname'], $_POST['reg-passwd1'], $_POST['reg-email']);
			$_SESSION['active-usr'] = $user['login'];
		}
	}

	function getUser($usr_name)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbmkmemgc";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM `tbladmin`
					WHERE `login` LIKE '" . $usr_name . "'";
			foreach ($conn->query($sql)	as $row)
			{
				$conn = null;
				return ($row);
			}
		}
		catch (PDOException $exception)
		{
			echo "[ getUser Error : " . $exception->getMessage() . "]<br/>";
		}
		return (null);
	}

	function newUser($usr_name, $usr_passwd, $usr_email)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbmkmemgc";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$passwd = hash("sha256", $usr_passwd);
			$sql = "INSERT INTO `tbladmin` (`login`, `email`, `passwd`)
					VALUES ('" . $usr_name . "', '" . $usr_email . "', '"
					. $passwd . "')";
			$conn->exec($sql);
			return (getUser($usr_name);
		}
		catch (PDOException $exception)
		{
			echo "[ newUser Error : " . $exception->getMessage() . "]<br/>";
			return (null);
		}
	}

	function sendEmail($post, $type)
	{
		if ($type == "verif")
		{
			$to = $post['usr-email'];
			$subject = "MkMeMgc Account Verification";
			$message = "
			Thank you for signing up with Make Me Magic!

			Your account details:
			[ Username: " . $post['usr-name'] . " ]
			[ Password: " . $post['usr-passwd'] . " ]

			Please follow the link to finalise the verification process:
			<a href='http://127.0.0.1:8080/camagru/admin-verif.php?usr-verif=yes&usr-name=" . $post['usr-name'] . "&usr-hash=" . hash("sha256", $post['usr-passwd']) . "'>Verify</a>

			Thank you!
			MkMeMgc Team";
			//mail($to, $subject, $message);
			mail($to, $subject, $message);
			//todo send the email;
		}
		if ($type == "reset")
		{
			$to = $post['email'];
			$subject = 'MkMeMgc Password Reset';
			$message = "
				Reset Password: <br/>
				<form action='admin-verif.php' method='POST'>
					<input type='text' name='passwdnw' placeholder='New password'>
					<input type='text' name='passwdre' placeholder='Retype password'>
					<input type='hidden' name='usr-namenw' value='" . $post['login'] . "' >
					<input type='submit' name='usr-pass-reset' value='Reset'>
				</form>
			";
			mail($to, $subject, $message);
		}

		if ($type == "comment")
		{
			$user = getUser($post['creator']);

			$to = $user['email'];
			$subject = "MkMeMgc Comment Notification";
			$message = "Hi " . $user['login'] . ", your image just received a comment: [ " . $post['usr-log'] . " ] - " . $post['comment'] . ".";
			mail($to, $subject, $message);
		}
	}

	function changePasswd($usr_name, $new_pass)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbmkmemgc";

		$pass = hash("sha256", $new_pass);
		$user = getUser($usr_name);
		if (isset($user))
		{
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				// Error mode: exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE `tbladmin`
						SET `passwd` = '" . $pass . "'
						WHERE `login` LIKE '" . $usr_name . "'";
				$conn->exec($sql);
				return (true);
			}
			catch (PDOException $exception)
			{
			}
		}
		return (false);
	}

	function verifUser($usr_name, $usr_hash)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbmkmemgc";

		$user = getUser($usr_name);
		if (isset($user) && $user['verif'] != 1)
		{
			if (strcmp($user['passwd'], $usr_hash) == 0)
			{
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					// Error mode: exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "UPDATE `tbladmin`
							SET `verif` = '1'
							WHERE `login` LIKE '" . $usr_name . "'";
					$conn->exec($sql);
					return (true);
				}
				catch (PDOException $exception)
				{
				}
			}
		}
		return (false);
	}

?>
?>