<?php
	
	$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	
	$success = file_put_contents("temp.png", $data);
	if ($success)
		echo '<img src="temp.jpeg">';
	else
		echo "shiiit";

	$bg = imagecreatefrompng('temp.png');
	$img = imagecreatefrompng($_POST['impose']);

	imagecopy($bg, $img, 0, 0, 0, 0, imagesx($bg), imagesy($bg));

	imagejpeg($bg, 'temp.jpeg', 100);

	unlink('temp.png');
?>
