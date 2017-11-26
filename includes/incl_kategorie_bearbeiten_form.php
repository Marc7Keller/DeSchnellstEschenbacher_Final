<?php
    if(isset($_POST['speichern_button_kategorie_bearbeiten']))
	{
        if($_POST['plausch']== 'on')
		{
			$pKat = 1;
		}
		else
		{
			$pKat = 0;
		}
	    $sql = "UPDATE `category` SET `category_name` = '".$_POST['bezeichnung']."',`track_length` = '".$_POST['streckenlaenge']."',`year_of_birth_start` = '".$_POST['jahrgang_start']."',`year_of_birth_end` = '".$_POST['jahrgang_ende']."',`gender` = '".$_POST['Geschlecht']."', `Plausch` = '".$pKat."' WHERE `category_id` = ".$_POST['category_id'].";";
		$res = mysqli_query($db,$sql);
		
		if (!$res) 
		{
			printf("Error: %s\n", mysqli_error($db));
			exit();
		}
    }
?>