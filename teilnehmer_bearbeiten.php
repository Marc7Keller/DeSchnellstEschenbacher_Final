<!DOCTYPE html>
<html>

<head>
	<title>Administration - Teilnehmer bearbeiten</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_teilnehmer.css" type="text/css">
	<script src="_js/teilnehmer.js" type="text/javascript"></script>
	
	<?php
		error_reporting(0);
        include 'php/config.php';
		include 'includes/sessions.php';
	?>
	
</head>

<body>

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
			
		<h1 id="site_title">Teilnehmer bearbeiten</h1>
		
		</br>
		
		<form id="form_verwaltung" action="" method="GET">
			
			<p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
			
			<?php 
				$sql = "SELECT * FROM `participants` inner join `person` on person.person_id = participants.fs_person inner join `category` on category.category_id = participants.fs_category INNER JOIN `class` on class.class_id = participants.fs_class WHERE participants.fs_event = ".$_SESSION['event']." and deleted != 1 ORDER BY name asc;";
				$res = mysqli_query($db,$sql);
			?>
			<label style="font-weight: bold;">Person:*</label>
			<?php
								echo "<select  id='person' type='text' name='person' size='1'>";
									while($row = mysqli_fetch_array($res)){
										if(isset($_GET['person']) and $_GET['person'] == $row['person_id'])
										{
											echo"<option selected = 'selected' value=".$row['person_id'].">".$row['name']." ".$row['firstname']."</option>";
										}
										else
										{
											echo"<option value=".$row['person_id'].">".$row['name']." ".$row['firstname']."</option>";
										}
									};
			?>
			</select>
			</br></br>
			<input id="laden_button" type="submit" name="laden_button_teilnehmer_bearbeiten" value="Laden"/>
		</form>
		
		<?php
			if(isset($_GET['person']))
			{
				//$sql = "SELECT * FROM `person`,`participants`,`class`,`category` WHERE person_id = '".$_GET['person']."' AND person_id = fs_person AND fs_event = ".$_SESSION['event']." AND fs_class = class_id AND fs_category = category_id;";
				$sql = "SELECT person_id, name, firstname, year_of_birth, plz, person.place as persplace, street, fs_category, fs_class, late_registration FROM `participants` inner join `person` on person.person_id = participants.fs_person inner join `category` on category.category_id = participants.fs_category INNER JOIN `class` on class.class_id = participants.fs_class WHERE person_id = '".$_GET['person']."' AND participants.fs_event = ".$_SESSION['event'].";";
				$res = mysqli_query($db,$sql);
				$row = mysqli_fetch_array($res);
				
				$kategorie = $row['fs_category'];
				$klasse = $row['fs_class'];
				
				if($row['late_registration']=='1')
				{
					$nachanmeldung = True;
				}
				else
				{
					$nachanmeldung = False;
				}
				
				echo "<form id='form_verwaltung' action='teilnehmer_bearbeiten.php' method='POST'>";
				echo "</select></br>";
				echo "Vorname:		<input id='vorname2' class='form_cells' type='text' name='vorname' value='".$row['firstname']."' onblur='colorEmptyField5();' onkeyup='enableSubmitButtonEdit();'/></br>";
				echo "Nachname:		<input id='nachname2' class='form_cells' type='text' name='nachname' value='".$row['name']."' onblur='colorEmptyField6();' onkeyup='enableSubmitButtonEdit();'/></br>";
				echo "Strasse:		<input id='strasse2' class='form_cells' type='text' name='strasse' value='".$row['street']."'/></br>";
				echo "PLZ:			<input id='plz2' class='form_cells' type='text' name='plz' value='".$row['plz']."'/></br>";
				echo "Ort:			<input id='ort2' class='form_cells' type='text' name='ort' value='".$row['persplace']."' onblur='colorEmptyField7();' onkeyup='enableSubmitButtonEdit();'/></br>";
				echo "Geburtsjahr:	<input id='gebjahr2' class='form_cells' type='text' name='gebjahr' value='".$row['year_of_birth']."' onblur='colorEmptyField8();' onkeyup='enableSubmitButtonEdit();'/></br></br>";
				
				echo "Klasse:* <select  id='klasse2' type='text' name='klasse' size='1'>";
				
				$sql = "SELECT * FROM `class`,`teacher`,`person` WHERE fs_teacher = teacher_id AND fs_person = person_id AND class.fs_event = ".$_SESSION['event']." ORDER BY class_name asc;";
				$res2 = mysqli_query($db,$sql);
				
				while($row = mysqli_fetch_array($res2))
				{
					if($row['class_id']==$klasse)
					{
						echo '<option selected="selected" value="'.$row['class_id'].'">'.$row['class_name'].' - '.$row['firstname'].' '.$row['name'].'</option>';
					}
					else
					{
						echo '<option value="'.$row['class_id'].'">'.$row['class_name'].' - '.$row['firstname'].' '.$row['name'].'</option>';
					}
					
				}
				
				echo '</select><br>';
				
				echo 'Kategorie:*  <select  id="kategorie2" type="text" name="kategorie" size="1">';
				
				$sql = "SELECT * FROM `category` WHERE fs_event = ".$_SESSION['event']." ORDER BY category_name asc;";
				$res2 = mysqli_query($db,$sql);
				
				while($row = mysqli_fetch_array($res2))
				{
					if($row['category_id']==$kategorie)
					{
						echo '<option selected="selected" value="'.$row['category_id'].'">'.$row['category_name'].' / '.$row['track_length'].'m'.' / '.$row['year_of_birth_start'].' - '.$row['year_of_birth_end'].' / '.$row['gender'].'</option>';
					}
					else
					{
						echo '<option value="'.$row['category_id'].'">'.$row['category_name'].' / '.$row['track_length'].'m'.' / '.$row['year_of_birth_start'].' - '.$row['year_of_birth_end'].' / '.$row['gender'].'</option>';
					}
				}
            
				echo '</select></br>';
		
				echo "<input type='hidden' name='person_id' value='".$_GET['person']."'>";
				
				if($nachanmeldung==True)
				{
					echo "Nachanmeldung:	<input type='checkbox' id='checkbox_nachanmeldung2' name='checkbox_nachanmeldung' value='true' checked></br></br>";
				}
				else
				{
					echo "Nachanmeldung:	<input type='checkbox' id='checkbox_nachanmeldung2' name='checkbox_nachanmeldung' value='true'></br></br>";
				}
				
				echo "<input id='speichern_button' type='submit' name='speichern_button_teilnehmer_bearbeiten' value='Speichern'/>";
				echo "</form>";
			}
		?>	
		<?php
			if(isset($_POST['speichern_button_teilnehmer_bearbeiten']))
			{
				$sql = "UPDATE `person` SET `firstname` = '".$_POST['vorname']."', `name` = '".$_POST['nachname']."', `street` = '".$_POST['strasse']."', `plz` = '".$_POST['plz']."', `place` = '".$_POST['ort']."', `year_of_birth` = '".$_POST['gebjahr']."' WHERE `person_id` = '".$_POST['person_id']."';";
				$res = mysqli_query($db,$sql);
				
				if(isset($_POST['checkbox_nachanmeldung']))
				{
					$sql = "UPDATE `participants` SET `fs_class` = '".$_POST['klasse']."', `fs_category` = '".$_POST['kategorie']."',`late_registration` = 1 WHERE `fs_person` = '".$_POST['person_id']."';";
					$res = mysqli_query($db,$sql);
				}
				else
				{
					$sql = "UPDATE `participants` SET `fs_class` = '".$_POST['klasse']."', `fs_category` = '".$_POST['kategorie']."',`late_registration` = 0 WHERE `fs_person` = '".$_POST['person_id']."';";
					$res = mysqli_query($db,$sql);
				}
			}
		?>
		
		<?php
			if(isset($_POST['participant_id']))
			{
				$sql = "UPDATE `participants` SET `deleted` = 1 WHERE `participant_id` = '".$_POST['participant_id']."';";
				$res = mysqli_query($db,$sql);
			}
		?>
		
		<?php	
				echo "<br><br><br><br>";
	
				$sql = "SELECT participant_id, name, firstname, year_of_birth, plz, person.place, street, class.class_name as classbez, category.category_name as catbez, late_registration, start_number FROM `participants` inner join `person` on person.person_id = participants.fs_person inner join `category` on category.category_id = participants.fs_category INNER JOIN `class` on class.class_id = participants.fs_class WHERE participants.fs_event = ".$_SESSION['event']." and participants.deleted != 1 ORDER BY participant_id desc;";
				$res = mysqli_query($db,$sql);
	 
				if(mysqli_num_rows($res) >= 1)
				{	 
					echo '<table border="1" id="teilnehmer_tabelle">'; 
					echo "<tr><th>Name</th><th>Vorname</th><th>Geburtsjahr</th><th>PLZ</th><th>Ort</th><th>Strasse</th><th>Klasse</th><th>Kategorie</th><th>Startnummer</th><th>Nachanmeldung</th><th>Löschen</th></tr>"; 
					
					while($row = mysqli_fetch_array($res))
					{
						echo '<form action="teilnehmer_bearbeiten.php" method="POST">';
						echo "<tr><td>"; 
						echo $row['name'];
						echo "</td><td>"; 
						echo $row['firstname'];
						echo "</td><td>";   
						echo $row['year_of_birth'];
						echo "</td><td>";    
						echo $row['plz'];
						echo "</td><td>";
						echo $row['place'];
						echo "</td><td>";
						echo $row['street'];
						echo "</td><td>";
						echo $row['classbez'];
						echo "</td><td>";
						echo $row['catbez'];
						echo "</td><td>";
						echo $row['start_number'];
						echo "</td><td>";
						echo $row['late_registration'];
						echo "</td><td>";
						echo "<input id='loeschen_button' type='submit' value='Löschen'/>";
						echo "</td></tr>";
						?>
							<input hidden="text" name="participant_id" value="<?php echo $row['participant_id'];?>"/>
						<?php
						echo "</form>";
					}
					
					echo "</table>";
				}
				else 
				{
					echo "There was no matching record for the name " . $searchTerm;
				}
				
			?>
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