<?php
session_start();
$student_num = $_POST['student_num'];
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


$query = "SELECT * FROM tbl_studentlog WHERE student_num = '$student_num' AND password = '$password'";
$result = $conn->query($query);


if ($result !== false && $result->num_rows === 1) {
    $_SESSION['student_num'] = $student_num;
    $_SESSION['statuslog'] = "success";
   
    header("Location: landing-page/home.html");
    exit();
} elseif (empty($student_num && $password)) {
    $_SESSION['statuslog'] = "empty";
    header("Location: studentlogin.php");


}
else {
    $_SESSION['statuslog'] = "failed";
    // $_SESSION['message'] = "Invalid student number or password!";
    header("Location: studentlogin.php");
}


$conn->close();
?>
