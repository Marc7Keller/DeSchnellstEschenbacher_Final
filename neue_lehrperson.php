<!DOCTYPE html>
<html>

<head>
	<title>Administration - Neue Lehrperson</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_lehrperson.css" type="text/css">
	<script src="_js/lehrperson.js" type="text/javascript"></script>

    
    <?php 
		error_reporting(0);
        include 'php/config.php';
		include 'includes/sessions.php';
		include 'includes/incl_neue_lehrperson_form.php';
    ?>
    
    
	<script>
        //Livesearch
		function showResult(str) 
		{
			if (str.length==0) 
			{ 
				document.getElementById("livesearch").innerHTML="";
				document.getElementById("livesearch").style.border="0px";
				return;
			}
			if (window.XMLHttpRequest) 
			{
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			} 
			else 
			{  // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() 
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200) 
				{
					document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
					document.getElementById("livesearch").style.border="1px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","livesearch.php?q="+str,false);
			xmlhttp.send();
		}
    </script>
 
	<?php
		if(isset($_GET['vorname']))
		{
			$vorname =$_GET['vorname'];
			$nachname =$_GET['nachname'];

			$sql = "SELECT * FROM `person` where `name` = '".$nachname."' and `firstname` = '".$vorname."';";
    
			$res = mysqli_query($db,$sql);
    
			if (!$res) 
			{
				printf("Error: %s\n", mysqli_error($db));
				exit();
			}
    
			$count = mysqli_num_rows ($res);
    
			if ($count =0)
			{
				$id='';
				$gebjahr = '';
				$strasse = '';
				$plz = '';
				$ort = '';
			}
			else
			{
				while($row = mysqli_fetch_array($res))
				{
					$id = $row['person_id'];
					$gebjahr = $row['year_of_birth'];
					$strasse = $row['street'];
					$plz = $row['plz'];
					$ort = $row['place'];
				}          
			}
		}
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
			
			<h1 id="site_title">Neue Lehrperson</h1>
		
			<form id="form_verwaltung" action="" method="GET">
			
				</br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
			
				Nachname:*		<input  class="form_cells" type="text" id="nachname" name="nachname" value="<?php if(isset($_GET['nachname'])){echo $nachname;}?>"  onblur="colorEmptyField1();" onkeyup="enableLoadButton();"/></br>
				Vorname:*		<input class="form_cells" type="text" id="vorname" name="vorname" value="<?php if(isset($_GET['vorname'])){echo $vorname;}?>" onblur="colorEmptyField2();" onkeyup="enableLoadButton();"/></br></br>
    
								<input id="laden_button" type="submit" name="laden_button_neue_lehrperson" value="Laden" disabled/>
    
			</form>

			<form id="form_verwaltung" action="neue_lehrperson.php" method="POST">
			
				<?php
					if(isset($_GET['vorname']) && isset($_GET['nachname']))
					{
				?>
	
								<input class="form_cells" type="hidden" name="id" value="<?php echo $id;?>" /></br>
								<input id="nachname_neu" class="form_cells" type="hidden" name="vorname" value="<?php if(isset($_GET['vorname'])){echo $vorname;}?>" />
								<input id="vorname_neu" class="form_cells" type="hidden" name="name" value="<?php if(isset($_GET['nachname'])){echo $nachname;}?>" />
				Strasse:		<input id="strasse_neu" class="form_cells" type="text" name="strasse" value="<?php echo $strasse;?>"/></br>
				PLZ:			<input id="plz_neu" class="form_cells" type="text" name="plz" value="<?php echo $plz;?>"/></br>
				Ort:			<input id="ort_neu" class="form_cells" type="text" name="ort" value="<?php echo $ort;?>"/></br></br>
			
								<input id="speichern_button"type="submit" name="speichern_button_neue_lehrperson" value="Speichern"/>
			
			</form>
		
			<?php 
				
					}
			
				echo "<br><br><br><br>";
			
				$sql = "SELECT * FROM `teacher` inner join person on fs_person = person.person_id where fs_event = ".$_SESSION['event']." ORDER BY teacher_id desc;";
				$res = mysqli_query($db,$sql);
				
				if(mysqli_num_rows($res) >= 1)
				{	 
					echo '<table border="1" id="lehrperson_tabelle">'; 
					echo "<tr><th>Name</th><th>Vorname</th></tr>"; 
					
					while($row = mysqli_fetch_array($res))
					{
						echo "<tr><td>"; 
						echo $row['name'];
						echo "</td><td>"; 
						echo $row['firstname'];
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