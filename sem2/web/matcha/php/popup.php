<?php session_start();
	if (isset($_GET['image_id']))
		$img_id = $_GET['image_id'];
	else
		$img_id = -1;
?>

<div class="container">
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-centered">
	    <div class="modal-content">
	    	<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Change your picture.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-popup">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<video autoplay="true" id="videoElement" width="640" height="480"></video>
				<canvas id="canvasElement" class="captureWind" width="640" height="480"></canvas>
				<div>
					<button id="captureElement">Capture</button>
					<button id="resetElement">Reset</button>
					<input type="file" id="tempUplElement">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="save-changes">Save changes</button>
			</div>
	    </div>
	  </div>
	</div>
	<form id="form1">
		<input type="hidden" id="popup-temp" value="0">
		<input type="hidden" id="tempIdElement" name="tempIdElement" value="<?php echo $img_id; ?>">
	  	<input type="hidden" id="tempImgElement" name="tempImgElement">
	</form>
	  <script type="text/javascript" src="js/script.js"></script>
</div>
