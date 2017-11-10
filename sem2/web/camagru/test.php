<?php
	include "dbman.php";

	$img = $_POST['img'];
	$impose = $_POST['impose'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file_name = "../imgs/usr/" . time().uniqid(rand()) . ".jpeg";
	
	$success = file_put_contents("temp.png", $data);
	if ($success)
		echo '<img src="' . $file_name . '">';
	else
		echo "shiiit";

	$bg = imagecreatefrompng('temp.png');
	$img = imagecreatefrompng($impose);

	imagecopy($bg, $img, 0, 0, 0, 0, imagesx($bg), imagesy($bg));

	imagejpeg($bg, $file_name, 100);

	unlink('temp.png');

	newImg($_POST['usr'], $file_name, $file_name);
?>
