<?php


include("php/config.php");
include("includes/sessions4.php");
include("fpdf/fpdf.php"); 


class PDF extends FPDF {
    // Kopfzeile
    function Header(){
        $this->SetFont('Arial','B',18);
        if ($this->page != 1)
        {
            $this->Image('_img/sportclubdiemberg_logo_klein.png',15,12,33);



            $this->Cell(80);
            $this->Cell(30,10,'De schnellscht Eschebacher 2017',0,0,'C');

            $this->Image('_img/deschnellsteschenbacher_logo_klein.png',160,8,33);

            $this->Ln(25);
        }
        // Titel




    } 

    // Fusszeile
    function Footer(){
        $this->SetFont('Arial','',8);
        if ($this->page != 1)
        {
            $this->SetY(-20);

            // Seitenzahl
            $this->Cell(340,20,'Seite '.$this->PageNo().'/{nb}',0,0,'C');
            $this->Image('_img/sponsor_raiffeisen.png',80,275,45);
        }

    }
}

$pdf=new PDF(); 

$pdf->AddPage();
$pdf->SetFont('Arial','B',30);
$pdf->Ln(180);
$sql= "SELECT * FROM event where event_id = ".$_SESSION['event'].";";
$res = mysqli_query($db,$sql);
if(mysqli_num_rows($res) >= 1){
    $row = mysqli_fetch_array($res);
    $pdf->Cell(200,10,$row['event_name'],0,0,'C');
    $pdf->Ln(12);
    $pdf->Cell(200,10,$row['year'],0,0,'C');
}
$pdf->Image('_img/deschnellsteschenbacher_logo.png',40,53,120);
//$pdf->Image('_img/sponsor_raiffeisen.png',75,250,70);
$pdf->Image('_img/sponsor_raiffeisen.png',28,250,70);
$pdf->Image('_img/sportclubdiemberg_logo_klein.png',108,250,70);


$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,10,utf8_decode("Rangliste über 80 Meter Herren"),0,0,'C');
$pdf->Ln(9);

$pdf->SetFont('Arial','',10);
$pdf->Cell(5,10,'',0,0,'A');
$pdf->Cell(10,10,"Rang",0,0,'A');
$pdf->Cell(55,10,"Name",0,0,'A');
$pdf->Cell(40,10,"Adresse",0,0,'A');
$pdf->Cell(25,10,"Jahrgang",0,0,'A');
$pdf->Cell(15,10,"Zeit",0,0,'A');
$pdf->Cell(15,10,"Finallauf",0,0,'A');
$pdf->Ln(7);

$sql= "SELECT * FROM laptimes inner join participants on fs_participant = participant_id inner join person on fs_person = person_id inner join category on category_id = fs_category where participants.fs_event = ".$_SESSION['event']." and gender = 'Männlich' and track_length = 80 and first_lap != 0 order by isnull(second_lap),second_lap,isnull(first_lap),first_lap;";

$res = mysqli_query($db,$sql);
$pdf->SetFont('Arial','',10);
$rang = 1;
while($row = mysqli_fetch_array($res)){
    $pdf->Cell(5,10,'',0,0,'A' );
    $pdf->Cell(10,10,$rang,0,0,'L');

    $pdf->Cell(55,10,utf8_decode($row['name'])." ".utf8_decode($row['firstname']),0,0,'A');
    $pdf->Cell(40,10,utf8_decode($row['street']),0,0,'A');
    $pdf->Cell(25,10,$row['year_of_birth'],0,0,'A');
    //$firstlap = round($row['first_lap'],2);
    $first_lap = number_format($row['first_lap'],2,".","");
    if($row['first_lap'] != NULL ){
        $pdf->Cell(15,10,$first_lap."s",0,0,'A');
    }else{
        $pdf->Cell(15,10,'',0,0,'A');
    }
    $second_lap = number_format($row['second_lap'],2,".","");
    if($row['second_lap'] != NULL ){
        $pdf->Cell(15,10,$second_lap."s",0,0,'A');
    }

    $pdf->Ln(7);
    $rang++;
}    

$pdf->AddPage();
$pdf->Cell(80);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,10,utf8_decode("Rangliste über 80 Meter Frauen"),0,0,'C');
$pdf->Ln(9);

$pdf->SetFont('Arial','',10);
$pdf->Cell(5,10,'',0,0,'A');
$pdf->Cell(10,10,"Rang",0,0,'A');
$pdf->Cell(55,10,"Name",0,0,'A');
$pdf->Cell(40,10,"Adresse",0,0,'A');
$pdf->Cell(25,10,"Jahrgang",0,0,'A');
$pdf->Cell(15,10,"Zeit",0,0,'A');
$pdf->Cell(15,10,"Finallauf",0,0,'A');
$pdf->Ln(7);

$sql= "SELECT * FROM laptimes inner join participants on fs_participant = participant_id inner join person on fs_person = person_id inner join category on category_id = fs_category where participants.fs_event = ".$_SESSION['event']." and gender = 'Weiblich' and track_length = 80 and first_lap != 0 order by isnull(second_lap),second_lap,isnull(first_lap),first_lap;";

$res = mysqli_query($db,$sql);
$pdf->SetFont('Arial','',10);
$rang = 1;
while($row = mysqli_fetch_array($res)){
    $pdf->Cell(5,10,'',0,0,'A' );
    $pdf->Cell(10,10,$rang,0,0,'L');

    $pdf->Cell(55,10,utf8_decode($row['name'])." ".utf8_decode($row['firstname']),0,0,'A');
    $pdf->Cell(40,10,utf8_decode($row['street']),0,0,'A');
    $pdf->Cell(25,10,$row['year_of_birth'],0,0,'A');
    //$firstlap = round($row['first_lap'],2);
    $first_lap = number_format($row['first_lap'],2,".","");
    if($row['first_lap'] != NULL ){
        $pdf->Cell(15,10,$first_lap."s",0,0,'A');
    }else{
        $pdf->Cell(15,10,'',0,0,'A');
    }
    $second_lap = number_format($row['second_lap'],2,".","");
    if($row['second_lap'] != NULL ){
        $pdf->Cell(15,10,$second_lap."s",0,0,'A');
    }

    $pdf->Ln(7);
    $rang++;
}    


$pdf->AliasNbPages('{nb}');
$pdf->Output();
?>