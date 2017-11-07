<?php
	
	$img = $_POST['img'];
	$img = str_replace('data:image/jpeg;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	
	$success = file_put_contents("temp.jpeg", $data);
	if ($success)
		echo '<img src="temp.jpeg">';
	else
		echo "shiiit";

	$bg = imagecreatefromjpeg('temp.jpeg');
	$img = imagecreatefromjpeg('test.jpg');

	imagecopymerge($bg, $img, 0, 0, 0, 0, imagesx($bg), imagesy($bg), 50);

	imagejpeg($bg, "temp.jpeg", 100);
?>
