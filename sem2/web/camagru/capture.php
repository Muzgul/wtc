<?php session_start();

	include "php/capture-func.php";

	if (!isset($_SESSION['usr-log']) || strcmp("Guest", $_SESSION['usr-log']) == 0)
		header("Location: index.php");

	function fetchImgs($login)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "dbMkMeMgc";
		$img_count = 0;
		$imgs = "";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if ($login == "")
				$sql = "SELECT * FROM `tblimg`";
			else
				$sql = "SELECT * FROM `tblimg` WHERE `creator` LIKE '" . $login . "'";
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
		return ($imgs);
	}

	$result = "<div id='logElement'><h3>Your other posts.</h3>" . fetchImgs($_SESSION['usr-log']) . "</div>";
	$impose = "<div id='imposeElement'>" . getImpose() . "</div>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Make Me Magic</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<form id="form1">
		<input type="hidden" id="tempImgElement" name="img">
		<input type="hidden" id="tempImpElement" name="impose">
		<input type="hidden" id="tempUsrElement" name="usr" value="<?php echo $_SESSION['usr-log']; ?>">
	</form>

	

	<div id="panel-cont">

		<div id="capture-panel">
			<video autoplay="true" id="videoElement" class="captureWind" width="640" height="480"></video>
			<canvas id="canvasElement" class="captureWind" width="640" height="480"></canvas>
			<canvas id="imposeElement" class="captureWind" width="640" height="480"></canvas>
		</div>

		<button id="resetElement">Reset</button>
		<button id="captureElement" disabled="false">Capture</button>
		<button id="saveElement" disabled="false">Save</button>
		<input type="file" id="tempUplElement">
				
	</div>

	<div><?php echo $result . $impose; ?></div>	
	
	<div id="footer">
		<div>by Murray MacDonald</div>
		<!--- Insert social media -->
		<a href="index.php"><div id="header-title"><p>Make Me Magic</p></div></a>
		<a href="index.php?logout=true"><div class="header-clickables"><p>Log out</p></div></a>
	</div>

	<script type="text/javascript" src="js/capture.js"></script>
</body>
</html>
