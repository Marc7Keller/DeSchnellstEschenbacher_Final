function enableSubmitButton()
{
	if(document.getElementsByName("vorname")[0].value == "" || document.getElementsByName("nachname")[0].value == "")
	{
		document.getElementById("speichern_button").disabled = true;
	}
	else
	{
		document.getElementById("speichern_button").disabled = false;
	}
}

function enableLoadButton()
{
	if(document.getElementsByName("nachname")[0].value == "" || document.getElementsByName("vorname")[0].value == "")
	{
		document.getElementById("laden_button").disabled = true;
	}
	else
	{
		document.getElementById("laden_button").disabled = false;
	}
}

function colorEmptyField1()
{
	if(document.getElementsByName("nachname")[0].value == "")
	{
		document.getElementById("nachname").style.borderColor = "red";
	}
	else
	{
		document.getElementById("nachname").style.borderColor = "";
	}
}

function colorEmptyField2()
{
	if(document.getElementsByName("vorname")[0].value == "")
	{
		document.getElementById("vorname").style.borderColor = "red";
	}
	else
	{
		document.getElementById("vorname").style.borderColor = "";
	}
}

function setFocus()
{
	if(document.getElementsByName("nachname")[0].value == "" && document.getElementsByName("vorname")[0].value == "")
	{
		document.getElementById("nachname").focus();
	}
	else
	{
		document.getElementById("strasse_neu").focus();
	}
}
