<?php
ob_end_clean();
require("../fpdf.php");
include_once("connection.php");
define('FPDF_FONTPATH','font/');
$pdf = new FPDF();




$con = mysqli_connect("localhost", "root", "", "request_docu");


if (isset($_POST['create'])) {
    $ref_num_cl = isset($_POST['ref_cl']) ? $_POST['ref_cl'] : '';
    $total_amount_cl = isset($_POST['total_cl']) ? $_POST['total_cl'] : '';
    $name_cl = isset($_POST['name_cl']) ? $_POST['name_cl']: '';


    $pdf->AddPage();
    $pdf->SetFont("arial", "B", 22);
    $pdf->SetTextColor(3, 14, 79);








    $pdf->Image('img/logo.png', 10, 2, 30);
    $pdf->Cell(180,10,'Polyverse Institute Technology',0,1,'C');








    $pdf->SetTextColor(26);








    $pdf->SetFont("arial", "B", 10);
    $pdf->Cell(180,5,'1234 Main Street Oakland, CA 94607',0,1,'C');
    $pdf->Cell(180,5,'Email: registrar@pit.edu.ph',0,1,'C');
    $pdf->Cell(180,5,'Tel #: (555) 123-4567',0,1,'C');








    $pdf->SetTextColor(3, 14, 79);
    $pdf->SetFont("arial", "B", 26);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();




    $pdf->Cell(180,15,'REFERENCE NUMBER:',0,1,'C');
    $pdf->Cell(180,15,$ref_num_cl,1,1,'C');


    $pdf->SetTextColor(0);
    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(60,10,'Name:',1,0);
    $pdf->SetTextColor(3, 14, 79);


    $pdf->Cell(120,10,$name_cl,1,1,'C');
    $pdf->SetFont("arial", "B", 10);
    $pdf->SetTextColor(244,159,28);
   
    // NAME
    $pdf->SetTextColor(0);
    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(60,10,'Amount to be Paid:',1,0);
    $pdf->SetTextColor(3, 14, 79);


    $pdf->Cell(120,10,$total_amount_cl,1,1,'C');
    $pdf->SetFont("arial", "B", 10);
    $pdf->SetTextColor(244,159,28);
    $pdf->Cell(180,10,'After paying, go to status tab and fill out payment information to process your document.', 0,1,'C');


$pdf->Output();
}
?>