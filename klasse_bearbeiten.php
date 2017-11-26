<!DOCTYPE html>
<html>

<head>
	<title>Administration - Klasse bearbeiten</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_klasse.css" type="text/css">
	<script src="_js/klasse.js" type="text/javascript"></script>
	
	<?php 
		error_reporting(0);
        include 'php/config.php';
		include 'includes/sessions.php';
		include 'includes/incl_klasse_bearbeiten_form.php';
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
				
			<h1 id="site_title">Klasse bearbeiten</h1>
		
			<form id="form_verwaltung" action="" method="GET">
				</br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
				
				<?php 
					$sql = "SELECT * FROM `class` INNER JOIN `teacher` ON class.fs_teacher=teacher.teacher_id INNER JOIN `person` ON teacher.fs_person=person.person_id WHERE class.fs_event = ".$_SESSION['event']." ORDER BY class_name asc;";
					$res = mysqli_query($db,$sql);
				?>
				
				Klasse:*	
				
						<?php
							echo "<select id='klasse' type='text' name='klasse' size='1'>";
							
							while($row = mysqli_fetch_array($res))
							{
								if(isset($_GET['klasse']) and $row['class_id']==$_GET['klasse'])
								{
									echo"<option selected = 'selected' value=".$row['class_id'].">".$row['class_name']." - ".$row['firstname']." ".$row['name']."</option>";
								}
								else
								{
									echo"<option value=".$row['class_id'].">".$row['class_name']." - ".$row['firstname']." ".$row['name']."</option>";
								}
							};
						?>
								
							</select></br></br>
							
				<input id="laden_button"type="submit" name="laden_button_klasse_bearbeiten" value="Laden"/>
			</form>
			
			<?php
				if(isset($_GET['klasse']))
				{
					$sql = "SELECT class_id, class_name, fs_teacher, number_of_students, class.place, school, teacher_id, fs_person FROM `class`,`teacher` WHERE class_id = '".$_GET['klasse']."' AND teacher_id = fs_teacher;";
					$res = mysqli_query($db,$sql);
					$row = mysqli_fetch_array($res);
					
					echo "<form id='form_verwaltung' action='klasse_bearbeiten.php' method='POST'>";
					echo "Bezeichnung:*			<input  id='bezeichnung' type='text' name='bezeichnung' value='".$row['class_name']."' onblur='colorEmptyField1();' onkeyup='enableSubmitButton();'/></br>";
					echo "Anzahl Schüler:*		<input id='anzahl_schueler' type='text' name='anzahl_schueler' value='".$row['number_of_students']."' onblur='colorEmptyField2();' onkeyup='enableSubmitButton();'/></br>";
					echo "Schule:*				<input id='schule' type='text' name='schule' value='".$row['school']."' onblur='colorEmptyField3();' onkeyup='enableSubmitButton();'/></br>";
					echo "Ort:*					<input id='ort_klasse' type='text' name='ort_klasse' value='".$row['place']."' onblur='colorEmptyField4();' onkeyup='enableSubmitButton();'/></br>";
					
				    $sql = "SELECT * FROM `teacher` inner join person on (person_id = fs_person) ORDER BY name asc;";
                    
					$res = mysqli_query($db,$sql);
					
					echo"Klassenlehrperson:*	<select  id='klassenlehrperson' type='text' name='klassenlehrperson' size='1'>";
										
												while($row = mysqli_fetch_array($res))
												{
													if(isset($_GET['klasse']) and $_GET['klasse']==$row['class_id'])
													{
														echo"<option selected = 'selected' value=".$row['teacher_id'].">".$row['name']." ".$row['firstname']."</option>";
													}
													else
													{
														echo"<option value=".$row['teacher_id'].">".$row['name']." ".$row['firstname']."</option>";
													}
												};
												echo "</select></br></br>";
					
					echo "						<input type='hidden' name='class_id' value='".$_GET['klasse']."'>";
					echo "						<input id='speichern_button' type='submit' name='speichern_button_klasse_bearbeiten' value='Speichern'/>";
					echo "</form>";
				}
			?>
	
			<?php 
				echo "<br><br><br><br>";
			
				$sql = "SELECT class_name, number_of_students, class.place, school, firstname, name FROM `class` inner join teacher on teacher_id = fs_teacher inner join person on person_id = fs_person WHERE class.fs_event = '".$_SESSION['event']."' ORDER BY class_id desc;";
				$res = mysqli_query($db,$sql);
				
				if(mysqli_num_rows($res) >= 1)
				{	 
					echo '<table border="1" id="klasse_tabelle">'; 
					echo "<tr><th>Bezeichnung</th><th>Anzahl Schüler</th><th>Ort</th><th>Schule</th><th>Lehrer</th></tr>"; 
					
					while($row = mysqli_fetch_array($res))
					{
						echo "<tr><td>"; 
						echo $row['class_name'];
						echo "</td><td>"; 
						echo $row['number_of_students'];
						echo "</td><td>"; 
						echo $row['place'];
						echo "</td><td>"; 
						echo $row['school'];
						echo "</td><td>"; 
						echo $row['firstname']." ".$row['name'];
						echo "</td></tr>";
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