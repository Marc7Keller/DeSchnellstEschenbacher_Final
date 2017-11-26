<!DOCTYPE html>
<html>

<head>
	<title>Administration - Kategorie bearbeiten</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_kategorie.css" type="text/css">
	<script src="_js/kategorie.js" type="text/javascript"></script>
	
	
	<?php 
			error_reporting(0);
            include 'php/config.php';
			include 'includes/sessions.php';
			include 'includes/incl_kategorie_bearbeiten_form.php';
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
				
			<h1 id="site_title">Kategorie bearbeiten</h1>
		
			<form id="form_verwaltung" action="" method="GET">
				</br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
				
				<?php 
					$sql = "SELECT * FROM `category` WHERE fs_event = ".$_SESSION['event']." ORDER BY category_name asc;";
					$res = mysqli_query($db,$sql);
				?>
				
				<label style="font-weight: bold;">Kategorie:</label>
				
				<?php
					echo "<select  id='kategorie' type='text' name='kategorie' size='1'>";
					
					while($row = mysqli_fetch_array($res))
					{
						if(isset($_GET['kategorie']) and $_GET['kategorie'] == $row['category_id'])
						{
							echo '<option selected="selected" value="'.$row['category_id'].'">'.$row['category_name'].' / '.$row['track_length'].'m'.' / '.$row['year_of_birth_start'].' - '.$row['year_of_birth_end'].' / '.$row['gender'].'</option>';
						}
						else
						{
							echo '<option value="'.$row['category_id'].'">'.$row['category_name'].' / '.$row['track_length'].'m'.' / '.$row['year_of_birth_start'].' - '.$row['year_of_birth_end'].' / '.$row['gender'].'</option>';
						}
					};
				?>
								
				</select></br></br>
				<input id="laden_button" type="submit" name="laden_button_kategorie_bearbeiten" value="Laden"/>
			</form>
			
			<?php
				if(isset($_GET['kategorie']))
				{
					$sql = "SELECT * FROM `category` WHERE category_id = '".$_GET['kategorie']."';";
					$res = mysqli_query($db,$sql);
					$row = mysqli_fetch_array($res);
						
					echo "<form id='form_verwaltung' action='kategorie_bearbeiten.php' method='POST'>";
					echo "					<input  id='category_id' type='hidden' name='category_id' value='".$row['category_id']."'/></br>";
					echo "Bezeichnung:*		<input  id='bezeichnung' type='text' name='bezeichnung' value='".$row['category_name']."' onblur='colorEmptyField1();' onkeyup='enableSubmitButton();'/></br>";
					echo "Streckenlänge:*	<input id='streckenlaenge' type='text' name='streckenlaenge' value='".$row['track_length']."' onblur='colorEmptyField2();' onkeyup='enableSubmitButton();'/></br>";
					echo "Jahrgang-Start:	<input id='jahrgang_start' type='text' name='jahrgang_start' value='".$row['year_of_birth_start']."'/></br>";
					echo "Jahrgang-Ende:	<input id='jahrgang_ende' type='text' name='jahrgang_ende' value='".$row['year_of_birth_end']."'/></br></br>";
					
					if($row['gender']=="Männlich")
					{
						echo "Geschlecht:	<fieldset id='radiobuttons'>
												<input type='radio' id='Männlich' name='Geschlecht' value='Männlich' checked/>Männlich</br> 
												<input type='radio' id='Weiblich' name='Geschlecht' value='Weiblich'/> Weiblich</br>  
											</fieldset></br>";
					}
					else
					{
                        if($row['gender']=="Weiblich")
                        {
                            echo "Geschlecht:	<fieldset id='radiobuttons'>
												<input type='radio' id='Männlich' name='Geschlecht' value='Männlich'/> Männlich</br> 
												<input type='radio' id='Weiblich' name='Geschlecht' value='Weiblich' checked/>Weiblich</br>  
											</fieldset></br>";
                        }
                        else
                        {
                            echo "Geschlecht:	<fieldset id='radiobuttons'>
												<input type='radio' id='Männlich' name='Geschlecht' value='Männlich'/> Männlich</br> 
												<input type='radio' id='Weiblich' name='Geschlecht' value='Weiblich'/>Weiblich</br>  
											</fieldset></br>";
                        }
						
					}
                    if($row['Plausch']==1)
                    {
                        echo "Plausch:			<input type='checkbox' name='plausch' checked/></br></br>";   
                    }
                    else
                    {
                        echo "Plausch:			<input type='checkbox' name='plausch'/></br></br>";
                    }
					echo "<input id='speichern_button' type='submit' name='speichern_button_kategorie_bearbeiten' value='Speichern'/>";
					echo "</form>";
				}
			?>
		
			<?php 
			
				echo "<br><br><br><br>";
			
				$sql = "SELECT * FROM `category` WHERE fs_event = ".$_SESSION['event']." ORDER BY category_id desc;";
				$res = mysqli_query($db,$sql);
				if(mysqli_num_rows($res) >= 1)
				{	 
					echo '<table border="1" id="kategorie_tabelle">'; 
					echo "<tr><th>ID</th><th>Bezeichnung</th><th>Streckenlänge</th><th>Jahrgang-Start</th><th>Jahrgang-Ende</th><th>Geschlecht</th></tr>"; 
				
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