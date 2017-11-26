<?php


include("php/config.php");
include("includes/sessions4.php");
include("fpdf/fpdf.php"); 


class PDF extends FPDF {
    // Kopfzeile
    function Header(){

        $this->Image('_img/sportclubdiemberg_logo_klein.png',15,12,33);
        
        $this->SetFont('Arial','B',18);
        
        $this->Cell(80);
        // Titel
        
        
        
        $this->Cell(30,10,'De schnellscht Eschebacher 2017',0,0,'C');
        
        $this->Image('_img/deschnellsteschenbacher_logo_klein.png',160,8,33);
        
        $this->Ln(25);
    } 

    // Fusszeile
    function Footer(){
        $this->SetY(-20);
        $this->SetFont('Arial','',8);
        // Seitenzahl
        $this->Cell(340,20,'Seite '.$this->PageNo().'/{nb}',0,0,'C');
        $this->Image('_img/sponsor_raiffeisen.png',80,275,45);

    }
}

$pdf=new PDF(); 



foreach ($_POST['kategorie'] as &$value) {
    $sql= "SELECT * FROM category where fs_event = ".$_SESSION['event']." AND category_id = ".$value.";";
    $res = mysqli_query($db,$sql);
    if(mysqli_num_rows($res) >= 1){
        $row = mysqli_fetch_array($res);
        $category_name = $row['category_name'];
        
        $pdf->AddPage(); 
        
        $pdf->Cell(80);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(30,10,"Kategorie: ".utf8_decode($row['category_name'])." Distanz: ".$row['track_length'],0,0,'C');
        $pdf->Ln(9);


        $sql = "SELECT * FROM participants inner join person on fs_person = person_id where fs_event = ".$_SESSION['event']." and fs_category = ".$value." order by start_number;";
        //$sql= "SELECT * FROM `laptimes` inner join `participants` on fs_participant = participant_id inner join person on fs_person = person_id where fs_event = ".$_SESSION['event']." and fs_category = ".$value." order by isnull(second_lap),second_lap,isnull(first_lap),first_lap;";
        $res = mysqli_query($db,$sql);
        $pdf->SetFont('Arial','',12);
        $rang = 1;
    
        $pdf->Cell(5,10,'',0,0,'L');
        $pdf->Cell(15,10,'Startnr.',0,0,'L');
        $pdf->Cell(40,10,'Zeit',0,0,'L');
            $pdf->Cell(60,10,'Name',0,0,'A');
            $pdf->Cell(20,10,'Jahrgang',0,0,'A');

        $pdf->Ln(7);
        
        while($row = mysqli_fetch_array($res)){
            $pdf->Cell(5,10,'',0,0,'L');
            $pdf->Cell(15,10,$row['start_number'],0,0,'L');
            $pdf->Cell(40,10,'______.______',0,0,'L');
            $pdf->Cell(60,10,utf8_decode($row['name'])." ".utf8_decode($row['firstname']),0,0,'A');
            $pdf->Cell(20,10,$row['year_of_birth'],0,0,'A');
            
            $pdf->Ln(7);
            $rang++;
        }
        
        for ($x = 0; $x <= 10; $x++) {
            $pdf->Cell(5,10,'',0,0,'L');
            $pdf->Cell(15,10,'____     ______.______      __________________________   ____',0,0,'L');
            $pdf->Ln(7);
        }
    }
}







$pdf->AliasNbPages('{nb}');
$pdf->Output();
?>