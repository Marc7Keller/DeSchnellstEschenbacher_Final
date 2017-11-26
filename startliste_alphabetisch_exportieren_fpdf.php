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
$pdf->AddPage(); 
//$pdf->Cell(80);

        $sql = "SELECT * FROM participants inner join person on fs_person = person_id where fs_event = ".$_SESSION['event']." and deleted = 0 order by name, firstname;";
        //$sql= "SELECT * FROM `laptimes` inner join `participants` on fs_participant = participant_id inner join person on fs_person = person_id where fs_event = ".$_SESSION['event']." and fs_category = ".$value." order by isnull(second_lap),second_lap,isnull(first_lap),first_lap;";
        $res = mysqli_query($db,$sql);
        $pdf->SetFont('Arial','',12);
        
        $pdf->Cell(5,10,'',0,0,'L');
        $pdf->Cell(15,10,'Startnr.',0,0,'L');
        $pdf->Cell(60,10,'Name',0,0,'A');
        $pdf->Cell(20,10,'Jahrgang',0,0,'A');
        $pdf->Cell(40,10,'Adresse',0,0,'A');
        //$pdf->Cell(40,10,$row['plz']." ".$row['place'],0,0,'A');
        $pdf->Ln(7);

        while($row = mysqli_fetch_array($res)){
            $pdf->Cell(5,10,'',0,0,'L');
            $pdf->Cell(15,10,$row['start_number'],0,0,'L');
            $pdf->Cell(60,10,utf8_decode($row['name'])." ".utf8_decode($row['firstname']),0,0,'A');
            $pdf->Cell(20,10,$row['year_of_birth'],0,0,'A');
            //$pdf->Cell(40,10,$row['street'],0,0,'A');
            $pdf->Cell(40,10,utf8_decode($row['street']). ", ".$row['plz']." ".utf8_decode($row['place']),0,0,'A');

            $pdf->Ln(7);
        }

  //  }
//}



$pdf->AliasNbPages('{nb}');
$pdf->Output();
?>