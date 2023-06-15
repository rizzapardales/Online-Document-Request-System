<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img class="logo" src="../img/pitlogo.png" alt="school logo">
        <div class="info1">
            <h3>POLYVERSE INSTITUTE OF TECHNOLOGY</h3>
        </div>
        
        <ul>
            <li><a href="#" class="active" id="link1">All</a></li>
            <li><a href="#" id="link2">Paid</a></li>
            <li><a href="#" id="link3">Unpaid</a></li>
            <li><a href="#" id="link4">Completed</a></li>
            <li><a class="logout" href="../index.php">Logout</a></li>
        </ul> 
       
    </div>

    <div class="main_content">
        <div class="header1" id="content1">
            <h2>All</h2>
            <h4> Here are all the students/clients who have requested documents. </h4>
            
         <!-- PHP code para mapalabas yung data sa web !-->
         <div class="summary-fetch">
            <?php
                $host = 'localhost:3306';
                $db = 'request_docu';
                $user = 'root';
                $password = '';


                $conn = new mysqli($host, $user, $password, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }


                if (isset($_GET['ref'])) {
                    $referenceNumber = $_GET['ref'];
                    $sql = "SELECT * FROM tbl_request_student WHERE reference_num = '$referenceNumber'";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        // Display the additional information
                        while ($row = $result->fetch_assoc()) {
                            // Display the additional information here based on your requirements
                            echo '<p>Fullname: ' . $row['full_name'] . '</p>';
                            echo '<p>Student Number: ' . $row['student_num'] . '</p>';
                            echo '<p>Course: ' . $row['course'] . '</p>';
                            echo '<p>College: ' . $row['college'] . '</p>';
                            echo '<p>Purpose: ' . $row['purpose'] . '</p>';
                            echo '<p>Address: ' . $row['address'] . '</p>';
                            echo '<p>Contact Number: ' . $row['contact_num'] . '</p>';
                            echo '<p>Email: ' . $row['email'] . '</p>';
                            echo '<p>Total: ' . $row['total_amount'] . '</p>';
                            echo '<p>Status: ' . $row['req_status'] . '</p>';
                            echo '<p>Payment Status: ' . $row['payment_status'] . '</p>';
                            echo '<p>Progress: ' . $row['progress_status'] . '</p>';
                            echo '<p>Claim Date: ' . $row['claim_date'] . '</p>';



                        }
                    } 
                } 


                $conn->close();
                ?>
            </div>

            <div class="summary-fetch1">
            <?php
                $host = 'localhost:3306';
                $db = 'request_docu';
                $user = 'root';
                $password = '';


                $conn = new mysqli($host, $user, $password, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }


                if (isset($_GET['ref'])) {
                    $referenceNumber = $_GET['ref'];
                    $sql = "SELECT * FROM tbl_request_client WHERE reference_num = '$referenceNumber'";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        // Display the additional information
                        while ($row = $result->fetch_assoc()) {
                            // Display the additional information here based on your requirements
                            echo '<p>Fullname: ' . $row['full_name'] . '</p>';
                            echo '<p>Student Number: ' . $row['student_num'] . '</p>';
                            echo '<p>Purpose: ' . $row['purpose'] . '</p>';
                            echo '<p>Address: ' . $row['address'] . '</p>';
                            echo '<p>Contact Number: ' . $row['contact_num'] . '</p>';
                            echo '<p>Email: ' . $row['email'] . '</p>';
                            echo '<p>Total: ' . $row['total_amount'] . '</p>';
                            echo '<p>Status: ' . $row['req_status'] . '</p>';
                            echo '<p>Payment Status: ' . $row['payment_status'] . '</p>';
                            echo '<p>Progress: ' . $row['progress_status'] . '</p>';
                            echo '<p>Claim Date: ' . $row['claim_date'] . '</p>';
                        }
                    } 
                } 


                $conn->close();
                ?>
            </div>

            <div class="documents">
            <?php
                $host = 'localhost:3306';
                $db = 'request_docu';
                $user = 'root';
                $password = '';

                $conn = new mysqli($host, $user, $password, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_GET['ref'])) {
                    $referenceNumber = $_GET['ref'];
                    $sql = "SELECT * FROM tbl_document_request WHERE for_refnum = '$referenceNumber'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Display the additional information
                        while ($row = $result->fetch_assoc()) {
                            // Fetch the document description
                            $documentId = $row['document_id'];
                            $documentSql = "SELECT description FROM tbl_document_list WHERE id = '$documentId'";
                            $documentResult = $conn->query($documentSql);
                            if ($documentResult->num_rows > 0) {
                                $documentRow = $documentResult->fetch_assoc();
                                $documentDescription = $documentRow['description'];

                                // Display the additional information with the document description
                                echo '<p>Document: ' . $documentDescription . '</p>';
                                echo '<p>Copies: ' . $row['num_copies'] . '</p>';
                                echo '<p>Amount: ' . $row['amount'] . '</p>';
                            }
                        }
                    }
                }

                $conn->close();
?>


            </div>

            <form method="POST" action="all.php?ref=<?php echo $_GET['ref']; ?>">
            <label for="status">Set Status</label>
            <br>
            <select name="status" id="status-select">
                <option value="Not Processed">Not Processed</option>
                <option value="Pending">Pending</option>
                <option value="Ready to Claim">Ready to Claim</option>
            </select>


            <br><br>
            <label for="date">Set Date of Claiming</label>
            <br>
            <input type="date" class="content" id="date" name="date" placeholder="MM/DD/YYYY">


            <br><br>
            <label for="progress">Set Progress</label>
            <br>
            <select name="progress" id="progress-select">
                <option value="Unclaimed">Unclaimed</option>
                <option value="Claimed">Claimed</option>
            </select>


            <br><br>
            <input type="submit" value="Update">
        </form>
            </div>
        </div>

        <div class="header1" id="content2">
            <h2>Paid</h2>
            <h4>Here are all the students/clients who have already paid for their requested documents. </h4> 
        </div> 

        <div class="header1" id="content3">
            <h2>Unpaid</h2>
            <h4>Here are all the students/clients who haven’t already paid for their requested documents.</h4> 
        </div> 

        <div class="header1" id="content4">
            <h2>Completed</h2>
            <h4>Here all the students/clients who have paid and claimed their requested documents.</h4> 
        </div> 

        
    </div>
</div>
<script src="admin.js"></script>
</body>
</html>