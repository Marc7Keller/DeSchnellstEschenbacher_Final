<?php
	if(isset($_POST['speichern_button_neuer_benutzer']))
	{
		if($_POST["passwort"] == $_POST["passwort_wdh"])
		{
			$sql = "INSERT INTO `user` (`username`, `password`, `usertype`) VALUES ('".$_POST['benutzername']."', '".$_POST['passwort']."', '".$_POST['benutzerrolle']."');";
			$res = mysqli_query($db,$sql);
		}
		else
		{
			echo "<script type='text/javascript'>alert('Die Passwörter stimmen nicht überein');</script>";
		}
	}
?>