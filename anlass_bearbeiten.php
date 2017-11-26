<!DOCTYPE html>
<html>

    <head>
        <title>Administration - Anlass bearbeiten</title>
        <link rel="stylesheet" href="_css/style.css" type="text/css">
        <link rel="stylesheet" href="_css/style_anlass.css" type="text/css">
		<script src="_js/anlass.js" type="text/javascript"></script>

        <?php 
			error_reporting(0);
			include 'php/config.php';
			include 'includes/sessions.php';
			include 'includes/incl_anlass_bearbeiten_form.php';
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

                <h1 id="site_title">Anlass bearbeiten</h1>

                <form id="form_verwaltung" action="" method="GET">
				
                    </br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
					
					<?php
						echo 'Anlass:* <select  id="anlass" type="text" name="anlass" size="1">';
						$res2 = mysqli_query($db,"SELECT * FROM event ORDER BY event_name asc;");

						while($row = mysqli_fetch_array($res2))
						{
							echo '<option value="'.$row['event_id'].'">'.$row['event_name'].' - '.$row['year'].'</option>';
						}

						echo '</select><br>';
					?>
					</br>
					<input id="laden_button"type="submit" name="laden_button_anlass_bearbeiten" value="Laden"/>
                </form>
				
                <?php
					if(isset($_GET['anlass']))
					{
						$sql = "SELECT * FROM `event` WHERE event_id = '".$_GET['anlass']."';";
						$res = mysqli_query($db,$sql);
						$row = mysqli_fetch_array($res);
						
						echo "<form id='form_verwaltung' action='anlass_bearbeiten.php' method='POST'>";
						echo "<input  id='event_id' type='hidden' name='event_id' value='".$_GET['anlass']."'/></br>";
						echo "Bezeichnung:*			<input  id='bezeichnung' type='text' name='bezeichnung' value='".$row['event_name']."' onblur='colorEmptyField1();' onkeyup='enableSubmitButton();'/></br>";
						echo "Veranstaltungsjahr:*	<input  id='veranstaltungsjahr' type='text' name='veranstaltungsjahr' value='".$row['year']."' onblur='colorEmptyField2();' onkeyup='enableSubmitButton();'/></br></br>";
						echo "<input id='speichern_button' type='submit' name='speichern_button_anlass_bearbeiten' value='Speichern'/>";
						
					}	
                ?>
                
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