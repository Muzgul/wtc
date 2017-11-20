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
			// do something
		}

		//Capture image from video

		function captureImg()
		{
			var canvas = document.getElementById('canvasElement');
			var video = document.getElementById('videoElement');
			canvas.getContext('2d').drawImage(video, 0, 0);
			video.style.visibility = "hidden";
			canvas.style.visibility = "visible";
			document.getElementById('saveElement').disabled = false;
		}

		function resetImg()
		{
			document.getElementById("tempUplElement").value = "";
			document.getElementById("logElement").innerHTML = "[ See your image here ]";
			document.getElementById('saveElement').disabled = true;
			document.getElementById('captureElement').disabled = true;
			var canvas = document.getElementById('canvasElement');
			var canvas2 = document.getElementById('imposeElement');
			var video = document.getElementById('videoElement');
			video.style.visibility = "visible";
			canvas.style.visibility = "hidden";
			canvas2.style.visibility = "hidden";
		}

		function saveImg()
		{
			var canvas = document.getElementById("canvasElement");
			document.getElementById('tempImgElement').value = canvas.toDataURL("image/png");
            var fd = new FormData(document.forms["form1"]);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/capture-save.php', true);

			xhr.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			      window.location.replace(this.responseText);
			    }
			};

            xhr.onload = function() {

            };
            xhr.send(fd);
		}

		function drawImg(url)
		{
			document.getElementById('tempImpElement').value = url;
			var canvas = document.getElementById("imposeElement");
			canvas.style.visibility = "visible";
			var context = canvas.getContext('2d');
			context.clearRect(0, 0, canvas.width, canvas.height);
			var img = new Image();
			img.src = url;
			img.onload = function () { 
				context.drawImage(img, 0, 0);
			};
			document.getElementById('tempImpElement').value = url;
			canvas.style.visibility = "visible";
			document.getElementById('captureElement').disabled = false;
		}

		function uploadImg()
		{
			document.getElementById('saveElement').disabled = false;
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

		
		document.getElementById('captureElement').addEventListener("click", captureImg);
		document.getElementById('resetElement').addEventListener("click", resetImg);
		document.getElementById('saveElement'). addEventListener("click", saveImg);
		document.getElementById('tempUplElement').addEventListener("change", uploadImg);

		document.onload = function(){
			document.getElementById('saveElement').disabled = true;
			document.getElementById('captureElement').disabled = true;
		};