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
    			$("#usr-name").text(arr['usrname']);
    			$("#usr-gender").val(arr['gender']);
    			$("#usr-sex-pref").val(arr['sexpref']);
    			$("#usr-bio").val(arr['bio']);
    			$("#usr-email").val(arr['email']);
    			$("#prof-pic").attr("src", arr['profpic']);
	  		});
	  		$.post("php/user.php", { get_user_imgs: data}).done(function (more_data){
	  			var arr = jQuery.parseJSON(more_data);
	  			for (var i = 0; i < arr.length; i++)
	  			{
	  				if (i == 0)
	  					$("#prof-pic-1").attr("src", arr[i]['url']);
	  				if (i == 1)
	  					$("#prof-pic-2").attr("src", arr[i]['url']);
	  				if (i == 2)
	  					$("#prof-pic-3").attr("src", arr[i]['url']);
	  				if (i == 3)
	  					$("#prof-pic-4").attr("src", arr[i]['url']);
	  				if (i == 4)
	  					$("#prof-pic-5").attr("src", arr[i]['url']);
	  			}
	  		});

		});
	}

	$("#btnExplore").click(function (){
		$("#panExplore").load("php/explore.php");
	});

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

	$('#logout-link').click(function (){		
		$.get("php/session.php?end_session=yes").done(function (){
			$("#btnExplore").click();
		});
	});
});



