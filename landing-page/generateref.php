<?php
ob_end_clean();
require("../fpdf.php");
include_once("connection.php");
define('FPDF_FONTPATH','font/');
$pdf = new FPDF();




$con = mysqli_connect("localhost", "root", "", "request_docu");








if (isset($_POST['create'])) {
    $refnum = isset($_POST['ref']) ? $_POST['ref'] : '';
    $total_amount = isset($_POST['total']) ? $_POST['total'] : '';
    $name = isset($_POST['name']) ? $_POST['name']: '';


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
    $pdf->Cell(180,15,$refnum,1,1,'C');


    $pdf->SetTextColor(0);
    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(60,10,'Name:',1,0);
    $pdf->SetTextColor(3, 14, 79);


    $pdf->Cell(120,10,$name,1,1,'C');
    $pdf->SetFont("arial", "B", 10);
    $pdf->SetTextColor(244,159,28);
   
    // NAME
    $pdf->SetTextColor(0);
    $pdf->SetFont("arial", "B", 12);
    $pdf->Cell(60,10,'Amount to be Paid:',1,0);
    $pdf->SetTextColor(3, 14, 79);


    $pdf->Cell(120,10,$total_amount,1,1,'C');
    $pdf->SetFont("arial", "B", 10);
    $pdf->SetTextColor(244,159,28);
    $pdf->Cell(180,10,'After paying, go to status tab and fill out payment information to process your document.', 0,1,'C');


$pdf->Output();
}
?>






