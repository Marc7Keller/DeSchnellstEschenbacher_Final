<!DOCTYPE html>
<html>

<head>
	<title>Administration - Neuer Teilnehmer</title>
	<link rel="stylesheet" href="_css/style.css" type="text/css">
	<link rel="stylesheet" href="_css/style_teilnehmer.css" type="text/css">
	<script src="_js/teilnehmer.js" type="text/javascript"></script>

    <?php 
		error_reporting(0);
        include 'php/config.php';
		include 'includes/sessions.php';
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
		
		if(isset($_POST['speichern_button_neuer_teilnehmer']))
		{
			$id = $_POST['id'];
			$vorname =$_POST['vorname'];
			$nachname =$_POST['nachname'];
			$gebjahr = $_POST['gebjahr'];
			$strasse = $_POST['strasse'];
			$plz = $_POST['plz'];
			$ort = $_POST['ort'];
			
			$anlass = $_SESSION['event'];
			$klasse = $_POST['klasse'];
			$kategorie = $_POST['kategorie'];
    
			if($id='')
			{         
				$id = 0;
            } 
    
    
			if($id !=0)
			{
				$sql = "Update `person` set `name` = '".$nachname."' , `firstname` = '".$vorname."', `year_of_birth` = '".$gebjahr."', `plz` = '".$plz."', `place` = '".$ort."', `street` = '".$strasse."' where `person_id` = ".$id.";";
				$res = mysqli_query($db,$sql);
				
				if (!$res) 
				{    
					printf("Error: %s\n", mysqli_error($db));    
					exit();    
				}
			}
			else
			{
				$sql = "INSERT INTO `person` (`name`, `firstname`, `year_of_birth`, `plz`, `place`, `street`) VALUES ('".$nachname."', '".$vorname."', '".$gebjahr."', '".$plz."', '".$ort."', '".$strasse."');";
				$res = mysqli_query($db,$sql);
				
				if (!$res) 
				{    
					printf("Error: %s\n", mysqli_error($db));    
					exit();    
				}
       
				$sql = "SELECT person_id FROM person WHERE name = '".$nachname."' AND firstname =  '".$vorname."';";
				$res = mysqli_query($db,$sql);
				
				if (!$res) 
				{    
					printf("Error: %s\n", mysqli_error($db));    
					exit();    
				}
        
				$row = mysqli_fetch_array($res);
				$id= $row['person_id'];       
			}
  
			$sql = "INSERT INTO participants (fs_person,fs_class,fs_category,fs_event, late_registration) VALUES (".$id.",".$klasse.",".$kategorie.",".$anlass.",0);";
			$res = mysqli_query($db,$sql); 
				
			if (!$res) 
			{
					printf("Error: %s\n", mysqli_error($db));
					exit();
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
			
			<h1 id="site_title">Neuer Teilnehmer</h1>
		
			<form id="form_verwaltung" action="" method="GET">
			
				</br><p style="font-size: 11px;">Felder mit * markiert sind Pflichtfelder</p></br>
			
				Nachname:*		<input  class="form_cells" type="text" id="nachname" name="nachname" value="<?php if(isset($_GET['nachname'])){echo $nachname;}?>"  onblur="colorEmptyField1();" onkeyup="enableLoadButton();"/></br>
				Vorname:*		<input id="vorname" class="form_cells" type="text" id="vorname" name="vorname" value="<?php if(isset($_GET['vorname'])){echo $vorname;}?>" onblur="colorEmptyField2();" onkeyup="enableLoadButton();"/></br></br>
    
				<input id="laden_button" type="submit" name="laden_button_neuer_teilnehmer" value="Laden" disabled/>
    
			</form>

			<form id="form_verwaltung" action="neuer_teilnehmer.php" method="POST">
	
				<?php
					if(isset($_GET['vorname']) && isset($_GET['nachname']))
					{
				?>
								<input  class="form_cells" type="hidden" name="id" value="<?php echo $id;?>" /></br>
								<input  class="form_cells" type="hidden" name="vorname" value="<?php if(isset($_GET['vorname'])){echo $vorname;}?>" />
								<input  class="form_cells" type="hidden" name="nachname" value="<?php if(isset($_GET['nachname'])){echo $nachname;}?>" />
				Geburtsjahr:*	<input id="gebjahr" class="form_cells" type="text" name="gebjahr" value="<?php echo $gebjahr;?>" onblur="colorEmptyField3();" onkeyup="enableSubmitButton();"/></br>
				Strasse:		<input id="strasse" class="form_cells" type="text" name="strasse" value="<?php echo $strasse;?>"/></br>
				PLZ:			<input id="plz" class="form_cells" type="text" name="plz" value="<?php echo $plz;?>"/></br>
				Ort:*			<input id="ort" class="form_cells" type="text" name="ort" value="<?php echo $ort;?>" onblur="colorEmptyField4();" onkeyup="enableSubmitButton();"/></br></br>
							
    
				</br></br>
			
				<?php
					echo 'Klasse:* <select  id="klasse" type="text" name="klasse" size="1">';
					$res2 = mysqli_query($db,"SELECT * FROM class, teacher, person WHERE fs_teacher = teacher_id AND fs_person = person_id AND class.fs_event = ".$_SESSION['event']." ORDER BY class_name asc;");
           
					while($row = mysqli_fetch_array($res2))
					{
						echo '<option value="'.$row['class_id'].'">'.$row['class_name'].' - '.$row['firstname'].' '.$row['name'].'</option>';
					}
            
					echo '</select><br>';

					echo 'Kategorie:*  <select  id="kategorie" type="text" name="kategorie" size="1">';
				
					$res2 = mysqli_query($db,"SELECT * FROM category WHERE fs_event = ".$_SESSION['event']." ORDER BY category_name asc;");
           
					while($row = mysqli_fetch_array($res2))
					{
						echo '<option value="'.$row['category_id'].'">'.$row['category_name'].' / '.$row['track_length'].'m'.' / '.$row['year_of_birth_start'].' - '.$row['year_of_birth_end'].' / '.$row['gender'].'</option>';
					}
            
					echo '</select></br></br>';
					
					$sql = "SELECT * FROM `participants` WHERE fs_event = ".$_SESSION['event'].";";
					$result = mysqli_query($db,$sql);
					$num_of_participants = mysqli_num_rows($result);
					
                    $sql = "SELECT * FROM `participants` WHERE fs_event = ".$_SESSION['event'].";";
					$result = mysqli_query($db,$sql);
					$count1  = mysqli_num_rows($result);
					
					$sql = "SELECT * FROM `participants` WHERE start_number = 0 AND fs_event = ".$_SESSION['event'].";";
					$result = mysqli_query($db,$sql);
					$count  = mysqli_num_rows($result);
					if($count != 0 ||$count1== 0 )
					{
				?>
								<input id="speichern_button" type="submit" name="speichern_button_neuer_teilnehmer" value="Speichern"/>
			
			</form>
		
			<?php
					}
				}
					
				echo "<br><br><br><br>";
	
				$sql = "SELECT participants.participant_id, person.name, person.firstname, person.year_of_birth, person.plz, person.place, person.street, class.class_name as classbez, category.category_name as catbez, participants.late_registration, participants.start_number FROM `participants` inner join `person` on person.person_id = participants.fs_person inner join `category` on category.category_id = participants.fs_category INNER JOIN `class` on class.class_id = participants.fs_class WHERE participants.fs_event = ".$_SESSION['event']." and participants.deleted != 1 ORDER BY participant_id desc;";
				$res = mysqli_query($db,$sql);
	 
				if(mysqli_num_rows($res) >= 1)
				{	 
					echo '<table border="1" id="teilnehmer_tabelle">'; 
					echo "<tr><th>Name</th><th>Vorname</th><th>Geburtsjahr</th><th>PLZ</th><th>Ort</th><th>Strasse</th><th>Klasse</th><th>Kategorie</th><th>Startnummer</th><th>Nachanmeldung</th></tr>"; 
					
					while($row = mysqli_fetch_array($res))
					{
						echo '<form action="teilnehmer_bearbeiten.php" method="POST">';
						echo "<tr><td>"; 
						echo $row['name'];
						echo "</td><td>"; 
						echo $row['firstname'];
						echo "</td><td>";   
						echo $row['year_of_birth'];
						echo "</td><td>";    
						echo $row['plz'];
						echo "</td><td>";
						echo $row['place'];
						echo "</td><td>";
						echo $row['street'];
						echo "</td><td>";
						echo $row['classbez'];
						echo "</td><td>";
						echo $row['catbez'];
						echo "</td><td>";
						echo $row['start_number'];
						echo "</td><td>";
						echo $row['late_registration'];
						echo "</td></tr>";
						?>
							<input hidden="text" name="participant_id" value="<?php echo $row['participant_id'];?>"/>
						<?php
						echo "</form>";
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
