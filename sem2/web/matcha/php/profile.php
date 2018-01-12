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
						<label for="usr-full-name">Username</label>
						<input type="text" name="usr-name" id="usr-name" class="form-control" placeholder="Username">
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
						<label for="usr-sex-pref">Sexual Preference</label>
						<textarea name="usr-sex-pref" id="usr-sex-pref" class="form-control"></textarea>
						<small>Please provide your gender preferences in single words with no capitals/spaces separated by a comma. Leave blank for no preference.</small>
					</div>
					<div class="form-group">
						<label for="usr-sex-pref">Bio</label>
						<textarea name="usr-bio" id="usr-bio" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="Change" class="form-control">
					</div>
				</form>
					<div class="form-group">
						<label>Profile Picture</label>
						<div class="container">
							<div class="row">
								<img id="prof-pic" src="mampstack.png" width="130" height="130">
							</div>
						</div>
						<small>Your other pictures.</small>
						<button type="button" class="btn btn-primary hidden" data-toggle="modal" data-target=".bd-example-modal-lg" id="modal-trigger">Large modal</button>
						<div class="container">
							<div class="row">
								<div class="image-list">
										<img id="prof-pic-1" src="mampstack.png" width="130" height="130">
									<div role="group">
										<button id="ch-prof-pic-1" class="form-control">Change</button><button id="rm-prof-pic-1" class="form-control">Remove</button>
									</div>
								</div>
								<div class="image-list">
										<img id="prof-pic-2" src="mampstack.png" width="130" height="130">
									<div >
										<button id="ch-prof-pic-2" class="form-control">Change</button><button id="rm-prof-pic-2" class="form-control">Remove</button>
									</div>
								</div>
								<div class="image-list">
										<img id="prof-pic-3" src="mampstack.png" width="130" height="130">
									<div >
										<button id="ch-prof-pic-3" class="form-control">Change</button><button id="rm-prof-pic-3" class="form-control">Remove</button>
									</div>
								</div>
								<div class="image-list">
										<img id="prof-pic-4" src="mampstack.png" width="130" height="130">
									<div >
										<button id="ch-prof-pic-4" class="form-control">Change</button><button id="rm-prof-pic-4" class="form-control">Remove</button>
									</div>
								</div>
								<div class="image-list">
										<img id="prof-pic-5" src="mampstack.png" width="130" height="130">
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
</div>