function enableSubmitButton()
{
	if(document.getElementsByName("bezeichnung")[0].value == "" || document.getElementsByName("anzahl_schueler")[0].value == "" || document.getElementsByName("schule")[0].value == "" || document.getElementsByName("ort_klasse")[0].value == "")
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
	if(document.getElementsByName("anzahl_schueler")[0].value == "")
	{
		document.getElementById("anzahl_schueler").style.borderColor = "red";
	}
	else
	{
		document.getElementById("anzahl_schueler").style.borderColor = "";
	}
}

function colorEmptyField3()
{
	if(document.getElementsByName("schule")[0].value == "")
	{
		document.getElementById("schule").style.borderColor = "red";
	}
	else
	{
		document.getElementById("schule").style.borderColor = "";
	}
}

function colorEmptyField4()
{
	if(document.getElementsByName("ort_klasse")[0].value == "")
	{
		document.getElementById("ort_klasse").style.borderColor = "red";
	}
	else
	{
		document.getElementById("ort_klasse").style.borderColor = "";
	}
}

function setFocus()
{
	document.getElementById("bezeichnung").focus();
}
