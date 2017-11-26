<?php

	session_start();
	
	switch($_SESSION['usertype'])
	{
		case '':
			header("location: login.php");
			break;
		case 1:
			header("location: neuer_teilnehmer.php"); 
			break;
		case 2:
			header("location: neuer_teilnehmer.php");
			break;
		case 3:
			header("location: neuer_teilnehmer.php");
			break;
		case 4:
			header("location: zeiten_erfassen.php"); 
			break;
		case 5:
			header("location: startliste_exportieren.php");
			break;
	}

?>