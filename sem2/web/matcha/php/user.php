<?php session_start();
	

	function viewUser($usrname)
	{
		if (isset($_SESSION['active-usr']) && $_SESSION['active-usr'] != "guest" && $_SESSION['active-usr'] != $usrname)
		{
			$already_there = 0;
			$user = getUser($usrname);
			$arr = json_decode($user['misc']);
			$views = $arr->{'views'};

			foreach ($views as $value) {
				if ($value == $_SESSION['active-usr'])
					$already_there = 1;
			}			
			if ($already_there == 0)
			{
				array_push($views, $_SESSION['active-usr']);
				$arr->{'views'} = $views;
				$option = array('usrname' => $usrname, 'change_info' => 'misc', 'info' => json_encode($arr));
				changeInfo($option);
			}
		}
	}

	function likeUser($usrname)
	{
		if (isset($_SESSION['active-usr']) && $_SESSION['active-usr'] != "guest" && $_SESSION['active-usr'] != $usrname)
		{
			$already_there = 0;
			$user = getUser($usrname);
			$arr = json_decode($user['misc']);
			$likes = $arr->{'likes'};

			foreach ($likes as $value) {
				if ($value == $_SESSION['active-usr'])
					$already_there = 1;
			}			
			if ($already_there == 0)
			{
				array_push($likes, $_SESSION['active-usr']);
				$arr->{'likes'} = $likes;
				$option = array('usrname' => $usrname, 'change_info' => 'misc', 'info' => json_encode($arr));
				changeInfo($option);
			}
		}
	}

	function getUser($usrname)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM `tbladmin`
					WHERE `usrname` LIKE '" . $usrname . "'";
			foreach ($conn->query($sql)	as $row)
			{
				$conn = null;
				return ($row);
			}
		}
		catch (PDOException $exception)
		{
			echo "[ getUser Error : " . $exception->getMessage() . "]<br/>";
		}
		return (null);
	}

	function getUsers($option)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";

		//$sql = "SELECT * FROM `tbladmin`";
		if ($option['get_users'] == "all")
			$sql = "SELECT * FROM `tbladmin`";
		if ($option['get_users'] == "gender")
			$sql = "SELECT * FROM `tbladmin`
					WHERE `gender` LIKE '" . $option['gender'] . "%'";
		if ($option['get_users'] == "usrname")
			$sql = "SELECT * FROM `tbladmin`
					WHERE `usrname` LIKE '%" . $option['usrname'] . "%'";
		if ($option['get_users'] == "recomend")
		{
			if (isset($_SESSION['active-usr']) && $_SESSION['active-usr'] != "guest")
			{
				$sql = "SELECT * FROM `tbladmin`";
				$user = getUser($_SESSION['active-usr']);
				$arr = explode(" ", $user['interests']);
				for($i = 0; $i < sizeof($arr); $i++)
				{
					if ($i == 0)
						$sql .= "WHERE `interests` LIKE '%" . $arr[$i] . "%'";
					else
						$sql .= "OR `interests` LIKE '%" . $arr[$i] . "%'";
				}
			}else
				$sql = "SELECT * FROM `tbladmin`";
		}
		if ($option['get_users'] == "age")
		{
			$min = date('Y-m-d', strtotime($option['min_age'] . ' years ago'));
			$max = date('Y-m-d', strtotime($option['max_age'] . ' years ago'));
			$sql = "SELECT * FROM `tbladmin` WHERE `dob` <= '" . $min . "' AND `dob` > '" . $max . "'";
		}
		if ($option['get_users'] == "interests")
		{
			$arr = explode(" ", $option['interests']);
			$sql = "SELECT * FROM `tbladmin`";
			for($i = 0; $i < sizeof($arr); $i++)
			{
				if ($i == 0)
					$sql .= "WHERE `interests` LIKE '%" . $arr[$i] . "%'";
				else
					$sql .= "OR `interests` LIKE '%" . $arr[$i] . "%'";
			}
		}

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$text = "Users:\n";
			$counter = 0;
			foreach ($conn->query($sql)	as $row)
			{
				if ($row['usrname'] != $_SESSION['active-usr'])
				{
					if ($counter % 10 == 0)
						$imgs .= "<tr>";
					$text .= '
						<td>
							<div clas="container">
								<img src="' . $row['profpic'] . '">
								<h3 id="view-user-name">' . $row['usrname'] . '</h3>
								<small>' . $row['gender'] . ' | ' . $row['sexpref'] . '</small>
								<a href="php/view_user.php?usrname=' . $row['usrname'] . '" target="_blank" class="view-user-link">See more.</a>
							</div>
						</td>
					';
					if ($img_count % 9 == 0 && $img_count != 0)
						$imgs .= "</tr>";
				}
			}
			$text .= "
				<script type='text/javascript'>
					$( document ).ready(function() {

						$('.view-user-link').click(function (){
							var usrname = $('#view-user-name').text();
							$.post('user.php', {view_user: usrname}).done(function (data){
								alert(data);
							});
						});
			
					});
				</script>
			";
			return ($text);
		}
		catch (PDOException $exception)
		{
			echo "[ getUser Error : " . $exception->getMessage() . "]<br/>";
		}
		return (null);
	}

	function getImgs($usrname)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";
		$arr = array();
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM `tblimg`
					WHERE `creator` LIKE '" . $usrname . "'";
			foreach ($conn->query($sql)	as $row)
			{
				$conn = null;
				array_push($arr, $row);				
			}
			return ($arr);
		}
		catch (PDOException $exception)
		{
			echo "[ getUser Error : " . $exception->getMessage() . "]<br/>";
		}
		return (null);
	}

	function deleteImg($url)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM `tblimg`
					WHERE `url` LIKE '" . $url . "'";
			$conn->query($sql);
		}
		catch (PDOException $exception)
		{
		}
	}

	function changeProfpic($url)
	{
		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";

		$usr_name = $_SESSION['active-usr'];
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbladmin`
					SET `profpic` = '" . $url . "'
					WHERE `usrname` LIKE '" . $usr_name . "'";
			$conn->exec($sql);
			return (true);
		}
		catch (PDOException $exception)
		{
		}
		return (false);
	}

	function changeInfo($option)
	{	
		if (isset($option['usrname']))
			$usrname = $option['usrname'];
		else
			$usrname = $_SESSION['active-usr'];
		$sql = "UPDATE `tbladmin`";
		$sql .= "SET `" . $option['change_info'] . "` = '" . $option['info'] . "'
					WHERE `usrname` LIKE '" . $usrname . "'";

		$servername = "localhost";
		$username = "root";
		$password = "cullygme";
		$dbname = "matcha";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// Error mode: exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec($sql);
			return (true);
		}
		catch (PDOException $exception)
		{
		}
		return (false);
	}

	if (isset($_POST['get_user']))
		echo json_encode(getUser($_POST['get_user']));
	if (isset($_POST['change_profpic']))
		changeProfpic($_POST['change_profpic']);
	if (isset($_POST['get_user_imgs']))
		echo json_encode(getImgs($_POST['get_user_imgs']));
	if (isset($_POST['delete_img']))
		deleteImg($_POST['delete_img']);
	if (isset($_POST['get_users']))
		echo getUsers($_POST);
	if (isset($_POST['change_info']))
		changeInfo($_POST);
	if (isset($_POST['view_user']))
		viewUser($_POST['view_user']);
	if (isset($_POST['like_user']))
		likeUser($_POST['like_user']);
?>