<?php session_start();
	include "imgMan.php";
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
		<button onclick="addComment();">Comment</button>
		<button onclick="addLike();">Like</button>
		<div id="imgInfo"><?php echo showInfo($_GET['name'], $_GET['url']); ?></div>
	</div>

	<script type="text/javascript">
		
		function addComment()
		{
			var comment = document.getElementById("imgComment").value;
			var img = document.getElementById("imgDisp").alt;
			if (comment.trim() != "")
			{
	            var xhr = new XMLHttpRequest();
	            var url = 'imgMan.php?wit=comment&comment=' + comment + '&img=' + img;
	            xhr.open('GET', url, false);

				xhr.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				      document.getElementById("imgInfo").innerHTML =
				      this.responseText;
				    }
				};

	            xhr.send(null);
			}
		}

		function addLike()
		{
			var img = document.getElementById("imgDisp").alt;
			var xhr = new XMLHttpRequest();
            var url = 'imgMan.php?wit=like&img=' + img;
            xhr.open('GET', url, false);

			xhr.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			      document.getElementById("imgInfo").innerHTML =
			      this.responseText;
			    }
			};

            xhr.send(null);
		}
	</script>
</body>
</html>