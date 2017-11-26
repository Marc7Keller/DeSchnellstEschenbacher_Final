<?php
	if(isset($_POST['speichern_button_klasse_bearbeiten']))
	{
		$sql = "UPDATE `class` SET `class_name` = '".$_POST['bezeichnung']."', `fs_teacher` = '".$_POST['klassenlehrperson']."', `number_of_students` = '".$_POST['anzahl_schueler']."', `class`.`place` = '".$_POST['ort_klasse']."', `school` = '".$_POST['schule']."' WHERE `class_id` = '".$_POST['class_id']."';";
		$res = mysqli_query($db,$sql);
	}
?>