<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
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
			$passwd = hash("sha256", $post['usr-passwd1']);
			$sql = "INSERT INTO `tbladmin` (`login`, `email`, `passwd`)
					VALUES ('" . $post['usr-name'] . "', '" . $post['usr-email'] . "', '"
					. $passwd . "')";
			$conn->exec($sql);
			return (getUser($post['usr-name']));
		}
		catch ($PDOException $exception)
		{
			echo "[ newUser Error : " . $exception->getMessage() . "]<br/>";
			return (null);
		}
	}
/*
	function verifUser($usr_name)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbMkMeMgc";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbladmin`
					SET `verif` = `1`
					WHERE `login` LIKE '" . $usr_name . "'";
		}
		catch ($PDOException $exception)
		{
			echo "[ verifUser Error : " . $exception->getMessage() . "]<br/>";
		}
	}
*/
?>