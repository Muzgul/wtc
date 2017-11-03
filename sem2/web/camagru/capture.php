<?php 
	/*  CODE TO LOOK AT! 
		<?php
			header('Content-Type: image/jpeg');

			$bg = imagecreatefromjpeg('background.jpg');
			$img = imagecreatefromjpeg('image.jpg');

			imagecopymerge($bg, $img, 0, 0, 0, 0, imagesx($bg), imagesy($bg), 75);

			imagejpeg($bg, null, 100);
		?>
		https://trinitytuts.com/capture-and-save-image-with-html5-and-php/
	*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>ayy</title>
	<style>
	#container {
	    margin: 0px auto;
	    width: 500px;
	    height: 375px;
	    border: 10px #333 solid;
	}
	#videoElement {
	    width: 500px;
	    height: 375px;
	    background-color: #666;
	}
	</style>
	
</head>
<body>
	<div id="container">
		<video autoplay="true" id="videoElement">
			
		</video>
	</div>
	<script type="text/javascript">
		var video = document.querySelector("#videoElement");
 
		navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
		 
		if (navigator.getUserMedia) {       
		    navigator.getUserMedia({video: true}, handleVideo, videoError);
		}
		 
		function handleVideo(stream) {
		    video.src = window.URL.createObjectURL(stream);
		}
		 
		function videoError(e) {
		    // do something
		}
	</script>
</body>
</html>
