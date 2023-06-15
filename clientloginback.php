<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];


// Connect to the database
$host = 'localhost:3306';
$username = 'root';
$db_password = '';
$database = 'login';


$conn = new mysqli($host, $username, $db_password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "SELECT * FROM tbl_registration_client WHERE email = '$email' AND password = '$password'";
$result = $conn->query($query);


if ($result !== false && $result->num_rows === 1) {
    $_SESSION['email'] = $email;
    $_SESSION['statuslog'] = "success";
   
    header("Location: landing-page/homeclient.html");
    exit();
} elseif (empty($email && $password)) {
    $_SESSION['statuslog'] = "empty";
    header("Location: clientlogin.php");
}
else {
    $_SESSION['statuslog'] = "failed";
    // $_SESSION['message'] = "Invalid student number or password!";
    header("Location: clientlogin.php");
}


$conn->close();
?>
