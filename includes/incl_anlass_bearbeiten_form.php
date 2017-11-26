<?php
if(isset($_POST['speichern_button_anlass_bearbeiten']))
{

    $sql = "UPDATE event SET event_name ='".$_POST['bezeichnung']."', year =".$_POST['veranstaltungsjahr']." WHERE event_id = ".$_POST['event_id'].";";
    $res = mysqli_query($db,$sql);
    
    if (!$res) 
	{
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
}
?>