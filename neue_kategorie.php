<!DOCTYPE html>
<html>

<head>
	<title>Administration - Neue Kategorie</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_kategorie.css" type="text/css">
	<script src="_js/kategorie.js" type="text/javascript"></script>
	
    <?php 
            include 'php/config.php';
			include 'includes/sessions.php';
            include 'includes/incl_neue_kategorie_form.php';
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
				
			<h1 id="site_title">Neue Kategorie</h1>
		
			<form id="form_verwaltung" action="neue_kategorie.php" method="POST">
				</br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
				Bezeichnung:*		<input  id="bezeichnung" type="text" name="bezeichnung" onblur="colorEmptyField1();" onkeyup="enableSubmitButton();"/></br>
				Streckenlänge:*		<input id="streckenlaenge" type="text" name="streckenlaenge" onblur="colorEmptyField2();" onkeyup="enableSubmitButton();"/></br>
				Jahrgang-Start:		<input id="jahrgang_start" type="text" name="jahrgang_start"/></br>
				Jahrgang-Ende:		<input id="jahrgang_ende" type="text" name="jahrgang_ende"/></br></br>
				Geschlecht:			<fieldset id="radiobuttons">
										<input type="radio" id="Männlich" name="Geschlecht" value="Männlich"> Männlich</br> 
										<input type="radio" id="Weiblich" name="Geschlecht" value="Weiblich"> Weiblich</br>  
									</fieldset></br>
				Plausch:			<input type="checkbox" name="plausch"/></br></br>
									<input id="speichern_button" type="submit" name="speichern_button_neue_kategorie" value="Speichern" disabled/>
			</form>
		
			<?php 
				echo "<br><br><br><br>";
			
				$sql = "SELECT * FROM `category` WHERE fs_event = ".$_SESSION['event']." ORDER BY category_id desc;";
				$res = mysqli_query($db,$sql);
				if(mysqli_num_rows($res) >= 1)
				{	 
					echo '<table border="1" id="kategorie_tabelle">'; 
					echo "<tr><th>ID</th><th>Bezeichnung</th><th>Streckenlänge</th><th>Jahrgang-Start</th><th>Jahrgang-Ende</th><th>Geschlecht</th><th>Plausch</th></tr>"; 
					
					while($row = mysqli_fetch_array($res))
					{
						echo "<tr><td>"; 
						echo $row['category_id'];
						echo "</td><td>"; 
						echo $row['category_name'];
						echo "</td><td>"; 
						echo $row['track_length'];
						echo "</td><td>"; 
						echo $row['year_of_birth_start'];
						echo "</td><td>"; 
						echo $row['year_of_birth_end'];
						echo "</td><td>"; 
						echo $row['gender'];
						echo "</td><td>";
						echo $row['Plausch'];
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