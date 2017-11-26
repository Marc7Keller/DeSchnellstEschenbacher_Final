function enableSubmitButton()
{
	if(document.getElementsByName("bezeichnung")[0].value == "" || document.getElementsByName("streckenlaenge")[0].value == "")
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
	if(document.getElementsByName("streckenlaenge")[0].value == "")
	{
		document.getElementById("streckenlaenge").style.borderColor = "red";
	}
	else
	{
		document.getElementById("streckenlaenge").style.borderColor = "";
	}
}

function setFocus()
{
	document.getElementById("bezeichnung").focus();
}
