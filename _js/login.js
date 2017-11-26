function enableSubmitButton()
{
	if(document.getElementsByName("username")[0].value == "" || document.getElementsByName("password")[0].value == "")
	{
		document.getElementById("anmelden_button").disabled = true;
	}
	else
	{
		document.getElementById("anmelden_button").disabled = false;
	}
}

function colorEmptyField1()
{
	if(document.getElementsByName("username")[0].value == "")
	{
		document.getElementById("login_form_username").style.borderColor = "red";
	}
	else
	{
		document.getElementById("login_form_username").style.borderColor = "";
	}
}

function colorEmptyField2()
{
	if(document.getElementsByName("password")[0].value == "")
	{
		document.getElementById("login_form_password").style.borderColor = "red";
	}
	else
	{
		document.getElementById("login_form_password").style.borderColor = "";
	}
}

function setFocus()
{
	document.getElementById("login_form_username").focus();
}