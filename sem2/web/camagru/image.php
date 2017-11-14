<?php session_start();
	
	function showInfo($name)
	{
		$arr = unserialize(file_get_contents("../comments/" . $name . ".txt"));
		$likes = 0;
		$comments = "";
		foreach ($arr['comments'] as $key => $value) {
			$comments .= "[ " . $key . " ] - " . $value . PHP_EOL;
		}
		foreach ($arr['likes'] as $key => $value) {
			$likes++;
		}
		$return = "<p> $comments </p><p> Likes: $likes </p>";
		return ($return);
	}

	function addComment($name, $comment)
	{
		echo "yeah";
		$usr = $_SESSION['usr-log'];
		$arr = unserialize(file_get_contents("../comments/" . $name . ".txt"));
		$arr['comments'][$usr] = $comment;
		file_put_contents("../comments/" . $name . ".txt", serialize($arr));
		return (showInfo($name));
	}

	function addLike($name)
	{
		$usr = $_SESSION['usr-log'];
		$arr = unserialize(file_get_contents("../comments/" . $name . ".txt"));
		array_push($arr['likes'], $usr);
		return (showInfo($name));
	}
	
	print_r($_GET);
	print_r($arr);
?>
<!DOCTYPE html>
<html>
<head>
	<title>ayyy</title>
</head>
<body>
	<div>
		<img id="imgDisp" src="<?php echo $_GET['url']?>" alt="<?php echo $_GET['name'] ?>" width="640" height="480">		
	</div>
	<div>
		<input id="imgComment" type="text" name="comment" placeholder="Type comment here...">
		<form action="" method="POST"><input type="submit" id="btnComment" value="Comment"></form><button>Like</button>
		<div id="imgInfo"><?php echo showInfo($_GET['name'], $_GET['url']); ?></div>
	</div>

	<script type="text/javascript">
		
		FINISH THE CONNECTION WITH THE HTTP REQUEST!
	</script>
</body>
</html>