<?php session_start();

	if (!(isset($_SESSION['active-usr']) && $_SESSION['active-usr'] != 'guest'))
	{
		header("Location: admin.php");
	}
	else
	{
		if (isset($_GET['view-profile']))
			$user = $_GET['view-profile'];
		else
			$user = $_SESSION['active_usr'];
	}

?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<img id="prof-pic" src="mampstack.png" width="130" height="130">
				<h1 id="usr-name">User</h1>
				<form>
					<div class="form-group">
						<label for="usr-first-name">First Name</label>
						<input type="text" name="usr-first-name" id="usr-first-name" class="form-control" placeholder="Full name">
					</div>
					<div class="form-group">
						<label for="usr-last-name">Last Name</label>
						<input type="text" name="usr-last-name" id="usr-last-name" class="form-control" placeholder="Full name">
					</div>
					<div class="form-group">
						<label for="usr-email">Email Address</label>
						<input type="email" name="usr-email" id="usr-email" class="form-control" placeholder="Email Address">
					</div>
					<div class="form-group">
						<label for="usr-gender">Gender</label>
						<input type="text" name="usr-gender" id="usr-gender" class="form-control" placeholder="Gender" aria-describedby="gender-info">
						<small id="gender-info">Please provide your gender in a single word with no capitals/spaces. We will use this for the matching process. Eg. male, female.</small>
					</div>
					<div class="form-group">
						<label for="usr-dob">Date of Birth</label>
						<input type="date" name="usr-dob" id="usr-dob" class="form-control" placeholder="Date of Birth">
					</div>
					<div class="form-group">
						<label for="usr-sex-pref">Sexual Preference</label>
						<textarea name="usr-sex-pref" id="usr-sex-pref" class="form-control"></textarea>
						<small>Please provide your gender preferences in single words with no capitals/spaces separated by a comma. Leave blank for no preference.</small>
					</div>
					<div class="form-group">
						<label for="usr-bio">Bio</label>
						<textarea name="usr-bio" id="usr-bio" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="usr-interests">Interests</label>
						<textarea name="usr-interests" id="usr-interests" class="form-control"></textarea>
						<small>ie #trains #stuff</small>
					</div>
				</form>

				<button type="button" class="btn btn-primary hidden" data-toggle="modal" data-target=".bd-example-modal-lg" id="modal-trigger">Large modal</button>
					<div class="form-group">
						<div class="container-fluid">
							<label>Profile Pictures</label>
							<div class="row">								
								<div class="image-list">
										<img id="prof-pic-1" src="imgs/usr/mampstack.png" width="130" height="130">
									<div role="group">
										<button id="ch-prof-pic-1" class="form-control">Change</button><button id="rm-prof-pic-1" class="form-control">Remove</button>
									</div>
								</div>
								<div class="image-list">
										<img id="prof-pic-2" src="imgs/usr/mampstack.png" width="130" height="130">
									<div >
										<button id="ch-prof-pic-2" class="form-control">Change</button><button id="rm-prof-pic-2" class="form-control">Remove</button>
									</div>
								</div>
								<div class="image-list">
										<img id="prof-pic-3" src="imgs/usr/mampstack.png" width="130" height="130">
									<div >
										<button id="ch-prof-pic-3" class="form-control">Change</button><button id="rm-prof-pic-3" class="form-control">Remove</button>
									</div>
								</div>
								<div class="image-list">
										<img id="prof-pic-4" src="imgs/usr/mampstack.png" width="130" height="130">
									<div >
										<button id="ch-prof-pic-4" class="form-control">Change</button><button id="rm-prof-pic-4" class="form-control">Remove</button>
									</div>
								</div>
								<div class="image-list">
										<img id="prof-pic-5" src="imgs/usr/mampstack.png" width="130" height="130">
									<div >
										<button id="ch-prof-pic-5" class="form-control">Change</button><button id="rm-prof-pic-5" class="form-control">Remove</button>
									</div>
								</div>
							</div>
						</div>						
					</div>
			</div>
		</div>
	</div>
	<div id="popup"></div>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#usr-first-name").change(function (){
			var val = $("#usr-first-name").val();
			$.post("php/user.php", {change_info: "firstname", info: val});
		});
		$("#usr-last-name").change(function (){
			var val = $("#usr-last-name").val();
			$.post("php/user.php", {change_info: "lastname", info: val});
		});
		$("#usr-email").change(function (){
			var val = $("#usr-email").val();
			$.post("php/user.php", {change_info: "email", info: val});
		});
		$("#usr-gender").change(function (){
			var val = $("#usr-gender").val();
			$.post("php/user.php", {change_info: "gender", info: val});
		});
		$("#usr-sex-pref").change(function (){
			var val = $("#usr-sex-pref").val();
			$.post("php/user.php", {change_info: "sexpref", info: val});
		});
		$("#usr-bio").change(function (){
			var val = $("#usr-bio").val();
			$.post("php/user.php", {change_info: "bio", info: val});
		});
		$("#usr-dob").change(function (){
			var val = $("#usr-dob").val();
			$.post("php/user.php", {change_info: "dob", info: val});
		});
		$("#usr-interests").change(function (){
			var val = $("#usr-interests").val();
			var arr = val.split(" ");
			var valid = "yes";
			for(var i = 0; i < arr.length; i++)
			{
				var res = arr[i].match(/\B(\#[a-zA-Z]+\b)(?!;)/);
				if (res == null)
					valid = "no";
			}
			if (valid == "yes")
				$.post("php/user.php", {change_info: "interests", info: val});
			else
			{
				$("#usr-interests").focus();
				alert("Wrong format please use the # and seperate with a space!");
			}
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
				$("#prof-pic-1").attr("src", "imgs/usr/mampstack.png");
			});
		});

		$("#rm-prof-pic-2").click(function (e){
			e.preventDefault();
			var url = $("#prof-pic-2").attr("src");
			$.post("php/user.php", {delete_img: url}).done(function (data){
				$("#prof-pic-2").attr("src", "imgs/usr/mampstack.png");
			});
		});

		$("#rm-prof-pic-3").click(function (e){
			e.preventDefault();
			var url = $("#prof-pic-3").attr("src");
			$.post("php/user.php", {delete_img: url}).done(function (data){
				$("#prof-pic-3").attr("src", "imgs/usr/mampstack.png");
			});
		});

		$("#rm-prof-pic-4").click(function (e){
			e.preventDefault();
			var url = $("#prof-pic-4").attr("src");
			$.post("php/user.php", {delete_img: url}).done(function (data){
				$("#prof-pic-4").attr("src", "imgs/usr/mampstack.png");
			});
		});

		$("#rm-prof-pic-5").click(function (e){
			e.preventDefault();
			var url = $("#prof-pic-5").attr("src");
			$.post("php/user.php", {delete_img: url}).done(function (data){
				$("#prof-pic-5").attr("src", "imgs/usr/mampstack.png");
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

	});
	</script>
</div>