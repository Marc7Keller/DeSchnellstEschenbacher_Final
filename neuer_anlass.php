<!DOCTYPE html>
<html>

<head>
	<title>Administration - Neuer Anlass</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_anlass.css" type="text/css">
	<script src="_js/anlass.js" type="text/javascript"></script>
	
	<?php 
			error_reporting(0);
            include 'php/config.php';
			include 'includes/sessions.php';
            include 'includes/incl_neuer_anlass_form.php';
    ?>
	
	
</head>

<body onLoad="setFocus();">

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
			
			<h1 id="site_title">Neuer Anlass</h1>
		
			<form id="form_verwaltung" action="neuer_anlass.php" method="POST">
				</br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
			
				Bezeichnung:*			<input  id="bezeichnung" type="text" name="bezeichnung" onblur="colorEmptyField1();" onkeyup="enableSubmitButton();"/></br>
				Veranstaltungsjahr:*	<input  id="veranstaltungsjahr" type="text" name="veranstaltungsjahr" onblur="colorEmptyField2();" onkeyup="enableSubmitButton();"/></br></br>
										<input id="speichern_button" type="submit" name="speichern_button_neuer_anlass" value="Speichern" disabled/>
			</form>
		
			<?php 
				echo "<br><br><br><br>";
			
				$sql = "SELECT * FROM `event` ORDER BY event_id desc;";
				$res = mysqli_query($db,$sql);
				
				if(mysqli_num_rows($res) >= 1)
				{	 
					echo '<table border="1" id="anlass_tabelle">'; 
					echo "<tr><th>ID</th><th>Bezeichnung</th><th>Jahr</th></tr>"; 
				
					while($row = mysqli_fetch_array($res))
					{
						echo "<tr><td>"; 
						echo $row['event_id'];
						echo "</td><td>"; 
						echo $row['event_name'];
						echo "</td><td>"; 
						echo $row['year'];
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