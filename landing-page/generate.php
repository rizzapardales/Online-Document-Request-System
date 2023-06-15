<?php
ob_end_clean();
require("../fpdf.php");
include_once("connection.php");
define('FPDF_FONTPATH','font/');
$pdf = new FPDF();


$con = mysqli_connect("localhost", "root", "", "request_docu");




if (isset($_POST['create'])) {
    $refnum = isset($_POST['refnum']) ? $_POST['refnum'] : '';
    $receiptnum = isset($_POST['receipt']) ? $_POST['receipt'] : '';
    $amountpaid = isset($_POST['amount']) ? $_POST['amount'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $receiptimg = isset($_POST['proof']) ? $_POST['proof'] : '';
   


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
    $pdf->SetFont("arial", "B", 20);
    $pdf->Cell(180,15,'Claim Stub',0,1,'C');


    $pdf->SetTextColor(0);
    $pdf->SetFont("arial", "B", 16);
    $pdf->Cell(60,10,'Applicant Information',0,1,'C');
    // $pdf->Cell(100,10,'Receipt Details',0,1, 'C');




    $pdf->SetFont("arial", "B", 9);


$db = new dbObj();
$connString = $db->getConnstring();
$display_heading = array(
    'reference_num' => 'Reference Number',
    'full_name' => 'Full Name',
    'student_num' => 'Student Number',
    'course' => 'Course',
    // Exclude the columns you want to hide
    'college' => 'College',
    'purpose' => 'Purpose',
    'address' => 'Adress',
    'contact_num' => 'Contact Number',
    'email' => 'Email',
    'total_payment' => 'Total Payment',
    'total_amount' => 'Total Payment',
    // 'req_status' => 'Request Status',
    //'payment_status' => 'Payment Status',
    //'progress_status' => 'Progress Status'
);




$result = mysqli_query($connString, "SELECT * FROM tbl_request_student WHERE reference_num='$refnum'");
$header = mysqli_query($connString, "SHOW columns FROM tbl_request_student");




$pdf->SetFillColor(229, 144, 15);
$pdf->SetTextColor(0);
$pdf->SetFont('', 'B');
$pdf->SetLineWidth(0.3);




// APPLICANT'S INFORMATION
foreach ($header as $heading) {
    // Check if the column should be displayed
    if (isset($display_heading[$heading['Field']])) {
        $pdf->Cell(40, 8, $display_heading[$heading['Field']], 1, 0, 'L', true);
        foreach ($result as $row) {
            $pdf->Cell(130, 8, $row[$heading['Field']], 1, 1, 'L', false);
        }
    }
}




//DOCUMENT REQUESTED
$pdf->Ln();
$pdf->SetTextColor(0);
$pdf->SetFont("arial", "B", 16);
$pdf->Cell(58,10,'Document Requested',0,1, 'C');




$pdf->SetFont("arial", "B", 9);


// Fetch the data from tbl_document_requests
$result = mysqli_query($connString, "SELECT * FROM tbl_document_request WHERE for_refnum='$refnum'");
$header = mysqli_query($connString, "SHOW columns FROM tbl_document_list");
$display_heading = array('document_id'=> 'ID', 'description' => 'Document','amount'=>'Amount','num_copies'=>'Copies');


$pdf->SetFillColor(229, 144, 15);
$pdf->SetTextColor(0);
$pdf->SetFont('', 'B');
$pdf->SetLineWidth(0.3);


// Output the header
// foreach ($header as $heading) {
//     $pdf->Cell(20, 10, $display_heading[$heading['Field']], 1, 0, 'L', true);
//     $pdf->Cell(30, 10, $display_heading[$heading['description']], 1, 0, 'L', true);
// }


foreach ($header as $heading) {
    $fieldName = $heading['Field'];
    if ($fieldName === 'description') {
        $pdf->Cell(50, 8, $display_heading['description'], 1, 0, 'L', true);
    } else {
        $pdf->Cell(15, 8, $display_heading[$fieldName], 1, 0, 'L', true);
    }
}


$pdf->Ln();


// Output the data
foreach ($result as $row) {
    $documentID = $row['document_id'];


    // Retrieve the description from document_list table
    $descriptionQuery = "SELECT description FROM tbl_document_list WHERE document_id = $documentID";
    $descriptionResult = mysqli_query($connString, $descriptionQuery);
    $descriptionRow = mysqli_fetch_assoc($descriptionResult);
    $description = $descriptionRow['description'];


    // Retrieve the amount from document_list table
    $amountQuery = "SELECT amount FROM tbl_document_request WHERE for_refnum='$refnum' && document_id = $documentID";
    $amountResult = mysqli_query($connString, $amountQuery);
    $amountRow = mysqli_fetch_assoc($amountResult);
    $amount = $amountRow['amount'];


    // Retrieve the number of copies from document_list table
    $copiesQuery = "SELECT num_copies FROM tbl_document_request WHERE for_refnum='$refnum' && document_id = $documentID";
    $copiesResult = mysqli_query($connString, $copiesQuery);
    $copiesRow = mysqli_fetch_assoc($copiesResult);
    $copies = $copiesRow['num_copies'];




    // Output the data
    $pdf->Cell(15, 8, $row['document_id'], 1, 0, 'L', false);
    $pdf->Cell(50, 8, $description, 1, 0, 'L', false);
    $pdf->Cell(15, 8, $copies, 1, 0, 'L', false);
    $pdf->Cell(15, 8, $amount, 1, 0, 'L', false);


    $pdf->Ln();
}


// RECEIPT DETAILS
$pdf->Ln();
$pdf->SetTextColor(0);
$pdf->SetFont("arial", "B", 16);
$pdf->Cell(40,10,'Receipt Details',0,1, 'C');


$pdf->SetFont("arial", "B", 9);
$pdf->Cell(50, 8, "Reference Number", 1, 0);
$pdf->Cell(50, 8, $refnum, 1, 1);




$pdf->Cell(50, 8, "Receipt Number", 1, 0);
$pdf->Cell(50, 8, $receiptnum, 1, 1);




$pdf->Cell(50, 8, "Date of Payment", 1, 0);
$pdf->Cell(50, 8, $date, 1, 1);




$pdf->Cell(50, 8, "Amount", 1, 0);
$pdf->Cell(50, 8, $amountpaid, 1, 1);




// PIT REGISTRAR
$pdf->Ln();


$pdf->SetTextColor(0);
$pdf->SetFont("arial", "B", 16);
$pdf->Cell(105,10,'For use only by the PIT Registrar Staff:',0,1, 'C');




$pdf->SetFont("arial", "B", 9);
$pdf->Cell(35, 8, "Name of Receiving", 1, 0);
$pdf->Cell(50, 8, '', 1, 0);




$pdf->Cell(35, 8, "Date Received", 1, 0);
$pdf->Cell(50, 8, '', 1, 1);




$pdf->Cell(35, 8, "PIT Registrar Staff", 1, 0);
$pdf->Cell(50, 8, '', 1, 0);




$pdf->Cell(35, 8, "Date Release", 1, 0);
$pdf->Cell(50, 8, '', 1, 0);


$pdf->Line(200, 280,10,280);


$pdf->Output();
}
?>

