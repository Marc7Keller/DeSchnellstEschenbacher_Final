function enableSubmitButton()
{
	if(document.getElementsByName("benutzername")[0].value == "" || document.getElementsByName("passwort")[0].value == "" || document.getElementsByName("passwort_wdh")[0].value == "")
	{
		document.getElementById("speichern_button").disabled = true;
	}
	else
	{
		document.getElementById("speichern_button").disabled = false;
	}
}

function colorEmptyField1()
{
	if(document.getElementsByName("benutzername")[0].value == "")
	{
		document.getElementById("benutzername").style.borderColor = "red";
	}
	else
	{
		document.getElementById("benutzername").style.borderColor = "";
	}
}

function colorEmptyField2()
{
	if(document.getElementsByName("passwort")[0].value == "")
	{
		document.getElementById("passwort").style.borderColor = "red";
	}
	else
	{
		document.getElementById("passwort").style.borderColor = "";
	}
}

function colorEmptyField3()
{
	if(document.getElementsByName("passwort_wdh")[0].value == "")
	{
		document.getElementById("passwort_wdh").style.borderColor = "red";
	}
	else
	{
		document.getElementById("passwort_wdh").style.borderColor = "";
	}
}

function setFocus()
{
	document.getElementById("benutzername").focus();
}
