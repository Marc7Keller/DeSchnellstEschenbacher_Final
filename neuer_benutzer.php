<!DOCTYPE html>
<html>

<head>
	<title>Administration - Neuer Benutzer</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_benutzer.css" type="text/css">
	<script src="_js/benutzer.js" type="text/javascript"></script>
	
	<?php 
		error_reporting(0);
        include 'php/config.php';
		include 'includes/sessions2.php';
		include 'includes/incl_neuer_benutzer_form.php';
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
		
			<h1 id="site_title">Neuer Benutzer</h1>
		
		
			<form id="form_verwaltung" action="neuer_benutzer.php" method="POST">
				</br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
				Benutzername:*			<input  id="benutzername" type="text" name="benutzername" onblur="colorEmptyField1();" onkeyup="enableSubmitButton();"/></br>
				Passwort:*				<input  id="passwort" type="password" name="passwort" onblur="colorEmptyField2();" onkeyup="enableSubmitButton();"/></br>
				Passwort wiederholen:*	<input  id="passwort_wdh" type="password" name="passwort_wdh" onblur="colorEmptyField3();" onkeyup="enableSubmitButton();"/></br></br>
				
				Benutzerrolle:*			<select  id="benutzerrolle" type="text" name="benutzerrolle" size="1">
												<option value="1">Vollzugriff (Administrator)</option>
												<option value="2">Vollzugriff ohne Benutzerverwaltung</option>
												<option value="3">Zugriff auf Administration ohne Benutzerverwaltung</option>
												<option value="4">Zeiten erfassen</option>
												<option value="5">Auswerten</option>
										</select></br></br>
			
										<input id="speichern_button" type="submit" name="speichern_button_neuer_benutzer" value="Speichern" disabled/>
			</form>
		
			<?php 
				echo "<br><br><br><br>";
			
				$sql = "SELECT * FROM `user` ORDER BY user_id desc;";
				$res = mysqli_query($db,$sql);
				if(mysqli_num_rows($res) >= 1)
				{
					echo '<table border="1" id="benutzer_tabelle">'; 
					echo "<tr><th>ID</th><th>Benutzername</th><th>Benutzerrolle</th></tr>"; 
				
					while($row = mysqli_fetch_array($res))
					{
						switch($row['usertype'])
						{
							case 1:
								$nutzerrolle = "Vollzugriff (Administrator)";
								break;
							case 2:
								$nutzerrolle = "Vollzugriff ohne Benutzerverwaltung";
								break;
							case 3:
								$nutzerrolle = "Zugriff auf Administration ohne Benutzerverwaltung";
								break;
							case 4:
								$nutzerrolle = "Zeiten erfassen";
								break;
							case 5:
								$nutzerrolle = "Auswerten";
								break;
						}
						
						echo "<tr><td>"; 
						echo $row['user_id'];
						echo "</td><td>"; 
						echo $row['username'];
						echo "</td><td>"; 
						echo $nutzerrolle;
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