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

	function getUsers($option)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";

		if ($option['get_users'] == "all")
			$sql = "SELECT * FROM `tbladmin`";
		if ($option['get_users'] == "gender")
			$sql = "SELECT * FROM `tbladmin`
					WHERE `gender` LIKE '" . $option['gender'] . "%'";
		if ($option['get_users'] == "usrname")
			$sql = "SELECT * FROM `tbladmin`
					WHERE `usrname` LIKE '%" . $option['usrname'] . "%'";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$text = "Users:\n";
			$counter = 0;
			foreach ($conn->query($sql)	as $row)
			{
				if ($counter % 10 == 0)
					$imgs .= "<tr>";
				$text .= '
					<td>
						<div clas="container">
							<img src="' . $row['profpic'] . '">
							<h3>' . $row['usrname'] . '</h3>
							<small>' . $row['gender'] . ' | ' . $row['sexpref'] . '</small>
						</div>
					</td>
				';
				if ($img_count % 9 == 0 && $img_count != 0)
					$imgs .= "</tr>";
			}
			return ($text);
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
	if (isset($_POST['get_users']))
		echo getUsers($_POST);
?>