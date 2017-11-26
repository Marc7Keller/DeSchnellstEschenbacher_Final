function enableSubmitButton()
{
	if(document.getElementsByName("bezeichnung")[0].value == "" || document.getElementsByName("veranstaltungsjahr")[0].value == "")
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
	if(document.getElementsByName("bezeichnung")[0].value == "")
	{
		document.getElementById("bezeichnung").style.borderColor = "red";
	}
	else
	{
		document.getElementById("bezeichnung").style.borderColor = "";
	}
}

function colorEmptyField2()
{
	if(document.getElementsByName("veranstaltungsjahr")[0].value == "")
	{
		document.getElementById("veranstaltungsjahr").style.borderColor = "red";
	}
	else
	{
		document.getElementById("veranstaltungsjahr").style.borderColor = "";
	}
}

function setFocus()
{
	document.getElementById("bezeichnung").focus();
}
