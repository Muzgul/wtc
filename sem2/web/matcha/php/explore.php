<?php session_start();
	
?>

<div class="content">
	<div class="container-fluid">
		<div class="row">

				<input type="text" id="exp-search">
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Category
					<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#" id="exp-opt-all">All</a></li>
						<li><a href="#" id="exp-opt-usrname">Username</a></li>
						<li><a href="#" id="exp-opt-gender">Gender</a></li>
						<li><a href="#">Age?</a></li>
					</ul>
				</div>
		
		</div>
		<div class="row">
			<h1 id="exp-header">All</h1>
		</div>
		<div class="row">
			<div class="container-fluid">
				<table id="exp-content">
					exp-content
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$( document ).ready(function() {
			var loadAll = function(){
				$("#exp-header").text("All");
				$.post("php/user.php", {get_users: "all"}).done(function (data){
					$("#exp-content").html(data);
				});
			};
			var loadGender = function(){
				$("#exp-header").text("Gender");
				var value = $("#exp-search").val();
				$.post("php/user.php", {get_users: "gender", gender: value}).done(function (data){
					$("#exp-content").html(data);
				});
			};
			var loadUsername = function(){
				$("#exp-header").text("Username");
				var value = $("#exp-search").val();
				$.post("php/user.php", {get_users: "usrname", usrname: value}).done(function (data){
					$("#exp-content").html(data);
				});
			};
			$("#exp-opt-all").click(function (){
				loadAll();
			});
			$("#exp-opt-gender").click(function (){
				loadGender();
			});
			$("#exp-opt-usrname").click(function (){
				loadUsername();
			});
			$("#exp-search").change(function (){
				var value = $("#exp-header").text();
				if (value == "All")
					loadAll();
				if (value == "Gender")
					loadGender();
				if (value == "Username")
					loadUsername();
			});


		});
	</script>
</div>