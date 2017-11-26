<!DOCTYPE html>
<html>

<head>
	<title>Administration - Neue Klasse</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_klasse.css" type="text/css">
	<script src="_js/klasse.js" type="text/javascript"></script>
	
	<?php 
		error_reporting(0);
		include 'php/config.php';
		include 'includes/sessions.php';
		include 'includes/incl_neue_klasse_form.php';
    ?>	
</head>

<body onload="setFocus();">

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
				
			<h1 id="site_title">Neue Klasse</h1>
		
			<form id="form_verwaltung" action="neue_klasse.php" method="POST">
				
				</br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
			
				Bezeichnung:*		<input id="bezeichnung" type="text" name="bezeichnung" onblur="colorEmptyField1();" onkeyup="enableSubmitButton();"/></br>
				Anzahl Schüler:*	<input id="anzahl_schueler" type="text" name="anzahl_schueler" onblur="colorEmptyField2();" onkeyup="enableSubmitButton();"/></br>
				Schule:*			<input id="schule" type="text" name="schule" onblur="colorEmptyField3();" onkeyup="enableSubmitButton();"/></br>
				Ort:*				<input id="ort_klasse" type="text" name="ort_klasse" onblur="colorEmptyField4();" onkeyup="enableSubmitButton();"/></br>
			
				<?php 
					$sql = "SELECT * FROM `person` inner join `teacher` on person.person_id = teacher.fs_person left join `class` on teacher.teacher_id = class.fs_teacher where teacher.fs_event = ".$_SESSION['event']." and class.fs_teacher is null ORDER BY person.name asc";
					$res = mysqli_query($db,$sql);
				?>
				
				Klassenlehrperson:*	<?php
										echo"<select  id='klassenlehrperson' type='text' name='klassenlehrperson' size='1'>";
												
										while($row = mysqli_fetch_array($res))
										{
											echo"<option value=".$row['teacher_id'].">".$row['name']." ".$row['firstname']."</option>";
										};
												
										echo "</select></br></br>";
									?>
				
									<input id="speichern_button" type="submit" name="speichern_button_neue_klasse" value="Speichern" disabled/>
			</form>
		
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