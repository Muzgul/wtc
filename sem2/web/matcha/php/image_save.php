<?php session_start();

	if (isset($_POST['popup_temp']))
	{
		$login = $_SESSION['active-usr'];
		$img = $_POST['img'];	
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$filename = time().uniqid(rand()) . ".jpeg";
		$url = "imgs/usr/" . $filename;

		$success = file_put_contents("temp.png", $data);

		$bg = imagecreatefrompng('temp.png');

		imagejpeg($bg, "../" . $url, 100);

		unlink('temp.png');
		
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `tblimg` (`name`, `creator`, `url`)
					VALUES ('" . $filename . "', '" . $login . "', '"
					. $url . "')";
			$conn->exec($sql);
		}
		catch (PDOException $exception)
		{
		}
		echo $url;
	}
	
?>