<?php
	if(isset($_POST["speichern_button_benutzer_bearbeiten"]))
	{
		if($_POST["passwort"] == $_POST["passwort_wdh"])
		{	
			$sql = "UPDATE `user` SET `username` = '".$_POST["benutzername"]."', `password` = '".$_POST["passwort"]."', `usertype` = '".$_POST["benutzerrolle"]."' WHERE `user`.`user_id` = ".$_POST['user_id'].";";
			$res = mysqli_query($db,$sql);
		}
		else
		{
			echo "<script type='text/javascript'>alert('Die Passwörter stimmen nicht überein');</script>";
		}
	}
?>
	
	