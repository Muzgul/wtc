<?php session_start();
	
?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-sm-12">
				<div class="container-fluid card">
					<div class="row">
						<h3>Age gap</h3>
						<form>
							<label for="exp-sort-age-min">Min Age:</label>
							<input type="number" min="18" max="99" value="18" name="exp-sort-age-min" id="exp-sort-age-min" >
							<label for="exp-sort-age-max">Max Age:</label>
							<input type="number" min="18" max="99" value="99" name="exp-sort-age-max" id="exp-sort-age-max" >
							<button id="thisrandombutton">Search</button>
						</form>
					</div>
					<div class="row">
						<h3>Fame Rating</h3>
						<form>
							<label for="exp-sort-fame-asc">High first: </label>
							<input type="radio" name="exp-sort-fame" id="exp-sort-fame-asc" >
							<label for="exp-sort-fame-desc">Low first: </label>
							<input type="radio" name="exp-sort-fame" id="exp-sort-fame-desc" >
						</form>
					</div>
					<div class="row">
						<h3>Area Search</h3>
						<form>
							<label for="exp-sort-area">Area: </label>
							<input type="text" name="exp-sort-area" id="exp-sort-area" >
						</form>
					</div>
					<div class="row">
						<h3>Interest Search</h3>
						<form>
							<label for="exp-sort-interests">Interests: </label>
							<input type="text" name="exp-sort-interests" id="exp-sort-interests" aria-describedby="exp-sort-interests-small">
							<br/>
							<small id="exp-sort-interests-small">Please enter the interests as #hashtags seperated by a space.</small>
						</form>
					</div>
					<div class="row">
						<h3>Show: </h3>
						<button id="exp-opt-all">All.</button>
						<button id="exp-opt-recomend">For you.</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<h1 id="exp-header">For you</h1>
		</div>
		<div class="row">
			<div class="container-fluid">
				<table id="exp-content">
					
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$( document ).ready(function() {

			$("#exp-opt-recomend").click(function (){
				$("#exp-header").text("For you.");
				$.post("php/user.php", {get_users: "recomend"}).done(function (data){
					$("#exp-content").html(data);
				});
			});
			$("#exp-opt-all").click(function (){
				$("#exp-header").text("All.");
				$.post("php/user.php", {get_users: "all"}).done(function (data){
					$("#exp-content").html(data);
				});
			});
			$("#exp-sort-interests").change(function (){
				var val = $("#exp-sort-interests").val();
				if (val != "")
				{
					$("#exp-header").text("Interests.");				
					$.post("php/user.php", {get_users: "interests", interets: val}).done(function (data){
						$("#exp-content").html(data);
					});
				}
			});

			$("#thisrandombutton").click(function(e){
				e.preventDefault();
				$("#exp-header").text("Age.");
				var min = $("#exp-sort-age-min").val();
				var max = $("#exp-sort-age-max").val();
				$.post("php/user.php", {get_users: "age", min_age: min, max_age: max}).done(function (data){
					$("#exp-content").html(data);
				});
			});

		});
	</script>
</div>