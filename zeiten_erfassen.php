<!DOCTYPE html>
<html>

<head>
	<title>De schnellscht Eschenbacher - Zeiten erfassen</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_zeiten_erfassen.css" type="text/css">
	<script src="_js/zeiten_erfassen.js" type="text/javascript"></script>
	
</head>
<?php
	if(isset($_POST['start_number']))
	{
		echo '<body onload="setFocus('.$_POST["start_number"].');">';
	}
	else
	{
		echo '<body onload="setFocus();">';
	}
?>

    <?php 
		error_reporting(0);
        include("php/config.php");
		include("includes/sessions3.php");
    ?>
	
	<div id="sitediv">
		
		<a><img id="scdiemberg_logo" src="_img/sportclubdiemberg_logo_klein.png"/></a>
		<a><img id="deschnellsteschenbacher_logo" src="_img/deschnellsteschenbacher_logo_klein.png"/></a>
			
		<?php
			include 'includes/navigation.php';
        ?>
		
		<div id="content">
		
			<?php
				include 'includes/event_selection.php';
			?>
			
		<h1 id="site_title">Zeiten erfassen</h1>
		
            <?php
				
				if(isset($_POST["num"]))
				{
					$startnr = 0;
					
					$sql = "SELECT * FROM category WHERE fs_event = ".$_SESSION['event'].";";
					$result1 = mysqli_query($db,$sql);
					while($row1 = mysqli_fetch_array($result1))
					{
						$sql = "SELECT * FROM `participants` inner join person on fs_person = person_id WHERE fs_event = ".$_SESSION['event']." AND fs_category = ".$row1['category_id']." ORDER BY year_of_birth, RAND()";
						//$sql = "SELECT * FROM `participants` WHERE fs_event = ".$_SESSION['event']." AND fs_category = ".$row1['category_id']." ORDER BY RAND();";
						$result = mysqli_query($db,$sql);

						while($row = mysqli_fetch_array($result))
						{
							$startnr = $startnr + 1;
							$sql = "UPDATE `participants` SET `start_number` = '".$startnr."' WHERE `participants`.`participant_id` = ".$row['participant_id']." AND fs_event = ".$_SESSION['event'].";";
							$res = mysqli_query($db,$sql);
						}	
					}
				}
				
                if(isset($_POST["first_lap"])) 
				{
					$first_lap = $_POST['first_lap'];
					$participant_id = $_POST['participant_id'];
                    
					$sql = "SELECT * FROM laptimes where fs_Participant = ".$participant_id."";				
                    
					$result = mysqli_query($db,$sql);	
					$count  = mysqli_num_rows($result);
					
					if($count != 0)
					{
						while($row = mysqli_fetch_array($result))
						{
							$sql = "UPDATE `laptimes` SET first_lap = ".$first_lap." WHERE laptimes_id = ".$row['laptimes_id'].";";
						}
					}
					else
					{
						$sql = "INSERT INTO `laptimes` (`first_lap`, `fs_participant`) VALUES ('".$first_lap."', '".$participant_id."')";
					}
                    
					//$sql = "UPDATE participants SET first_lap = ". $_POST['zeit']. " WHERE startnummer = ".$_POST['startnummer']." ;";
					$res = mysqli_query($db,$sql);
				}
				
				if(isset($_POST["second_lap"])) 
				{					
					$second_lap = $_POST['second_lap'];
					$laptime_id = $_POST['laptime_id'];
					
					$sql = "UPDATE `laptimes` SET second_lap = ".$second_lap." WHERE laptimes_id = ".$laptime_id.";";
					
					$res = mysqli_query($db,$sql);
				}   
			
				$sql = "SELECT * FROM `participants` WHERE start_number = 0 AND fs_event = ".$_SESSION['event'].";";
				$result = mysqli_query($db,$sql);
				$count  = mysqli_num_rows($result);
				
				if($count > 0)
				{
			?>
		
					<form id="form_verwaltung" action="zeiten_erfassen.php" method="POST">	<input  id="num" type="hidden" name="num" value="test"/>
						<input id="speichern_button" type="submit" name="speichern_button_zeiten_erfassen" value="Startnummern verteilen"/>
					</form>
		
			<?php 
				}
				else
				{
			?>
		
					<br><br><br>
		
					<form action="zeiten_erfassen.php" method="POST">
						&nbsp <input id="speichern_button" type="submit" name="show_all_button_selection_zeiten" value="Alle Teilnehmer anzeigen"/>
					</form>
		
					<br><br>
		
					<form action="zeiten_erfassen.php" method="POST">
		
			<?php
						echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Kategorie:*  <select  id="kategorie" type="text" name="kategorie" size="1">';
		
						$res2 = mysqli_query($db,"SELECT * FROM category WHERE fs_event = ".$_SESSION['event']." ORDER BY category_id desc;");
			
						if(isset($_POST['kategorie']))
						{
							while($row = mysqli_fetch_array($res2))
							{
								if($_POST['kategorie'] == $row['category_id'])
								{
									echo '<option selected = "selected" value="'.$row['category_id'].'">'.$row['category_name'].' / '.$row['track_length'].'m'.' / '.$row['year_of_birth_start'].' - '.$row['year_of_birth_end'].' / '.$row['gender'].'</option>';
								}
								else
								{
									echo '<option value="'.$row['category_id'].'">'.$row['category_name'].' / '.$row['track_length'].'m'.' / '.$row['year_of_birth_start'].' - '.$row['year_of_birth_end'].' / '.$row['gender'].'</option>';
								}
							}
						}
						else
						{
							while($row = mysqli_fetch_array($res2))
							{
								echo '<option value="'.$row['category_id'].'">'.$row['category_name'].' / '.$row['track_length'].'m'.' / '.$row['year_of_birth_start'].' - '.$row['year_of_birth_end'].' / '.$row['gender'].'</option>';
							}
						}
            
						echo '</select></br></br>';
			?>
		
						&nbsp	<input id="speichern_button" type="submit" name="order_button_selection_zeiten" value="Filtern"/>
			
					</form>
		
			<br>
			<br>
			<br>
			
				<form action="zeiten_erfassen.php" method="POST">
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Startnummer:	<input id="start_number" class="form_cells" type="text" name="start_number" /></br></br>
    
					<input id="speichern_button" type="submit" name="speichern_button" value="Nach Startnummer suchen"/></br></br>
				</form>
			
			
			<br>
			<br>
			
			<?php
		
				if(isset($_POST['kategorie']))
				{
					$sql = "SELECT * FROM `participants` INNER JOIN `person` on (`fs_person` = `person_id`) LEFT JOIN `laptimes` on (`fs_participant` = `participant_id`) WHERE fs_event = ".$_SESSION['event']." and fs_category = ".$_POST['kategorie']." and deleted = 0 ORDER BY start_number asc;";
				}
				else if(isset($_POST['start_number']))
				{
					$sql = "SELECT * FROM `participants` INNER JOIN `person` on (`fs_person` = `person_id`) LEFT JOIN `laptimes` on (`fs_participant` = `participant_id`) WHERE fs_event = ".$_SESSION['event']." and deleted = 0 and start_number = ".$_POST['start_number']." ORDER BY start_number asc;";
				}
				else
				{
					$sql = "SELECT * FROM `participants` INNER JOIN `person` on (`fs_person` = `person_id`) LEFT JOIN `laptimes` on (`fs_participant` = `participant_id`) WHERE fs_event = ".$_SESSION['event']." and deleted = 0 ORDER BY start_number asc;";
				}
		
				// $sql = "SELECT * FROM `participants` INNER JOIN `person` on (`fs_person` = `person_id`) INNER JOIN `laptimes` on (`fs_Participant` = `participant_id`)"  ;  //das löschen
			
				$result = mysqli_query($db,$sql);
				$count  = mysqli_num_rows ($result);
			
				//echo $count;
				//  if( $count==0){
				//    echo $count;
				//$sql="SELECT * FROM `participants` INNER JOIN `person` on (`fs_person` = `person_id`) ";  //left join uf laptimes
				//$result = mysqli_query($db,$sql);
				//   }
        
			?>
        
			<table border="1" id="zeiten_erfassen_tabelle">
				<tr>
					<th>Startnummer</th>
					<th>Name</th>
					<th>Lauf 1</th>
					<th>Lauf 2</th>
					<th>Submit</th>
				</tr>
            
				<?php
							
					while($row = mysqli_fetch_array($result))
					{
						echo '<form action="zeiten_erfassen.php" method="POST">';
						echo '<tr>';
						echo '<td> '. $row['start_number']. '</td>';
						echo '<td>' .$row['firstname']. " " .$row['name'].' </td>';
            
						if($row['first_lap']=='')
						{
							if($empty_field == 0)
							{
								$empty_field = $num_row;
							}
				?> 
							<td> <input type="text" name="first_lap"> </td>
				<?php
						}
						else
						{
							echo "<td><input type='text' name='first_lap' value = ".$row['first_lap']."></td>";
						}        
            
						if($row['second_lap']=='')
						{
				?> 
							<td> <input type="text" name="second_lap"> </td>
				<?php
						}
						else
						{
							echo "<td><input type='text' name='second_lap' value = ".$row['second_lap']."></td>";
						}    

						if(isset($_POST['kategorie']))
						{
				?>
							<input hidden="text" name="kategorie" value="<?php echo $_POST['kategorie'];?>"/>
				<?php
						}
				?>
						<input hidden="text" name="participant_id" value="<?php echo $row['participant_id'];?>"/>
				<?php 
					if($count!=0)
					{
						// echo $row['laptime_id'];
				?>
						<input hidden="text" name="laptime_id" value=" <?php echo $row['laptimes_id'];?>"/>
				<?php    
					}
				?>
						<td> <input type="submit" id="speichern_button" value="Speichern"> </td>
						</tr>
					</form>
				<?php 
					}
				} 
				?>
            
			</table>
			<br><br>

		</div>
		
		<div id="footer">
			<center>
				<?php
					include 'includes/logout.php';
				?>
			</center>
		</div>
		
	</div>
</body>

</html>