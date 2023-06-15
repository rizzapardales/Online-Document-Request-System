<?php
$host = 'localhost:3306';
$db = 'request_docu';
$user = 'root';
$password = '';


$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $status = $_POST['status'];
    $date = $_POST['date'];
    $progress = $_POST['progress'];
   


    // Set the reference number
    $referenceNumber = $_GET['ref']; // Replace with the appropriate way to retrieve the reference number


    // Update the database with the new values
    $sql = "UPDATE tbl_request_student SET req_status = '$status', claim_date = '$date', progress_status = '$progress' WHERE reference_num = '$referenceNumber'";
    if ($conn->query($sql) === TRUE) {
        header('Location: admin.php');
        //echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


$conn->close();
?>

<?php
$host = 'localhost:3306';
$db = 'request_docu';
$user = 'root';
$password = '';


$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $status = $_POST['status'];
    $date = $_POST['date'];
    $progress = $_POST['progress'];
   


    // Set the reference number
    $referenceNumber = $_GET['ref']; // Replace with the appropriate way to retrieve the reference number


    // Update the database with the new values
    $sql = "UPDATE tbl_request_client SET req_status = '$status', claim_date = '$date', progress_status = '$progress' WHERE reference_num = '$referenceNumber'";
    if ($conn->query($sql) === TRUE) {
        //echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


$conn->close();
?>
