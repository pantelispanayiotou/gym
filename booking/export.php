<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('config.php');

require("fpdf/fpdf.php");
        $pdf = new FPDF();
       $pdf->AddPage();
       $pdf->SetFont('Arial','B',16);
         
//        $sqlh = "SELECT COLUMN_NAME from $booktb  ";    
//        $rheader = mysqli_query($conn, $sqlh);
//
//        $headerrow = mysqli_fetch_assoc($rheader);
//        $header=$headerrow[0];
        
       $pdf->Cell(80,10,'Hello World!',1,0,true,'http://cproject.in.cs.ucy.ac.cy/gym/booking/');
 
$pdf->Output('my_file.pdf','i');
echo '<meta http-equiv="refresh" content="0">';
//        $pdf->Output();

        

//       foreach($header as $heading) {
//    foreach($heading as $column_heading)
//	  $pdf->Cell(95,12,$column_heading,1);
//      }       
//
//  
//                foreach($resu as $row) {
//	           $pdf->Ln();
//	           foreach($row as $column)
//		      $pdf->Cell(95,12,$column,1);
//               }	
//             
//                 $filename="/test.pdf";
//$pdf->Output($filename,'F');


 
?>