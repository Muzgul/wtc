<?php session_start();
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
	$user = getUser($_GET['usrname']);
	if ($user == null)
		header("Location: ../index.html");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $user['usrname']; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<div class="container-fluid">
        <h1 id="usrname"><?php echo $user['usrname']; ?></h1>
        <h2><?php echo $user['firstname'];?> <?php echo $user['lastname'];?></h2>
        <p><?php echo $user['bio'];?></p>
        <button id="like-user">Like</button>
	</div>

	<!-- INCLUDES -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function (){
			$("#like-user").click(function (){
				var usrname = $("#usrname").text();
				$.post("user.php", {like_user: usrname}).done(function (){
					alert("Liked!");
				});
			});
		});
	</script>
</body>
</html>