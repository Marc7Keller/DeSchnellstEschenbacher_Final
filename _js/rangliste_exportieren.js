function selectAll()
{
	if(document.getElementsByName("alle_auswaehlen")[0].checked == true)
	{
		for(var x = 0; x <= document.getElementsByName("kategorie[]").length; x++)
		{
			document.getElementsByName("kategorie[]")[x].checked = true;
		}	
	}
	else
	{
		for(var x = 0; x <= document.getElementsByName("kategorie[]").length; x++)
		{
			document.getElementsByName("kategorie[]")[x].checked = false;
		}	
	}
}

function enableSubmitButton()
{
	var nothingSelected = true;
	
	for(var x = 0; x <= document.getElementsByName("kategorie[]").length; x++)
	{
		if(document.getElementsByName("kategorie[]")[x].checked == true)
		{
			document.getElementById("laden_button").disabled = false;
			nothingSelected = false;
		}
	}
	
	if(document.getElementsByName("alle_auswaehlen")[0].checked == true)
	{
		document.getElementById("laden_button").disabled = false;
		nothingSelected = false;
	}
	
	if(nothingSelected == true)
	{
		document.getElementById("laden_button").disabled = true;
	}
}

function enableSubmitButton2()
{
	var nothingSelected = true;
	
	if(document.getElementsByName("alle_auswaehlen")[0].checked == true)
	{
		document.getElementById("laden_button").disabled = false;
		nothingSelected = false;
	}
	else
	{
		for(var x = 0; x <= document.getElementsByName("kategorie[]").length; x++)
		{
			if(document.getElementsByName("kategorie[]")[x].checked == true)
			{
				document.getElementById("laden_button").disabled = false;
				nothingSelected = false;
			}
		}
		
		if(nothingSelected2 = true)
		{
			document.getElementById("laden_button").disabled = true;
		}
	}
}