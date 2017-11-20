<?php session_start();
	include "php/img-func.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>ayyy</title>
</head>
<body>
	<a href="index.php">Home</a>
	<div>
		<img id="imgDisp" src="<?php echo $_GET['url']?>" alt="<?php echo $_GET['name'] ?>" width="640" height="480">		
	</div>
	<div>
		<input id="imgComment" type="text" name="comment" placeholder="Type comment here...">
		<button id="btnComment" 
			<?php if ($_SESSION['usr-log'] == "Guest") { echo "disabled"; }?>
		>Comment</button>
		<button id="btnLike" 
			<?php if ($_SESSION['usr-log'] == "Guest") { echo "disabled"; }?>
		>Like</button>
		<div id="imgInfo"><?php echo showInfo($_GET['name'], $_GET['url']); ?></div>
	</div>

	<script type="text/javascript" src="js/image.js"></script>
</body>
</html>