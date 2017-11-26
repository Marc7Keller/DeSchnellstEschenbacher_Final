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
        if($row['category_name']!= 'PH' and $row['category_name']!= 'PF'){

            $pdf->AddPage(); 


            $pdf->Cell(80);
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(30,10,"Kategorie: ".$row['category_name']." Distanz: ".$row['track_length']."m",0,0,'C');
            $pdf->Ln(9);

            $category_name = $row['category_name'];

            $pdf->SetFont('Arial','',10);
            $pdf->Cell(5,10,'',0,0,'A');
            $pdf->Cell(10,10,"Startnr.",0,0,'A');
            $pdf->Cell(55,10,"Name",0,0,'A');
            $pdf->Cell(40,10,"Adresse",0,0,'A');
            $pdf->Cell(25,10,"Jahrgang",0,0,'A');
            $pdf->Cell(15,10,"Zeit",0,0,'A');
            $pdf->Cell(15,10,"Finallauf",0,0,'A');
            $pdf->Ln(7);

            $sql= "SELECT * FROM `laptimes` inner join `participants` on fs_participant = participant_id inner join person on fs_person = person_id where fs_event = ".$_SESSION['event']." and fs_category = ".$value." and first_lap != 0 order by isnull(second_lap),second_lap,isnull(first_lap),first_lap limit 4;";


            $res = mysqli_query($db,$sql);
            $pdf->SetFont('Arial','',10);
            $rang = 1;
            while($row = mysqli_fetch_array($res)){
                $pdf->Cell(5,10,'',0,0,'A' );
                $pdf->Cell(10,10,$row['start_number'],0,0,'L');
                $pdf->Cell(55,10,utf8_decode($row['name'])." ".utf8_decode($row['firstname']),0,0,'A');
                $pdf->Cell(40,10,utf8_decode($row['street']),0,0,'A');
                $pdf->Cell(25,10,$row['year_of_birth'],0,0,'A');
                //$firstlap = round($row['first_lap'],2);
                $first_lap = number_format($row['first_lap'],2,".","");
                $pdf->Cell(15,10,$first_lap."s",0,0,'A');

                $second_lap = number_format($row['second_lap'],2,".","");
                if($row['second_lap'] != NULL ){
                    $pdf->Cell(15,10,$second_lap."s",0,0,'A');
                }

                $pdf->Ln(7);
                $rang++;
            }

        }

    }



}


$pdf->AliasNbPages('{nb}');
$pdf->Output();
?>