<?php session_start();



?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="jumbotron">
				<h1>Welcome to Matcha!</h1>
				<p>Please sign up below to begin your search. We promise to not give away any of your private information. No one seems to want it anyway xD</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<ul class="nav nav-tabs nav-justified" role="tablist">
					<li role="presentation" class="active">
						<a href="#panRegister" aria-controls="panRegister" role="tab" data-toggle="tab">Register</a>
					</li>
					<li role="presentation">
						<a href="#panLogin" aria-controls="panLogin" role="tab" data-toggle="tab">Log in</a>		
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="panRegister">
						<form id="reg-form">
							<div class="form-group">
								<label for="reg-usrname">Username</label>
								<input type="text" id="reg-usrname" name="reg-usrname" class="form-control" placeholder="Username" required>
							</div>
							<div class="form-group">
								<label for="reg-passwd1">Password</label>
								<input type="password" id="reg-passwd1" name="reg-passwd1" class="form-control" placeholder="Password" aria-describedby="reg-passwd1-desc" required>
								<small id="reg-passwd1-desc">Minimum of 6 character with atleast one UPPER CASE letter and one NUMBER.</small>
							</div>
							<div class="form-group">
								<label for="reg-passwd2">Re-type Password</label>
								<input type="password" id="reg-passwd2" name="reg-passwd2" class="form-control" placeholder="Re-type Password" required>
							</div>
							<div class="form-group">
								<label for="reg-email">Email Adress</label>
								<input type="email" id="reg-email" name="reg-email" class="form-control" placeholder="Enter@Email.Address" aria-describedby="reg-email-desc" required>
								<small id="reg-email-desc">We won't share this with anyone.</small>
							</div>
							<div class="form-group">
								<input type="submit" id="reg-submit" name="reg-submit" value="Register" class="form-control">
							</div>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane" id="panLogin">
						<form id="login-form">
							<div class="form-group">
								<label for="login-usrname">Username</label>
								<input type="text" id="login-usrname" name="login-usrname" placeholder="Username" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="login-passwd1">Password</label>
								<input type="password" id="login-passwd1" name="login-passwd1" placeholder="Password" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="submit" id="login-submit" name="login-submit" value="Log in" class="form-control">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function (){

	//Registration


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
			{
				$("#panProfile").load("php/profile.php");
				var user;
				$.post( "php/session.php", {get_session: "yes"}).done(function (data){			
					$.post( "php/user.php", { get_user: data}).done(function( more_data ) {
		    			var arr = jQuery.parseJSON(more_data);
		    			$("#usr-first-name").val(arr['firstname']);
		    			$("#usr-last-name").val(arr['lastname']);
		    			$("#usr-name").text(arr['usrname']);
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
			else
				alert("Incorrect details! Please make sure you have verified your account!");
		});
	});
});
</script>