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
				$("#reg-passwd1").addClass("alert alert-danger");
				$(":submit").attr("disabled", true);
				alert("Username already exists!");
			}
			else
			{
				$("#reg-passwd1").removeClass("alert alert-danger");
				$(":submit").removeAttr("disabled");
			}
		});
	});


	$("#ch-prof-pic-1").click(function (e){
		e.preventDefault();
		$("#popup").load("php/popup.php");
	});

	//Registration

	$("#reg-passwd1").change(function (){
		var res = $("#reg-passwd1").val().match("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
		if (res || $("#reg-passwd1").val() == "")
		{
			$("#reg-passwd1").removeClass("alert alert-danger");
			$(":submit").removeAttr("disabled");
		}
		else
		{
			$(":submit").attr("disabled", true);
			$("#reg-passwd1").addClass("alert alert-danger");			
		}
	});
	$("#reg-passwd2").change(function (){
		var res = $("#reg-passwd2").val().match($("#reg-passwd1").val());
		if (res && res != "" || $("#reg-passwd2").val() == "")
		{
			$("#reg-passwd2").removeClass("alert alert-danger");
			$(":submit").removeAttr("disabled");
		}
		else
		{
			$(":submit").attr("disabled", true);
			$("#reg-passwd2").addClass("alert alert-danger");
		}
	});

	$('#reg-form').submit(function (e) {
		e.preventDefault();
  		$.post("php/auth.php", $("#reg-form").serialize(), function (data) 
		{
			if (data == 1)
				alert("Thank you! Please login to continue.");
			else
				alert("Problem registering you!");
		});
	});
	$('#login-form').submit(function (e) {
		e.preventDefault();
		$.post("php/auth.php", $("#login-form").serialize(), function (data) 
		{
			if (data == 1)
				load_profile();
			else
				alert("Incorrect details!");
		});
	});

	
});