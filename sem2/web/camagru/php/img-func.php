<?php session_start();

	include "admin-func.php";

	function showInfo($name)
	{
		$arr = unserialize(file_get_contents("../comments/" . $name . ".txt"));
		$likes = 0;
		$comments = "";
		foreach ($arr['comments'] as $key => $value) {
			$comments .= $value . "<br/>";
		}
		foreach ($arr['likes'] as $key => $value) {
			$likes++;
		}
		$return = "<div> $comments </div><div> Likes: $likes </div>";
		return ($return);
	}

	function getImg($name)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbmkmemgc";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM `tblimg`
					WHERE `name` LIKE '" . $name . "'";
			foreach ($conn->query($sql)	as $row)
			{
				$conn = null;
				return ($row);
			}
		}
		catch (PDOException $exception)
		{
			echo "[ getImg Error : " . $exception->getMessage() . "]<br/>";
		}
		return (null);
	}

	function addComment($name, $comment)
	{
		$usr = $_SESSION['usr-log'];
		$arr = unserialize(file_get_contents("../comments/" . $name . ".txt"));
		array_push($arr['comments'], "[ " . $usr . " ] - " . $comment);
		file_put_contents("../comments/" . $name . ".txt", serialize($arr));

		$img = getImg($name);

		$img['usr-log'] = $usr;
		$img['comment'] = $comment;

		sendEmail($img, "comment");

		return (showInfo($name));
	}

	function addLike($name)
	{
		$usr = $_SESSION['usr-log'];
		$arr = unserialize(file_get_contents("../comments/" . $name . ".txt"));
		foreach ($arr['likes'] as $key => $value) {
			if ($value == $usr)
				return (showInfo($name));
		}
		array_push($arr['likes'], $usr);
		file_put_contents("../comments/" . $name . ".txt", serialize($arr));
		return (showInfo($name));
	}

	function deleteImg($name)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbmkmemgc";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM `tblimg`
					WHERE `name` LIKE '" . $name . "'";
			$conn->query($sql);
		}
		catch (PDOException $exception)
		{
			echo "[ deleteImg Error : " . $exception->getMessage() . "]<br/>";
		}

		unlink("../imgs/usr/" . $name);
		unlink("../comments/" . $name . ".txt");

		return ("Image deleted. <a href='index.php'>Home</a>");
	}

	if (isset($_GET['wit']))
	{
		if ($_GET['wit'] == "comment")
		{
			echo addComment($_GET['img'], $_GET['comment']);
		}
		if ($_GET['wit'] == "like")
		{
			echo addLike($_GET['img']);
		}
		if ($_GET['wit'] == "load")
		{
			echo showInfo($_GET['img']);
		}
		if ($_GET['wit'] == "delete")
		{
			echo deleteImg($_GET['img']);
		}
	}
?>