<?php
	include "capture-func.php";

	$img = $_POST['img'];
	$impose = $_POST['impose'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file_name = time().uniqid(rand()) . ".jpeg";
	$url = "imgs/usr/" . $file_name;

	$success = file_put_contents("temp.png", $data);

	$bg = imagecreatefrompng('temp.png');
	$img = imagecreatefrompng("../" . $impose);

	imagecopy($bg, $img, 0, 0, 0, 0, imagesx($bg), imagesy($bg));

	imagejpeg($bg, "../" . $url, 100);

	unlink('temp.png');

	echo newImg($_POST['usr'], $file_name, $url);
?>
