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
						<label>Profile Picture</label>
						<div class="container">
							<div class="row">
								<img src="../mampstack.png" width="120" height="120">
							</div>
						</div>
						<small>Your other pictures.</small>
						<div>
							<div class="image-list">
								<div class="row">
									<img src="../mampstack.png" width="120" height="120">
								</div>
								<div class="row" role="group">
									<button>Change</button><button>Remove</button>
								</div>
							</div>
							<div class="image-list">
								<div class="row">
									<img src="../mampstack.png" width="120" height="120">
								</div>
								<div class="row">
									<button>Change</button><button>Remove</button>
								</div>
							</div>
							<div class="image-list">
								<div class="row">
									<img src="../mampstack.png" width="120" height="120">
								</div>
								<div class="row">
									<button>Change</button><button>Remove</button>
								</div>
							</div>
							<div class="image-list">
								<div class="row">
									<img src="../mampstack.png" width="120" height="120">
								</div>
								<div class="row">
									<button>Change</button><button>Remove</button>
								</div>
							</div>
							<div class="image-list">
								<div class="row">
									<img src="../mampstack.png" width="120" height="120">
								</div>
								<div class="row">
									<button>Change</button><button>Remove</button>
								</div>
							</div>
						</div>						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>