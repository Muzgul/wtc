<?php

	function newImg($login, $filename, $url)
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
			$sql = "INSERT INTO `tblimg` (`name`, `creator`, `url`)
					VALUES ('" . $filename . "', '" . $login . "', '"
					. $url . "')";
			$conn->exec($sql);
		}
		catch (PDOException $exception)
		{
			echo "[ newImg Error : " . $exception->getMessage() . "]<br/>";
			return (null);
		}
		if (!file_exists("../comments/" . $filename . ".txt"))
		{
			$arr = array(
				"likes" => array(),
				"comments" => array()
			);
			file_put_contents("../comments/" . $filename . ".txt", serialize($arr));
		}

		return ("image.php?name=" . $filename . "&url=" . $url);
	}

	function getImpose()
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbMkMeMgc";
		$result = '<table><tr>';
		$counter = 0;
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM `tblimpose`";
			foreach ($conn->query($sql)	as $row)
			{
				if ($counter % 10 == 0 && $counter != 0)
					$result .= '</tr><tr>';
				$result .= '<td><a href="#" id="' . $row['name'] . '" onclick="';
				$result .= "drawImg('" . $row['url'] . "');";
				$result .= '"><img src="' . $row['url'] . '" height="120" width="160" alt="' . $row['name'] . '"></a></td>';
				$counter += 1;
			}
			return ($result);
		}
		catch (PDOException $exception)
		{
			echo "[ getUser Error : " . $exception->getMessage() . "]<br/>";
		}
		return (null);
	}
	
?>