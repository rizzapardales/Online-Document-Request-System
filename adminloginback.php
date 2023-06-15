<?php
session_start();
$employee_num = $_POST['employee_num'];
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


$query = "SELECT * FROM tbl_adminlog WHERE employee_num = '$employee_num' AND password = '$password'";
$result = $conn->query($query);


if ($result !== false && $result->num_rows === 1) {
    $_SESSION['employee_num'] = $employee_num;
    $_SESSION['statuslog'] = "success";
   
    header("Location: admin-page/admin.php");
    exit();
} elseif (empty($employee_num && $password)) {
    $_SESSION['statuslog'] = "empty";
    header("Location: adminlogin.php");


}
else {
    $_SESSION['statuslog'] = "failed";
    // $_SESSION['message'] = "Invalid student number or password!";
    header("Location: adminlogin.php");
}


$conn->close();
?>
