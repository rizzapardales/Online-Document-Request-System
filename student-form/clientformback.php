<?php
session_start();


$full_name = $_POST['fullname'];
$student_num = $_POST['student_num'];
$purpose = $_POST['purpose'];
$address = $_POST['address'];
$contact_num = $_POST['contact_number'];
$email = $_POST['email'];




// Connect to the database
$host = 'localhost:3306';
$username = 'root';
$password = '';
$database = 'request_docu';




$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}








$sql = "INSERT INTO tbl_request_client (full_name, student_num, purpose, address, contact_num, email) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sissis", $full_name, $student_num, $purpose, $address, $contact_num, $email);




if ($stmt->execute()) {
    $_SESSION['ref_num_cl'] = $stmt->insert_id;
    $_SESSION['name_cl'] = $full_name;
    header("Location: documentlist-client.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}




$stmt->close();
$conn->close();
?>


