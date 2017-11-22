<?php session_start();
	include "php/img-func.php";

	$img = getImg($_GET['name']);
	$user = $_SESSION['usr-log'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Make Me Magic</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="container">
		<div>
			<img id="imgDisp" src="<?php echo $img['url']?>" alt="<?php echo $img['name'] ?>" width="640" height="480">		
		</div>		
	</div>
	<div id="under-container">
		<input id="imgComment" type="text" name="comment" placeholder="Type comment here...">
		<button id="btnComment" 
			<?php if ($_SESSION['usr-log'] == "Guest") { echo "disabled"; }?>
		>Comment</button>
		<button id="btnLike" 
			<?php if ($_SESSION['usr-log'] == "Guest") { echo "disabled"; }?>
		>Like</button>
		<button id="btnDelete"
			<?php if ($user != $img['creator']) { echo "disabled";} ?>
		>Delete</button>
		<div id="imgInfo"><?php echo showInfo($_GET['name'], $_GET['url']); ?></div>
	</div>
	<script type="text/javascript" src="js/image.js"></script>
	</div>

	<div id="footer">
		<div>by Murray MacDonald</div>
		<!--- Insert social media -->
		<a href="index.php"><div id="header-title"><p>Make Me Magic</p></div></a>
		<a href="index.php?logout=true"><div class="header-clickables"><p>Log out</p></div></a>
	</div>
</body>
</html>