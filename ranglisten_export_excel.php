<?php
    include 'php/config.php';
    include 'includes/sessions2.php';
    
    require_once 'phpexcel/PHPExcel.php';
    
    $objPHPExcel = new PHPExcel();
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ranglisten_export.xls"');
    header('Cache-Control: max-age=0');
 

    $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(8);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');

    $sql = "SELECT * from category where fs_event = ".$_SESSION['event']." order by category_id asc";
    $res = mysqli_query($db,$sql);
    
    $worksheetCounter = 1;

    while($row = mysqli_fetch_array($res))
    {
        if($worksheetCounter == 1)
        {
            $objWorksheet = $objPHPExcel->getActiveSheet();
        }
        else
        {
            $objWorksheet = $objPHPExcel->createSheet($worksheetCounter);
        }
        
        $objWorksheet->getStyle('A1:K1')->getFont()->setBold(true)->setSize(12);
        
        $objWorksheet->setTitle($row['category_name']);
        
        $sql2 = "SELECT @pos:=@pos+1 as Rang,name as Name,firstname as Vorname,start_number as Startnummer,street as Strasse, plz as PLZ, place as Ort,year_of_birth as Jahrgang, category_name as Kategorie, first_lap as Zeit,second_lap as Finallauf FROM `laptimes` inner join `participants` on fs_participant = participant_id inner join person on fs_person = person_id inner join category on fs_category = category_id cross join (select @pos := 0) r where participants.fs_event = ".$_SESSION['event']." and fs_category = ".$row['category_id']." and first_lap != 0 order by isnull(second_lap),second_lap,isnull(first_lap),first_lap;";
        $res2 = mysqli_query($db,$sql2);
        
        $objWorksheet->setCellValue('A1','Rang')
                     ->setCellValue('B1','Name')
                     ->setCellValue('C1','Vorname')
                     ->setCellValue('D1','Startnummer')
                     ->setCellValue('E1','Strasse')
                     ->setCellValue('F1','PLZ')
                     ->setCellValue('G1','Ort')
                     ->setCellValue('H1','Jahrgang')
                     ->setCellValue('I1','Kategorie')
                     ->setCellValue('J1','Zeit')
                     ->setCellValue('K1','Finallauf-Zeit');
        
        $rowCounter = 2;
        
        while($row2 = mysqli_fetch_array($res2))
        {
            $objWorksheet->setCellValue('A'.$rowCounter,$row2['Rang'])
                         ->setCellValue('B'.$rowCounter,$row2['Name'])
                         ->setCellValue('C'.$rowCounter,$row2['Vorname'])
                         ->setCellValue('D'.$rowCounter,$row2['Startnummer'])
                         ->setCellValue('E'.$rowCounter,$row2['Strasse'])
                         ->setCellValue('F'.$rowCounter,$row2['PLZ'])
                         ->setCellValue('G'.$rowCounter,$row2['Ort'])
                         ->setCellValue('H'.$rowCounter,$row2['Jahrgang'])
                         ->setCellValue('I'.$rowCounter,$row2['Kategorie'])
                         ->setCellValue('J'.$rowCounter,$row2['Zeit'])
                         ->setCellValue('K'.$rowCounter,$row2['Finallauf']);
            
            $rowCounter++;
        }
        
        $objWorksheet->getColumnDimension('A')->setAutoSize(true);
        $objWorksheet->getColumnDimension('B')->setAutoSize(true);
        $objWorksheet->getColumnDimension('C')->setAutoSize(true);
        $objWorksheet->getColumnDimension('D')->setAutoSize(true);
        $objWorksheet->getColumnDimension('E')->setAutoSize(true);
        $objWorksheet->getColumnDimension('F')->setAutoSize(true);
        $objWorksheet->getColumnDimension('G')->setAutoSize(true);
        $objWorksheet->getColumnDimension('H')->setAutoSize(true);
        $objWorksheet->getColumnDimension('I')->setAutoSize(true);
        $objWorksheet->getColumnDimension('J')->setAutoSize(true);
        $objWorksheet->getColumnDimension('K')->setAutoSize(true);
        
        $worksheetCounter++;
    }

    $objWorksheet = $objPHPExcel->createSheet($worksheetCounter);
    $objWorksheet->getStyle('A1:H1')->getFont()->setBold(true)->setSize(12);
    $objWorksheet->setTitle('Klassenlehrerliste');
    
    $sql3 = "SELECT @pos:=@pos+1 as Rang,class_name as Klasse, name as Name, firstname as Vorname, school as Schule, number_of_students as 'Anzahl Schüler', Count(*) as gestartet, (100/ number_of_students * count(participant_id)) as Prozent FROM laptimes inner join participants on fs_participant = participant_id inner join class on fs_class = class_id inner join teacher on teacher_id = fs_teacher inner join person on teacher.fs_person = person_id cross join (select @pos := 0) r where participants.fs_event = 1 and first_lap != 0  group by class_id order by Prozent desc;";
    $res3 = mysqli_query($db,$sql3);

    $objWorksheet->setCellValue('A1','Rang')
                 ->setCellValue('B1','Klasse')
                 ->setCellValue('C1','Name')
                 ->setCellValue('D1','Vorname')
                 ->setCellValue('E1','Schule')
                 ->setCellValue('F1','Anzahl Schüler')
                 ->setCellValue('G1','Gestartet')
                 ->setCellValue('H1','Prozent');

    $rowCounter = 2;

    while($row3 = mysqli_fetch_array($res3))
    {
        $objWorksheet->setCellValue('A'.$rowCounter,$row3['Rang'])
                     ->setCellValue('B'.$rowCounter,$row3['Klasse'])
                     ->setCellValue('C'.$rowCounter,$row3['Name'])
                     ->setCellValue('D'.$rowCounter,$row3['Vorname'])
                     ->setCellValue('E'.$rowCounter,$row3['Schule'])
                     ->setCellValue('F'.$rowCounter,$row3['Anzahl Schüler'])
                     ->setCellValue('G'.$rowCounter,$row3['gestartet'])
                     ->setCellValue('H'.$rowCounter,$row3['Prozent']);
            
        $rowCounter++;
    }

    $objWorksheet->getColumnDimension('A')->setAutoSize(true);
    $objWorksheet->getColumnDimension('B')->setAutoSize(true);
    $objWorksheet->getColumnDimension('C')->setAutoSize(true);
    $objWorksheet->getColumnDimension('D')->setAutoSize(true);
    $objWorksheet->getColumnDimension('E')->setAutoSize(true);
    $objWorksheet->getColumnDimension('F')->setAutoSize(true);
    $objWorksheet->getColumnDimension('G')->setAutoSize(true);
    $objWorksheet->getColumnDimension('H')->setAutoSize(true);

    PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
    $objWriter->save('php://output');
?>