<?php session_start();
	
?>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="container">
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-centered">
	    <div class="modal-content">
	    	<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
	    </div>
	  </div>
	  </div>
	  <script type="text/javascript">
	  		var video = document.getElementById('videoElement');

			if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
			// Not adding `{ audio: true }` since we only want video now
				navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
					video.src = window.URL.createObjectURL(stream);
					video.play();
				});
			}

			function captureImg()
			{
				var canvas = document.getElementById('canvasElement');
				var video = document.getElementById('videoElement');
				canvas.getContext('2d').drawImage(video, 0, 0);

			}
			function uploadImg()
			{
				var canvas = document.getElementById("canvasElement");
				var context = canvas.getContext('2d');
				var file = document.getElementById('tempUplElement').files[0];
				var reader = new FileReader();
				reader.onloadend = function ()
				{
					console.log(reader.result);
					var img = new Image();
					img.src = reader.result;
					img.onload = function ()
					{
						context.drawImage(img, 0 , 0);
					};
					canvas.style.visibility = "visible";
				};
				if (file){
					reader.readAsDataURL(file);
				}
			}

			function resetImg()
			{
				var canvas = $('#canvasElement')[0]; // or document.getElementById('canvas');
				canvas.width = canvas.width;
			}

			document.getElementById('captureElement').addEventListener("click", captureImg);
			document.getElementById('resetElement').addEventListener("click", resetImg);
			document.getElementById('tempUplElement').addEventListener("change", uploadImg);
	  </script>
</div>
