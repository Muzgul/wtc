$( document ).ready(function() {

	//INFORMATION LOAD
	function load_profile(){
		$("#panProfile").load("php/profile.php");
		var user;
		$.post( "php/session.php", {get_session: "yes"}).done(function (data){
			
			$.post( "php/user.php", { get_user: data}).done(function( more_data ) {
    			var arr = jQuery.parseJSON(more_data);
    			$("#usr-first-name").val(arr['firstname']);
    			$("#usr-last-name").val(arr['lastname']);
    			$("#usr-name").val(arr['usrname']);
    			$("#usr-gender").val(arr['gender']);
    			$("#usr-sex-pref").val(arr['sexpref']);
    			$("#usr-bio").val(arr['bio']);
    			$("#usr-email").val(arr['email']);
	  		});

		});
	}
	$('#btnProfile').click(function () {

		$.get("php/session.php", { session: "yes"})
			.done(function (data){
				if (data == "true")
				{
					load_profile();
				}
				else if (data == "false")
				{
					$("#panProfile").load("php/admin.php");
				}
			});
	});

	//REGISTER FORM

	$("#reg-usrname").change(function (){
		var url = "php/db_func.php?check-usr=" + $("#reg-usrname").val();
		$.get(url).done(function (data) {
			if (data == 0) //Already Exists
			{
				$("#reg-usrname").val("");
				$("#reg-usrname").focus();
				alert("Username already exists!");				
			}
		});
	});

	$('#reg-form').submit(function (e) {
		e.preventDefault();
		$.post("php/auth.php", $("#reg-form").serialize(), function (data) 
		{
			load_profile();
		});
	});
	$('#login-form').submit(function (e) {
		e.preventDefault();
		$.post("php/auth.php", $("#login-form").serialize(), function (data) 
		{
			load_profile();
		});
	});

	
});