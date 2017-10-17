<?php
	/* Code based on assumption that passed info is valid, js to validate live */

	if (!(isset($_POST['usr-name'])) || !(isset($_POST['usr-passwd']))) {
		#Entered page randomly, redirect to home
		header("Location: index.php");
	}
	
	print_r($_POST);
?>