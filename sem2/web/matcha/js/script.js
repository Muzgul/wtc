$( document ).ready(function() {

	//INFORMATION LOAD

	$('#btnProfile').click(function () {

		$("#panProfile").load("php/profile.php");
		$.post( "php/db_func.php", { get_user: "F"})
  			.done(function( data ) {
    			alert( "Data Loaded: " + data );
    			var arr = jQuery.parseJSON(data);
    			$("#usr-first-name").val(arr['firstname']);
    			$("#usr-last-name").val(arr['lastname']);
    			$("#usr-name").val(arr['usrname']);
    			$("#usr-gender").val(arr['gender']);
    			$("#usr-sex-pref").val(arr['sexpref']);
    			$("#usr-bio").val(arr['bio']);
    			$("#usr-email").val(arr['email']);
  		});
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