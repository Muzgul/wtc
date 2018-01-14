$( document ).ready(function() {
	//INFORMATION LOAD
	function load_profile(){
		$("#panProfile").load("php/profile.php");
		var user;
		$.post( "php/session.php", {get_session: "yes"}).done(function (data){			
			$.post( "php/user.php", { get_user: data}).done(function( more_data ) {
    			var arr = jQuery.parseJSON(more_data);
    			$("#usr-first-name").val(arr['firstname']);
    			$("#usr-last-name").val(arr['lastname']);
    			$("#usr-name").val(arr['usrname']);
    			$("#usr-gender").val(arr['gender']);
    			$("#usr-sex-pref").val(arr['sexpref']);
    			$("#usr-bio").val(arr['bio']);
    			$("#usr-email").val(arr['email']);
    			$("#prof-pic").attr("src", arr['profpic']);
	  		});
	  		$.post("php/user.php", { get_user_imgs: data}).done(function (more_data){
	  			var arr = jQuery.parseJSON(more_data);
	  			for (var i = 0; i < arr.length; i++)
	  			{
	  				if (i == 0)
	  					$("#prof-pic-1").attr("src", arr[i]['url']);
	  				if (i == 1)
	  					$("#prof-pic-2").attr("src", arr[i]['url']);
	  				if (i == 2)
	  					$("#prof-pic-3").attr("src", arr[i]['url']);
	  				if (i == 3)
	  					$("#prof-pic-4").attr("src", arr[i]['url']);
	  				if (i == 4)
	  					$("#prof-pic-5").attr("src", arr[i]['url']);
	  			}
	  		});

		});
	}

	$("#btnExplore").click(function (){
		$("#panExplore").load("php/explore.php");
	});

	$('#btnProfile').click(function () {

		$.get("php/session.php", { session: "yes"})
			.done(function (data){
				if (data == "true")
				{
					load_profile();
				}
				else if (data == "false")
				{
					$("#panProfile").load("php/admin.php");
				}
			});
	});

	//REGISTER FORM

	$("#reg-usrname").change(function (){
		var url = "php/db_func.php?check-usr=" + $("#reg-usrname").val();
		$.get(url).done(function (data) {
			if (data == 0) //Already Exists
			{
				$("#reg-usrname").val("");
				$("#reg-usrname").focus();
				$("#reg-passwd1").addClass("alert alert-danger");
				$(":submit").attr("disabled", true);
				alert("Username already exists!");
			}
			else
			{
				$("#reg-passwd1").removeClass("alert alert-danger");
				$(":submit").removeAttr("disabled");
			}
		});
	});

	$("#modal-trigger").click(function (){
		if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	// Not adding `{ audio: true }` since we only want video now
			alert("Camera Loading");
			navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
				$("#videoElement").src = window.URL.createObjectURL(stream);
				$("#videoElement").play();
			});
		}
		else
			alert("Problem loading camera.");
	});

	$("#ch-prof-pic-1").click(function (e){
		e.preventDefault();
		$("#popup").load("php/popup.php?image_id=1", function (){
			$("#modal-trigger").click();
		});
	});

	$("#ch-prof-pic-2").click(function (e){
		e.preventDefault();
		$("#popup").load("php/popup.php?image_id=2", function (){
			$("#modal-trigger").click();
		});
	});

	$("#ch-prof-pic-3").click(function (e){
		e.preventDefault();
		$("#popup").load("php/popup.php?image_id=3", function (){
			$("#modal-trigger").click();
		});
	});

	$("#ch-prof-pic-4").click(function (e){
		e.preventDefault();
		$("#popup").load("php/popup.php?image_id=4", function (){
			$("#modal-trigger").click();
		});
	});

	$("#ch-prof-pic-5").click(function (e){
		e.preventDefault();
		$("#popup").load("php/popup.php?image_id=5", function (){
			$("#modal-trigger").click();
		});
	});

	$("#rm-prof-pic-1").click(function (e){
		e.preventDefault();
		var url = $("#prof-pic-1").attr("src");
		$.post("php/user.php", {delete_img: url}).done(function (data){
			$("#prof-pic-1").attr("src", "mampstack.png");
		});
	});

	$("#rm-prof-pic-2").click(function (e){
		e.preventDefault();
		var url = $("#prof-pic-2").attr("src");
		$.post("php/user.php", {delete_img: url}).done(function (data){
			$("#prof-pic-2").attr("src", "mampstack.png");
		});
	});

	$("#rm-prof-pic-3").click(function (e){
		e.preventDefault();
		var url = $("#prof-pic-3").attr("src");
		$.post("php/user.php", {delete_img: url}).done(function (data){
			$("#prof-pic-3").attr("src", "mampstack.png");
		});
	});

	$("#rm-prof-pic-4").click(function (e){
		e.preventDefault();
		var url = $("#prof-pic-4").attr("src");
		$.post("php/user.php", {delete_img: url}).done(function (data){
			$("#prof-pic-4").attr("src", "mampstack.png");
		});
	});

	$("#rm-prof-pic-5").click(function (e){
		e.preventDefault();
		var url = $("#prof-pic-5").attr("src");
		$.post("php/user.php", {delete_img: url}).done(function (data){
			$("#prof-pic-5").attr("src", "mampstack.png");
		});
	});

	$("#prof-pic-1").click(function (e){
		var url = $("#prof-pic-1").attr("src");
		$.post("php/user.php", {change_profpic: url}).done(function (){
			$("#prof-pic").attr("src", url);
		});
	});

	$("#prof-pic-2").click(function (e){
		var url = $("#prof-pic-2").attr("src");
		$.post("php/user.php", {change_profpic: url}).done(function (){
			$("#prof-pic").attr("src", url);
		});
	});

	$("#prof-pic-3").click(function (e){
		var url = $("#prof-pic-3").attr("src");
		$.post("php/user.php", {change_profpic: url}).done(function (){
			$("#prof-pic").attr("src", url);
		});
	});

	$("#prof-pic-4").click(function (e){
		var url = $("#prof-pic-4").attr("src");
		$.post("php/user.php", {change_profpic: url}).done(function (){
			$("#prof-pic").attr("src", url);
		});
	});

	$("#prof-pic-5").click(function (e){
		var url = $("#prof-pic-5").attr("src");
		$.post("php/user.php", {change_profpic: url}).done(function (){
			$("#prof-pic").attr("src", url);
		});
	});

	//Registration

	$("#reg-passwd1").change(function (){
		var res = $("#reg-passwd1").val().match("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
		if (res || $("#reg-passwd1").val() == "")
		{
			$("#reg-passwd1").removeClass("alert alert-danger");
			$(":submit").removeAttr("disabled");
		}
		else
		{
			$(":submit").attr("disabled", true);
			$("#reg-passwd1").addClass("alert alert-danger");			
		}
	});
	$("#reg-passwd2").change(function (){
		var res = $("#reg-passwd2").val().match($("#reg-passwd1").val());
		if (res && res != "" || $("#reg-passwd2").val() == "")
		{
			$("#reg-passwd2").removeClass("alert alert-danger");
			$(":submit").removeAttr("disabled");
		}
		else
		{
			$(":submit").attr("disabled", true);
			$("#reg-passwd2").addClass("alert alert-danger");
		}
	});

	$('#reg-form').submit(function (e) {
		e.preventDefault();
  		$.post("php/auth.php", $("#reg-form").serialize(), function (data) 
		{
			if (data == 1)
				alert("Thank you! Please login to continue.");
			else
				alert("Problem registering you!");
		});
	});
	$('#login-form').submit(function (e) {
		e.preventDefault();
		$.post("php/auth.php", $("#login-form").serialize(), function (data) 
		{
			if (data == 1)
				load_profile();
			else
				alert("Incorrect details!");
		});
	});

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



