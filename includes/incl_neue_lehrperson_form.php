<?php
	if(isset($_POST['speichern_button_neue_lehrperson']))
		{
			$sql = "INSERT INTO `person` (`name`, `firstname`, `plz`, `place`, `street`) VALUES ('".$_POST['name']."', '".$_POST['vorname']."', '".$_POST['plz']."', '".$_POST['ort']."', '".$_POST['strasse']."');";
			$res = mysqli_query($db,$sql);
					
			if (!$res) 
			{    
				printf("Error: %s\n", mysqli_error($db));    exit();   
			}
					
			$sql = "SELECT person_id FROM person WHERE name = '".$_POST['name']."' AND firstname =  '".$_POST['vorname']."';";
			$res = mysqli_query($db,$sql);
					
			if (!$res) 
			{    
				printf("Error: %s\n", mysqli_error($db));    exit();   
			}
					
			$row = mysqli_fetch_array($res);
			$id= $row['person_id'];
			$sql = "INSERT INTO `teacher` (`fs_person`,`fs_event`) VALUES ('".$id."','".$_SESSION['event']."');";
			$res = mysqli_query($db,$sql);
		}
?>