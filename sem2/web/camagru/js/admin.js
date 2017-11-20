	
	function passCheck(elem)
	{
		var res = elem.value.match("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
		if (res)
			return true;
		else
			return false;
	}

	function passCompare(elem)
	{
		if (passCheck(elem))
		{
			var otherelem = document.getElementById("usr-passwd");
			if (elem.value == otherelem.value)
				return true;
			else
				return false;
		}
	}

	function validEmail(elem)
	{
		var res = elem.value.match("/(.+)@(.+){2,}\.(.+){2,}/");
		if (res)
			return true;
		else
			return false;
	}

	function validReg(elem)
	{
		var pass = document.getElementById("usr-passwd");
		var pass2 = document.getElementById("usr-passwd2");
		var sbmt = document.getElementById("usr-register");

		if (passCheck(pass))
		{
			pass.classList.remove('invalidInput');
			pass = true;
		}			
		else
			pass.classList.add('invalidInput');
		if (passCompare(pass2))
		{
			pass2.classList.remove('invalidInput');
			pass2 = true;
		}
		else
			pass2.classList.add('invalidInput');
		if (pass == pass2 == true)
		{
			return true;
		}
		else
			elem.preventDefault();
		return false;
	}

	document.getElementById("register-form").addEventListener("submit", validReg);