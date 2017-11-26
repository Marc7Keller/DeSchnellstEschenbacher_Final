<?php
    if(isset($_POST['speichern_button_neue_kategorie']))
	{
		if($_POST['plausch']== 'on')
		{
			$pKat = 1;
		}
		else
		{
			$pKat = 0;
		}
        $sql = "INSERT INTO category (category_name,track_length,year_of_birth_start,year_of_birth_end, gender, fs_event, Plausch) VALUES ('".$_POST['bezeichnung']."','".$_POST['streckenlaenge']."','".$_POST['jahrgang_start']."','".$_POST['jahrgang_ende']."','".$_POST['Geschlecht']."','".$_SESSION['event']."','".$pKat."');";
        $res = mysqli_query($db,$sql);
    }
?>