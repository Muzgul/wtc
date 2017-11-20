<?php

	function getUser($usr_name)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbMkMeMgc";
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

	function newUser($post)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbMkMeMgc";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$passwd = hash("sha256", $post['usr-passwd']);
			$sql = "INSERT INTO `tbladmin` (`login`, `email`, `passwd`)
					VALUES ('" . $post['usr-name'] . "', '" . $post['usr-email'] . "', '"
					. $passwd . "')";
			$conn->exec($sql);
			return (getUser($post['usr-name']));
		}
		catch (PDOException $exception)
		{
			echo "[ newUser Error : " . $exception->getMessage() . "]<br/>";
			return (null);
		}
	}

	function sendEmail($post)
	{

		$to = $post['usr-email'];
		$subject = "MkMeMgc Account Verification";
		$message = "
		Thank you for signing up with Make Me Magic!

		Your account details:
		[ Username: " . $post['usr-name'] . " ]
		[ Password: " . $post['usr-passwd'] . " ]

		Please follow the link to finalise the verification process:
		http://127.0.0.1:8080/camagru/admin-verif.php?usr-verif=yes&usr-name=" . $post['usr-name'] . "&usr-hash=" . hash("sha256", $post['usr-passwd']) . "

		Thank you!
		MkMeMgc Team";
		//mail($to, $subject, $message);
		return ($message);
		//todo send the email;
	}

	function verifUser($usr_name, $usr_hash)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbMkMeMgc";

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
					echo "[ verifUser Error : " . $exception->getMessage() . "]<br/>";
				}
			}
		}
		return (false);
	}

?>