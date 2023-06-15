<?php
$host = 'localhost';
$db2 = 'payment_info'; // Database containing the image
$user = 'root';
$password = '';

// Connect to the database containing the image
$conn2 = new mysqli($host, $user, $password, $db2);
if ($conn2->connect_error) {
    die("Connection to database 2 failed: " . $conn2->connect_error);
}

if (isset($_GET['ref'])) {
    $referenceNumber = $_GET['ref'];
    $sql = "SELECT image FROM tbl_payment_info WHERE reference_num = '$referenceNumber'";
    $result = $conn2->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imageData = $row['image'];

        // Set the appropriate header for the image
        header("Content-type: image/jpg");

        // Output the image data
        echo $imageData;
    } else {
        echo "Image not found.";
    }
}

// Close the database connection
$conn2->close();
?>
