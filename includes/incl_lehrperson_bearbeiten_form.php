<?php
	if(isset($_POST['speichern_button_lehrperson_bearbeiten']))
	{
		$sql = "UPDATE `person` SET `firstname` = '".$_POST['vorname']."', `name` = '".$_POST['nachname']."', `street` = '".$_POST['strasse']."', `plz` = '".$_POST['plz']."', `place` = '".$_POST['ort']."' WHERE `person_id` = ".$_POST['person_id'].";";
		$res = mysqli_query($db,$sql);
		
		if (!$res) 
		{
			printf("Error: %s\n", mysqli_error($db));
			exit();
		}
	}
?>