
<?php
// Retrieve form data
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$extension_name = $_POST['extension_name'];
$contact_num = $_POST['contact_num'];
$email = $_POST['email'];
$address = $_POST['address'];
$password_input = $_POST['password_input'];
// $confirm_password = $_POST['confirm_password'];


// Connection to the database
$host = 'localhost:3306';
$username = 'root';
$password = '';
$database = 'login';


$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO tbl_registration_client (last_name, first_name, middle_name, extension_name, contact_num, email, address, password) VALUES ('$last_name', '$first_name', '$middle_name', '$extension_name', '$contact_num', '$email', '$address', '$password_input')";


if ($conn->query($sql) === TRUE) {
    header("Location: clientlogin.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>


