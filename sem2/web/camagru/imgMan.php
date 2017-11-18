<?php session_start();

	function showInfo($name)
	{
		$arr = unserialize(file_get_contents("../comments/" . $name . ".txt"));
		$likes = 0;
		$comments = "";
		foreach ($arr['comments'] as $key => $value) {
			$comments .= $value . "<br/>";
		}
		foreach ($arr['likes'] as $key => $value) {
			$likes++;
		}
		$return = "<p> $comments </p><p> Likes: $likes </p>";
		return ($return);
	}

	function addComment($name, $comment)
	{
		$usr = $_SESSION['usr-log'];
		$arr = unserialize(file_get_contents("../comments/" . $name . ".txt"));
		array_push($arr['comments'], "[ " . $usr . " ] - " . $comment);
		file_put_contents("../comments/" . $name . ".txt", serialize($arr));
		return (showInfo($name));
	}

	function addLike($name)
	{
		$usr = $_SESSION['usr-log'];
		$arr = unserialize(file_get_contents("../comments/" . $name . ".txt"));
		foreach ($arr['likes'] as $key => $value) {
			if ($value == $usr)
				return (showInfo($name));
		}
		array_push($arr['likes'], $usr);
		file_put_contents("../comments/" . $name . ".txt", serialize($arr));
		return (showInfo($name));
	}

	if (isset($_GET['wit']))
	{
		if ($_GET['wit'] == "comment")
		{
			echo addComment($_GET['img'], $_GET['comment']);
		}
		if ($_GET['wit'] == "like")
		{
			echo addLike($_GET['img']);
		}
	}
?>