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
	<script type="text/javascript">
	var video = document.getElementById('videoElement');

	navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
	
	if (navigator.getUserMedia)
	{
		navigator.getUserMedia({video: true}, handleVideo, videoError);
	}
	
	function handleVideo(stream)
	{
		video.src = window.URL.createObjectURL(stream);
	}
	
	function videoError(e)
	{
		alert("Video error!");
	}

	$(document).ready(function (){
		$("#resetElement").click(function (){
			var canvas = $("#canvasElement")[0];
			canvas.width = canvas.width;
			$("#popup-temp").val() = "0";
		});
		
		$("#captureElement").click(function (){
			var canvas = document.getElementById('canvasElement');
			var video = document.getElementById('videoElement');
			canvas.getContext('2d').drawImage(video, 0, 0);
			document.getElementById("popup-temp").value = "1";
		});

		$("#tempUplElement").click(function (){
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
				document.getElementById("popup-temp").value = "1";
			};
			if (file){
				reader.readAsDataURL(file);
			}
		});

		$("#save-changes").click(function (){
			var elem = document.getElementById("popup-temp");
			if (elem.value == "1")
			{
				var canvas = document.getElementById("canvasElement");
				$.post("php/image_save.php", {popup_temp: "pic_no", img: canvas.toDataURL("image/png")}).done(function (data) {
					var temp = $("#tempIdElement").val();
					if (temp == "1")
	  					$("#prof-pic-1").attr("src", data);
	  				if (temp == "2")
	  					$("#prof-pic-2").attr("src", data);
	  				if (temp == "3")
	  					$("#prof-pic-3").attr("src", data);
	  				if (temp == "4")
	  					$("#prof-pic-4").attr("src", data);
	  				if (temp == "5")
	  					$("#prof-pic-5").attr("src", data);
				});
		    }
		    document.getElementById('close-popup').click();
		});
	});
	</script>
</div>
