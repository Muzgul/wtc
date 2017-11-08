<?php session_start();
	/*  CODE TO LOOK AT! 
		
		https://trinitytuts.com/capture-and-save-image-with-html5-and-php/
	*/
	include "dbman.php";

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
	    position: absolute;
	    top: 0;
	    left: 0;
	}
	#canvasElement{
		visibility: hidden;
	}
	</style>
	
</head>
<body>
	<form id="form1"><input type="hidden" id="tempImgElement" name="img"><input type="hidden" id="tempImpElement" name="impose"></form>
	<div id="container">
		<video autoplay="true" id="videoElement" class="captureWind" width="640" height="480"></video>
		<canvas id="canvasElement" class="captureWind" width="640" height="480"></canvas>
		<canvas id="imposeElement" class="captureWind" width="640" height="480"></canvas>
	</div>
	
	<button id="captureElement">Capture</button>
	<button id="resetElement">Reset</button>
	<button id="saveElement" disabled="false">Save</button>
	<input type="file" id="tempUplElement">
	<?php echo getImpose(); ?>
	<div id="logElement">[ See your image here ]</div>
	<script type="text/javascript" src="func.js"></script>
	
</body>
</html>
