
	function addComment()
	{
		var comment = document.getElementById("imgComment").value;
		var img = document.getElementById("imgDisp").alt;
		if (comment.trim() != "")
		{
            var xhr = new XMLHttpRequest();
            var url = 'php/img-func.php?wit=comment&comment=' + comment + '&img=' + img;
            xhr.open('GET', url, true);

			xhr.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			      document.getElementById("imgInfo").innerHTML =
			      this.responseText;
			    }
			};

            xhr.send(null);
		}
	}

	function addLike()
	{
		var img = document.getElementById("imgDisp").alt;
		var xhr = new XMLHttpRequest();
        var url = 'php/img-func.php?wit=like&img=' + img;
        xhr.open('GET', url, true);

		xhr.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById("imgInfo").innerHTML =
		      this.responseText;
		    }
		};

        xhr.send(null);
	}

	function loadInfo()
	{
		var img = document.getElementById("imgDisp").alt;
		var xhr = new XMLHttpRequest();
        var url = 'php/img-func.php?wit=load&img=' + img;
        xhr.open('GET', url, true);

		xhr.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById("imgInfo").innerHTML =
		      this.responseText;
		    }
		};

        xhr.send(null);
	}

	function deleteImg()
	{
		var img = document.getElementById("imgDisp").alt;
		var xhr = new XMLHttpRequest();
        var url = 'php/img-func.php?wit=delete&img=' + img;
        xhr.open('GET', url, true);

		xhr.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById("imgInfo").innerHTML =
		      this.responseText;
		    }
		};

        xhr.send(null);
	}

	window.addEventListener("DOMContentLoaded", loadInfo, false);
	document.getElementById('btnComment').addEventListener("click", addComment);
	document.getElementById('btnLike').addEventListener("click", addLike);
	document.getElementById('btnDelete').addEventListener("click", deleteImg);
