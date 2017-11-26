function enableLoadButton()
{
	if(document.getElementsByName("vorname")[0].value == "" || document.getElementsByName("nachname")[0].value == "")
	{
		document.getElementById("laden_button").disabled = true;
	}
	else
	{
		document.getElementById("laden_button").disabled = false;
	}
}

function enableSubmitButton()
{
	if(document.getElementsByName("gebjahr")[0].value == "" || document.getElementsByName("ort")[0].value == "")
	{
		document.getElementById("speichern_button").disabled = true;
	}
	else
	{
		document.getElementById("speichern_button").disabled = false;
	}
}

function enableSubmitButtonEdit()
{
	if(document.getElementsByName("vorname")[0].value == "" || document.getElementsByName("nachname")[0].value == "" || document.getElementsByName("ort")[0].value == "" || document.getElementsByName("gebdatum")[0].value == "")
	{
		document.getElementById("speichern_button").disabled = true;
	}
	else
	{
		document.getElementById("speichern_button").disabled = false;
	}
}

function enableLoadButtonNameSearch()
{
	if(document.getElementsByName("vorname_teilnehmeransicht_suche")[0].value == "" && document.getElementsByName("nachname_teilnehmeransicht_suche")[0].value == "")
	{
		document.getElementById("laden_button_name").disabled = true;
	}
	else
	{
		document.getElementById("laden_button_name").disabled = false;
	}
}

function enableLoadButtonStartnumberSearch()
{
	if(document.getElementsByName("startnummer_teilnehmeransicht_suche")[0].value == "")
	{
		document.getElementById("laden_button_startnummer").disabled = true;
	}
	else
	{
		document.getElementById("laden_button_startnummer").disabled = false;
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

function colorEmptyField3()
{
	if(document.getElementsByName("gebjahr")[0].value == "")
	{
		document.getElementById("gebjahr").style.borderColor = "red";
	}
	else
	{
		document.getElementById("gebjahr").style.borderColor = "";
	}
}

function colorEmptyField4()
{
	if(document.getElementsByName("ort")[0].value == "")
	{
		document.getElementById("ort").style.borderColor = "red";
	}
	else
	{
		document.getElementById("ort").style.borderColor = "";
	}
}

function colorEmptyField5()
{
	if(document.getElementsByName("vorname")[0].value == "")
	{
		document.getElementById("vorname2").style.borderColor = "red";
	}
	else
	{
		document.getElementById("vorname2").style.borderColor = "";
	}
}

function colorEmptyField6()
{
	if(document.getElementsByName("nachname")[0].value == "")
	{
		document.getElementById("nachname2").style.borderColor = "red";
	}
	else
	{
		document.getElementById("nachname2").style.borderColor = "";
	}
}

function colorEmptyField7()
{
	if(document.getElementsByName("ort")[0].value == "")
	{
		document.getElementById("ort2").style.borderColor = "red";
	}
	else
	{
		document.getElementById("ort2").style.borderColor = "";
	}
}

function colorEmptyField8()
{
	if(document.getElementsByName("gebjahr")[0].value == "")
	{
		document.getElementById("gebjahr2").style.borderColor = "red";
	}
	else
	{
		document.getElementById("gebjahr2").style.borderColor = "";
	}
}

function colorEmptyField9()
{
	if(document.getElementsByName("nachname_teilnehmeransicht_suche")[0].value == "" && document.getElementsByName("vorname_teilnehmeransicht_suche")[0].value == "" && document.getElementsByName("startnummer_teilnehmeransicht_suche")[0].value == "")
	{
		document.getElementById("nachname_teilnehmeransicht_suche").style.borderColor = "red";
        document.getElementById("vorname_teilnehmeransicht_suche").style.borderColor = "red";
	}
	else
	{
		if(document.getElementsByName("nachname_teilnehmeransicht_suche")[0].value != "")
		{
            document.getElementById("vorname_teilnehmeransicht_suche").style.borderColor = "";
			document.getElementById("nachname_teilnehmeransicht_suche").style.borderColor = "";
			document.getElementById("startnummer_teilnehmeransicht_suche").style.borderColor = "";
		}	
		
	}
}

function colorEmptyField10()
{
	if(document.getElementsByName("vorname_teilnehmeransicht_suche")[0].value == "" && document.getElementsByName("nachname_teilnehmeransicht_suche")[0].value == "" && document.getElementsByName("startnummer_teilnehmeransicht_suche")[0].value == "")
	{
		document.getElementById("vorname_teilnehmeransicht_suche").style.borderColor = "red";
        document.getElementById("nachname_teilnehmeransicht_suche").style.borderColor = "red";
	}
	else
	{
		if(document.getElementsByName("vorname_teilnehmeransicht_suche")[0].value != "")
		{
			document.getElementById("vorname_teilnehmeransicht_suche").style.borderColor = "";
            document.getElementById("nachname_teilnehmeransicht_suche").style.borderColor = "";
			document.getElementById("startnummer_teilnehmeransicht_suche").style.borderColor = "";
		}
	}
}

function colorEmptyField11()
{
	if(document.getElementsByName("startnummer_teilnehmeransicht_suche")[0].value == "" && document.getElementsByName("vorname_teilnehmeransicht_suche")[0].value == "" && document.getElementsByName("nachname_teilnehmeransicht_suche")[0].value == "")
	{
		document.getElementById("startnummer_teilnehmeransicht_suche").style.borderColor = "red";
	}
	else
	{
		if(document.getElementsByName("startnummer_teilnehmeransicht_suche")[0].value != "")
		{
			document.getElementById("startnummer_teilnehmeransicht_suche").style.borderColor = "";
			document.getElementById("vorname_teilnehmeransicht_suche").style.borderColor = "";
			document.getElementById("nachname_teilnehmeransicht_suche").style.borderColor = "";
		}
		
	}
}

function colorEmptyField12()
{
	if(document.getElementsByName("start_number")[0].value == "")
	{
		document.getElementById("start_number").style.borderColor = "red";
	}
	else
	{
		document.getElementById("start_number").style.borderColor = "";
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
		document.getElementById("gebjahr").focus();
	}
}

function setFocus2()
{
	if(document.getElementsByName("nachname")[0].value == "" && document.getElementsByName("vorname")[0].value == "")
	{
		document.getElementById("nachname").focus();
	}
	else
	{
		document.getElementById("start_number").focus();
	}
}