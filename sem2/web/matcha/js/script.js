$( document ).ready(function() {

	//INFORMATION LOAD

	$('#btnProfile').click(function () {
		$("#panProfile").load("php/profile.php");
	});

	//REGISTER FORM

	$("#reg-usrname").change(function (){
		var url = "php/db_func.php?check-usr=" + $(this).val();
		$.get(url).done(function (data) {
			alert("Data = " + data);
		});
	});

	$('#reg-form').submit(function (e) {
		e.preventDefault();
		$.post("php/auth.php", $("#reg-form").serialize(), function (result) 
		{
			$("#panProfile").load("php/profile.php");
		});
	});

	
});