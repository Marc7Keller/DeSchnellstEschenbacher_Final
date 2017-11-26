<?php
	if(isset($_POST['speichern_button_neue_klasse']))
	{
	    $sql = "INSERT INTO `class` (`class_name`, `fs_teacher`, `number_of_students`, `place`, `school`,`fs_event`) VALUES ('".$_POST['bezeichnung']."','".$_POST['klassenlehrperson']."','".$_POST['anzahl_schueler']."','".$_POST['ort_klasse']."','".$_POST['schule']."','".$_SESSION['event']."');";
        $res = mysqli_query($db,$sql);
    }
?>