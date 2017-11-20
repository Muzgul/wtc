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

	$result = fetchImgs($_SESSION['usr-log']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>ayy</title>
	<style>
	#container {
	    margin: 0px auto;
	    width: 640px;
	    height: 480px;
	    border: 10px #333 solid;
	    position: relative;
	}
	.captureWind {
	    position: absolute;
	    top: 0;
	    left: 0;
	}
	#canvasElement{
		visibility: hidden;
	}
	</style>
	
</head>
<body>
	<form id="form1">
		<input type="hidden" id="tempImgElement" name="img">
		<input type="hidden" id="tempImpElement" name="impose">
		<input type="hidden" id="tempUsrElement" name="usr" value="<?php echo $_SESSION['usr-log']; ?>">
	</form>
	<div id="container">
		<video autoplay="true" id="videoElement" class="captureWind" width="640" height="480"></video>
		<canvas id="canvasElement" class="captureWind" width="640" height="480"></canvas>
		<canvas id="imposeElement" class="captureWind" width="640" height="480"></canvas>
	</div>

	<button id="resetElement">Reset</button>
	<button id="captureElement" disabled="false">Capture</button>
	<button id="saveElement" disabled="false">Save</button>
	<input type="file" id="tempUplElement">
	<div><?php echo getImpose(); ?></div>
	<div id="logElement"><?php echo $result; ?></div>
	<script type="text/javascript" src="js/capture.js"></script>
	
</body>
</html>
