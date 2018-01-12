<?php session_start();
	
	function getUser($usrname)
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
					WHERE `usrname` LIKE '" . $usrname . "'";
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

	function getImgs($usrname)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";
		$arr = array();
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM `tblimg`
					WHERE `creator` LIKE '" . $usrname . "'";
			foreach ($conn->query($sql)	as $row)
			{
				$conn = null;
				array_push($arr, $row);				
			}
			return ($arr);
		}
		catch (PDOException $exception)
		{
			echo "[ getUser Error : " . $exception->getMessage() . "]<br/>";
		}
		return (null);
	}

	function deleteImg($url)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM `tblimg`
					WHERE `url` LIKE '" . $url . "'";
			$conn->query($sql);
		}
		catch (PDOException $exception)
		{
		}
	}

	function changeProfpic($url)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";

		$usr_name = $_SESSION['active-usr'];
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbladmin`
					SET `profpic` = '" . $url . "'
					WHERE `usrname` LIKE '" . $usr_name . "'";
			$conn->exec($sql);
			return (true);
		}
		catch (PDOException $exception)
		{
		}
		return (false);
	}

	if (isset($_POST['get_user']))
		echo json_encode(getUser($_POST['get_user']));
	if (isset($_POST['change_profpic']))
		changeProfpic($_POST['change_profpic']);
	if (isset($_POST['get_user_imgs']))
		echo json_encode(getImgs($_POST['get_user_imgs']));
	if (isset($_POST['delete_img']))
		deleteImg($_POST['delete_img']);
?>