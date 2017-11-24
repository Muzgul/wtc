$( document ).ready(function() {
	$('#btnProfile').click(function (e) {
		$("#panProfile").load("admin.php");
	});

	$('#reg-form').submit(function (e) {
		e.preventDefault();
		$.post("auth.php", $("#reg-form").serialize(), function (result) 
		{
			console.log(result);
		});
	});
});

