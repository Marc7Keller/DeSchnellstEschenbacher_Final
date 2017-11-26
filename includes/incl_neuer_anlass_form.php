<?php
    if(isset($_POST['speichern_button_neuer_anlass']))
	{
        $sql = "INSERT INTO event (event_name, year) VALUES ('".$_POST['bezeichnung']."','".$_POST['veranstaltungsjahr']."');";
        $res = mysqli_query($db,$sql);
		
		$sql = "SELECT * FROM event WHERE event_name = '".$_POST['bezeichnung']."' AND year = '".$_POST['veranstaltungsjahr']."';";
		$res = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($res);
		
		$_SESSION['event'] = $row['event_id'];
    }
?>