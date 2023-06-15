<?php
session_start();
$_SESSION['status']= 'success'; // You can set the value however you like.




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reference_num = isset($_POST['reference_num']) ? $_POST['reference_num'] : '';
    $receipt_num = isset($_POST['receipt_num']) ? $_POST['receipt_num'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $amount_paid = isset($_POST['amount_paid']) ? $_POST['amount_paid'] : '';
   
    // Database connection
    $host = "localhost:3306";
    $username = "root";
    $password = "";
    $database = "payment_info";
   
    $conn = new mysqli($host, $username, $password, $database);
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   
    // Save the uploaded image
    $target_dir = "../uploadss/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
   
// Database connection for the other database (containing tbl_request_student)
$host_other = "localhost:3306";
$username_other = "root";
$password_other = "";
$database_other = "request_docu";




$conn_other = new mysqli($host_other, $username_other, $password_other, $database_other);




if ($conn_other->connect_error) {
    die("Other Database Connection failed: " . $conn_other->connect_error);
}




// Check if the reference number exists
$query = "SELECT * FROM tbl_request_student WHERE reference_num = '$reference_num'";
$query_cl = "SELECT * FROM tbl_request_client WHERE reference_num = '$reference_num'";


$result = $conn_other->query($query);
$result_cl = $conn_other->query($query_cl);


if ($result->num_rows > 0) {
    // Reference number exists, proceed with the insertion
    $sql = "INSERT INTO tbl_payment_info (reference_num, receipt_num, date, amount_paid, image) VALUES ('$reference_num', '$receipt_num', '$date', '$amount_paid', '$target_file')";


    if ($conn->query($sql) === TRUE) {
        $query_update = "UPDATE tbl_request_student SET payment_status = 'Paid' WHERE reference_num = '$reference_num'";
        $result_update = $conn_other->query($query_update);


        if ($result_update === TRUE) {
            $_SESSION['reference'] = $reference_num;
            $_SESSION['receipt'] = $receipt_num;
            $_SESSION['dop'] = $date;
            $_SESSION['amount'] = $amount_paid;
   
            $_SESSION['status'] = "success";
            header('Location: status.php');
            exit();
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else
if ($result_cl->num_rows > 0){
    $sql = "INSERT INTO tbl_payment_info (reference_num, receipt_num, date, amount_paid, image) VALUES ('$reference_num', '$receipt_num', '$date', '$amount_paid', '$target_file')";




    if ($conn->query($sql) === TRUE) {
        $_SESSION['reference'] = $reference_num;
        $_SESSION['receipt'] = $receipt_num;
        $_SESSION['dop'] = $date;
        $_SESSION['amount'] = $amount_paid;




        $_SESSION['status'] = "success";
        header('Location: status.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else {
    $_SESSION['status'] = "failed";
    header('Location: status.php');
    echo "Reference number not found";
}




$conn->close();
$conn_other->close();
}
?>
