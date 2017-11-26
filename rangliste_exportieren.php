<!DOCTYPE html>
<html>

    <head>
        <title>Webseite</title>
        <link rel="stylesheet" href="_css/style.css" type="text/css">
		<link rel="stylesheet" href="_css/style_ranglistenexport.css" type="text/css">
		<script src="_js/rangliste_exportieren.js" type="text/javascript"></script>

		<?php 
			include("php/config.php");
            include("includes/sessions4.php");
		?>
	</head>

    <body>

        <div id="sitediv">

            <a href="index.php"><img id="scdiemberg_logo" src="_img/sportclubdiemberg_logo_klein.png"/></a>
            <a href="index.php"><img id="deschnellsteschenbacher_logo" src="_img/deschnellsteschenbacher_logo_klein.png"/></a>

            <?php
				include 'includes/navigation.php';
            ?>
            
            <div id="content">
			
				<?php
					include 'includes/event_selection.php';
				?>
			
                <?php
                    $sql= "SELECT * from category where fs_event = ".$_SESSION['event'].";";
                    $res = mysqli_query($db,$sql);
                ?>
                
				<h1 id="site_title">Rangliste folgender Kategorien exportieren:</h1></br>
				
				<form id="rangliste_exportieren_form" action="rangliste_exportieren_fpdf.php" method="POST">
                    
					<input id="alle_auswaehlen" type="checkbox" name="alle_auswaehlen" value="select_all" onchange="selectAll(); enableSubmitButton(); enableSubmitButton2();"/> Alle auswählen</br></br>
					
					<?php
						if(mysqli_num_rows($res) >= 1)
						{
							while($row = mysqli_fetch_array($res))
							{
								echo '<label>';
								echo '<p><input id="kategorie" type="checkbox" name="kategorie[]" value="'.$row['category_id'].'" onchange="enableSubmitButton();">' ;                      
								echo " ".$row['category_name']."</p>";
								echo '<label>';
							}
						}
					?>
                    
					</br>								
					<input id="laden_button" type="submit" name="rangliste_generieren" value="Rangliste generieren" disabled/></br></br>
                </form>
				
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