<?php 
	/*  CODE TO LOOK AT! 
		
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
	    width: 640px;
	    height: 480px;
	    border: 10px #333 solid;
	    position: relative;
	}
	.captureWind {
	    background-color: #666;
	    position: absolute;
	    top: 0;
	    left: 0;
	}
	#canvasElement {
		visibility: hidden;
	}
	</style>
	
</head>
<body>
	<div id="container">
		<video autoplay="true" id="videoElement" class="captureWind" width="640" height="480">
			
		</video>
		<canvas id="canvasElement" class="captureWind" width="640" height="480">
			
		</canvas>
	</div>
	<button id="captureElement">Capture</button>
	<button id="resetElement">Reset</button>
	<button id="saveElement" download="temp.jpeg">Save</button>
	<script type="text/javascript">

		//Load video webcam if available
		var video = document.getElementById('videoElement');
 
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

		//Capture image from video

		function captureImg(){
			var canvas = document.getElementById('canvasElement');
			var video = document.getElementById('videoElement');
			canvas.getContext('2d').drawImage(video, 0, 0);
			video.style.visibility = "hidden";
			canvas.style.visibility = "visible";
		}

		function resetImg()
		{
			var canvas = document.getElementById('canvasElement');
			var video = document.getElementById('videoElement');
			video.style.visibility = "visible";
			canvas.style.visibility = "hidden";
		}

		function saveImg()
		{
			var canvas = document.getElementById("canvasElement");
			var image = canvas.toDataURL("image/jpeg");
			window.location = image;
		}

		document.getElementById('captureElement').addEventListener("click", captureImg);
		document.getElementById('resetElement').addEventListener("click", resetImg);
		document.getElementById('saveElement'). addEventListener("click", saveImg);

	</script>
</body>
</html>
