 <?php

	function getUser($usr_name)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM `tbladmin`
					WHERE `usrname` LIKE '" . $usr_name . "'";
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

	function newUser($post)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$passwd = hash("sha256", $post['reg-passwd1']);
			$sql = "INSERT INTO `tbladmin` (`usrname`, `email`, `passwd`)
					VALUES ('" . $post['reg-usrname'] . "', '" . $post['reg-email'] . "', '"
					. $passwd . "')";
			$conn->exec($sql);
			return (getUser($post['reg-usrname']));
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
			$to = $post['reg-email'];
			$subject = "MkMeMgc Account Verification";
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = "
			Thank you for signing up with Make Me Magic!

			Your account details:
			[ Username: " . $post['reg-usrname'] . " ]
			[ Password: " . $post['reg-passwd1'] . " ]

			Please follow the link to finalise the verification process:
			<a href='http://127.0.0.1:8080/admin-verif.php?usr-verif=yes&usr-name=" . $post['reg-usrname'] . "&usr-hash=" . hash("sha256", $post['reg-passwd1']) . "'>Verify</a>

			Thank you!
			MkMeMgc Team";
			//mail($to, $subject, $message);
			mail($to, $subject, $message, $headers);
			//todo send the email;
		}
		if ($type == "reset")
		{
			$to = $post['email'];
			$subject = 'MkMeMgc Password Reset';
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = "
				Reset Password: <br/>
				<form action='http://127.0.0.1:8080/admin-verif.php' method='POST' target='_blank'>
					<label for='passwdnw'>New Password</label>
					<input type='text' name='passwdnw' placeholder='New password'><br/>
					<label for='passwdre'>Retype Password</label>
					<input type='text' name='passwdre' placeholder='Retype password'><br/>
					<input type='hidden' name='usr-namenw' value='" . $post['login'] . "' >
					<input type='submit' name='usr-pass-reset' value='Reset'>
				</form>
			";
			mail($to, $subject, $message, $headers);
		}

		if ($type == "comment")
		{
			$user = getUser($post['creator']);

			$to = $user['email'];
			$subject = "MkMeMgc Comment Notification";
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = "Hi " . $user['login'] . ", your image just received a comment: [ " . $post['usr-log'] . " ] - " . $post['comment'] . ".";
			mail($to, $subject, $message, $headers);
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

	if (isset($_GET['check-usr']))
	{
		$user = getUser($_GET['check-usr']);
		if (isset($user))
			echo "true";
		else
			echo $_GET['check-usr'];
	}

	if (isset($_POST['get_user']))
		echo json_encode(getUser($_POST['get_user']));

?>