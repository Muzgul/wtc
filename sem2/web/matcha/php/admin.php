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
<script type="text/javascript" src="js/script.js"></script>