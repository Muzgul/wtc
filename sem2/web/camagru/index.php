<?php session_start();
	
	if (!isset($_SESSION['usr-log']))
	{
		$_SESSION['usr-log'] = "Guest";
		$usr_vip = "disabled";
	}
	else
	{
		if ($_SESSION['usr-log'] == "Guest")
			$usr_vip = "disabled";
		else
			$usr_vip = "";
	}

	function fetchImgs($login)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbMkMeMgc";
		$img_count = 0;
		$imgs = "";
		if ($login == "")
		{
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				// Error mode: exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "SELECT * FROM `tblimg`";
				foreach ($conn->query($sql)	as $row)
				{
					if ($img_count % 10 == 0)
						$imgs .= "<tr>";
					$imgs .= '<td><a href="image.php?url=' . $row['url'] . '&name=' . $row['name'] . '"><img src="../imgs/' . $row['url'] . '" alt="' . $row['name'] . '" name="' . $row['name'] . '" width="256" height="192"></a></td>';
					if (file_exists("../comments/" . $row['url'] . ".txt"))
					{
						$arr = unserialize(file_get_contents("../comments/" . $row['url'] . ".txt"));
						$imgs .= "";
					}
					if ($img_count % 9 == 0 && $img_count != 0)
						$imgs .= "</tr>";
					$img_count++;
				}
			}
			catch (PDOException $exception)
			{
				echo "[ getUser Error : " . $exception->getMessage() . "]<br/>";
			}
			if ($img_count % 9 != 0 && $img_count != 0)
				$imgs .= "</tr>";
		}
		else
		{

		}
		return ($imgs);
	}

	$imgs = fetchImgs("");
?>

<!DOCTYPE html>
<html>
<head>
	<title>make-me-magic</title>
</head>
<body>
	<p>Hello 
	<?php 
		echo $_SESSION['usr-log'];
		if (strcmp($_SESSION['usr-log'], "Guest") != 0)
		{
			echo ', please click <a href="capture.php">here</a> to take your own.';
		}
	?></p>
	<table><?php echo $imgs; ?></table>
</body>
</html>