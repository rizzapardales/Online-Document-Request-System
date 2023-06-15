<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "", "request_docu");
    $ref_num = $_SESSION['ref_num'];
    $name = $_SESSION['name'];




    if(isset($_POST['save_multiple_checkbox'])) {
        $documents = $_POST['documents'];
        $numcopies = $_POST['numcopies'];
        $amount = $_POST['amount'];








        foreach ($documents as $key => $document) {
            $numcopy = isset($numcopies[$key]) ? $numcopies[$key] : 0;
            $amountValue = isset($amount[$key]) ? $amount[$key] : 0;








            $query = "INSERT INTO tbl_document_request (for_refnum, document_id, num_copies, amount) VALUES ('$ref_num', '$document', '$numcopy', '$amountValue')";
            $query_run = mysqli_query($con, $query);
        }








        if($query_run){
            header("Location: ../landing-page/home.html");
            $_SESSION['status'] = "Inserted Successfully";
        }
       
    }
    $total = $_POST['total_amount'];








    $query2 = "UPDATE tbl_request_student SET total_payment = '$total' WHERE reference_num = '$ref_num'";
        $query_run2 = mysqli_query($con, $query2);








        if($query_run2){
            $_SESSION['status'] = "Updated Successfully";
        }


