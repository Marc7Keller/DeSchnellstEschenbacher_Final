<!DOCTYPE html>
<html>

    <head>
        <title>Administration - Benutzer bearbeiten</title>
        <link rel="stylesheet" href="_css/style.css" type="text/css">
        <link rel="stylesheet" href="_css/style_benutzer.css" type="text/css">
		<script src="_js/benutzer.js" type="text/javascript"></script>
        
        <?php
			error_reporting(0);
			include 'php/config.php';
			include 'includes/sessions2.php';
			include 'includes/incl_benutzer_bearbeiten_form.php'
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
                
				<h1 id="site_title">Benutzer bearbeiten</h1>
				
				<form id="form_verwaltung" action="" method="GET">
				</br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
					<label style="font-weight: bold;">Benutzer:</label>
					<select  id="benutzer" type="text" name="benutzer" size="1">
					<?php
						$sql = "SELECT * FROM `user` ORDER BY username asc;";
						$res = mysqli_query($db,$sql);
					
						while($row = mysqli_fetch_array($res))
						{
							$user_id = $_GET['benutzer'];
						
							if($_GET['benutzer']== $row['user_id'])
							{
								echo "<option selected = true value = '".$row['user_id']."'>".$row['username']."</option>";
							}
							else
							{
								echo "<option value = '".$row['user_id']."'>".$row['username']."</option>";
							}
						}
					?>
					</select></br></br>
				
					<input id="laden_button" type="submit" name="laden_button_benutzer_bearbeiten" value="Laden"/>
				</form>
				
				
				<?php
					if(isset($_GET['benutzer']))
					{
						$sql = "SELECT * FROM `user` WHERE user_id = '".$_GET['benutzer']."';";
						$res = mysqli_query($db,$sql);
						$row = mysqli_fetch_array($res);
						
						echo "<form id='form_verwaltung' action='benutzer_bearbeiten.php' method='POST'>";
							
						echo "							<input  id='user_id' type='hidden' name='user_id' value='".$_GET['benutzer']."'/></br>";
						echo "	Benutzername:*			<input id='benutzername' type='text' name='benutzername' value='".$row['username']."' onblur='colorEmptyField1();' onkeyup='enableSubmitButton();'/></br>";
						echo "	Passwort:*				<input  id='passwort' type='password' name='passwort' value='".$row['password']."' onblur='colorEmptyField2();' onkeyup='enableSubmitButton();'/></br>";
						echo "	Passwort wiederholen:*	<input  id='passwort_wdh' type='password' name='passwort_wdh' value='".$row['password']."' onblur='colorEmptyField3();' onkeyup='enableSubmitButton();'/></br></br>";
						
						echo "	Benutzerrolle:*			<select  id='benutzerrolle' type='text' name='benutzerrolle' size='1'>";
						
						if($row['usertype']==1)
						{
							echo "							<option selected value='1'>Vollzugriff (Administrator)</option>";
						}
						else
						{
							echo "							<option value='1'>Vollzugriff (Administrator)</option>";
						}
						if($row['usertype']==2)
						{
							echo "							<option selected value='2'>Vollzugriff ohne Benutzerverwaltung</option>";
						}
						else
						{
							echo "							<option value='2'>Vollzugriff ohne Benutzerverwaltung</option>";
						}
						if($row['usertype']==3)
						{
							echo "							<option selected value='3'>Zugriff auf Administration ohne Benutzerverwaltung</option>";
						}
						else
						{
							echo "							<option value='3'>Zugriff auf Administration ohne Benutzerverwaltung</option>";
						}
						if($row['usertype']==4)
						{
							echo "							<option selected value='4'>Zeiten erfassen</option>";
						}
						else
						{
							echo "							<option value='4'>Zeiten erfassen</option>";
						}
						if($row['usertype']==5)
						{
							echo "							<option selected value='5'>Auswerten</option>";
						}
						else
						{
							echo "							<option value='5'>Auswerten</option>";
						}
						
						echo "							</select></br></br>";
						
						echo "							<input id='speichern_button' type='submit' name='speichern_button_benutzer_bearbeiten' value='Speichern'/>";
						
						echo "</form>";
					}
				?>
				
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