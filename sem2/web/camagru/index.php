<?php session_start();
	
	if (!isset($_SESSION['usr-log']) || ($_GET['logout'] == "true"))
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

	function fetchImgs($page)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbmkmemgc";
		$img_count = 0;
		$imgs = "";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM `tblimg`";
			foreach ($conn->query($sql)	as $row)
			{
				if ($img_count % 10 == 0)
					$imgs .= "<tr>";
				
				if (($page == "1" && $img_count < 3) || 
					($page == "2" && ($img_count > 2 && $img_count < 6)) ||
					($page == "3" && $img_count > 5))
				{
					$imgs .= '<td><a href="image.php?url=' . $row['url'] . '&name=' . $row['name'] . '"><img src="' . $row['url'] . '" alt="' . $row['name'] . '" name="' . $row['name'] . '" width="256" height="192"></a></td>';
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
		return ($imgs);
	}

	if (isset($_GET['page']))
	{
		$imgs = fetchImgs($_GET['page']);
	}
	else
	{
		$imgs = fetchImgs("1");
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
		<h3>Hello 
		<?php 
			echo $_SESSION['usr-log'];
			if (strcmp($_SESSION['usr-log'], "Guest") != 0)
			{
				echo ', please click <a href="capture.php">here</a> to take your own.';
			}
		?></h3>
		<table><?php echo $imgs; ?></table>
	</div>

	<div id="footer">
		<div id="thebything">by Murray MacDonald</div>
		<!--- Insert social media -->
		<ul id="pagination">
			<li><a href="?page=1">Page 1</a></li> | 
			<li><a href="?page=2">Page 2</a></li> |
			<li><a href="?page=3">Page 3</a></li> 
		</ul>	
	</div>
</body>
</html>