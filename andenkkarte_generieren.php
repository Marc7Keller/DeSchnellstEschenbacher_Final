<?php


include("php/config.php");
include("includes/sessions.php");
include("fpdf/fpdf.php"); 


class PDF extends FPDF {
    // Kopfzeile
    function Header(){

        
    } 

    // Fusszeile
    function Footer(){



    }
}

$pdf=new PDF(); 



//foreach ($_POST['kategorie'] as &$value) {
//    $sql= "SELECT * FROM category where fs_event = ".$_SESSION['event']." AND category_id = ".$value.";";
//    $res = mysqli_query($db,$sql);
//    if(mysqli_num_rows($res) >= 1){
//        $row = mysqli_fetch_array($res);
//        $category_name = $row['category_name'];
//        
//        $pdf->AddPage(); 
//        
//        $pdf->Cell(80);
//        $pdf->SetFont('Arial','B',14);
//        $pdf->Cell(30,10,"Kategorie: ".$row['category_name']." Distanz: ".$row['track_length'],0,0,'C');
//        $pdf->Ln(9);


   $sql= "SELECT * FROM `laptimes` inner join `participants` on fs_participant = participant_id inner join person on fs_person = person_id where fs_event = ".$_SESSION['event']." order by fs_category, name;";
        //$sql= "SELECT * FROM `laptimes` inner join `participants` on fs_participant = participant_id inner join person on fs_person = person_id where fs_event = ".$_SESSION['event']." and fs_category = ".$value." order by isnull(second_lap),second_lap,isnull(first_lap),first_lap;";
        $res = mysqli_query($db,$sql);
       
        
        while($row = mysqli_fetch_array($res)){
            
            $sql_event = "SELECT * FROM event where event_id = ".$_SESSION['event'].";";
            $res_event = mysqli_query($db,$sql_event);
            $row_event = mysqli_fetch_array($res_event);
            
            $pdf->AddPage('P','A5'); 
             $pdf->SetFont('Arial','B',20);
            $pdf->Ln(10);
            $pdf->Cell(0,0,''.$row_event['event_name'],0,0,'C');
            $pdf->Ln(10);
            $pdf->Cell(0,0,'Auszeichnung',0,0,'C');
            $pdf->Ln(80);
            
            $pdf->SetFont('Arial','B',18);
            $pdf->Cell(15,10,'',0,0,'C'); 
            $pdf->Cell(60,10,utf8_decode($row['name'])." ".utf8_decode($row['firstname']),0,0,'A');
            $pdf->Ln(15);
            
            $pdf->SetFont('Arial','',16);
            
            $sql_track = "SELECT * from category where category.category_id = ".$row['fs_category']." and fs_event = ".$_SESSION['event'].";";
            $res_track = mysqli_query($db,$sql_track);
            $row_track = mysqli_fetch_array($res_track);
            
            $sql_rang = "SELECT * FROM `laptimes` inner join `participants` on fs_participant = participant_id inner join person on fs_person = person_id where fs_event = ".$_SESSION['event']." and fs_category = ".$row['fs_category']." and first_lap != 0 order by isnull(second_lap),second_lap,isnull(first_lap),first_lap;";
            $res_rang = mysqli_query($db,$sql_rang);
            
            $rangcounter = 1;
            $rang = 0;
            while($row_rang = mysqli_fetch_array($res_rang)){
                if($row['participant_id'] == $row_rang['participant_id']){
                    $rang = $rangcounter;
                }
                $rangcounter++;
            }
                
            $pdf->Cell(15,10,'',0,0,'C'); 
            $pdf->Cell(50,10,'Distanz: ',0,0,'A');
            $pdf->Cell(15,10,$row_track['track_length']. ' Meter',0,0,'A');
            
            if($row_track['category_name']!= 'PH' and $row_track['category_name']!= 'PF'){
                $pdf->Ln(9);
                $pdf->Cell(15,10,'',0,0,'C'); 
                $pdf->Cell(50,10,'Rang: ',0,0,'A');
                $pdf->Cell(15,10,$rang. '. Rang',0,0,'A');
            }
            
            $pdf->Ln(9);
            $pdf->Cell(15,10,'',0,0,'C'); 
            $pdf->Cell(50,10,'Zeit Vorlauf: ',0,0,'A');
            $pdf->Cell(15,10,$row['first_lap']. ' Sekunden',0,0,'A');
            
            $pdf->Ln(9);
            if($row['second_lap'] != NULL){
                $pdf->Cell(15,10,'',0,0,'C'); 
                $pdf->Cell(50,10,'Zeit Finallauf: ',0,0,'A');
                $pdf->Cell(15,10,$row['second_lap']. ' Sekunden',0,0,'A');
            }
            
            $pdf->Image('_img/deschnellsteschenbacher_logo.png',50,40,50);
            $pdf->Image('_img/sportclubdiemberg_logo_klein.png',20,171,33);
            $pdf->Image('_img/sponsor_raiffeisen.png',70,170,45);
            //$pdf->Cell(30,10,$row['first_lap'],0,0,'A');
            //$pdf->Cell(30,10,$row['second_lap'],0,0,'A');
            $pdf->Ln(7);
            $rang++;
        }

    //}
//}



$pdf->AliasNbPages('{nb}');
$pdf->Output();
?>