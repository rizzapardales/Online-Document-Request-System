<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="shortcut icon" href="../img/pitlogo.png" type="image/x-icon">
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
            <li><a href="#" id="link2">Completed</a></li>
            <li><a class="logout" href="../index.php">Logout</a></li>
        </ul> 
       
    </div>

    <div class="main_content">
        <div class="header1" id="content1">
            <h2>All</h2>
            <h4>Here are all the students/clients who have requested documents.</h4>
            
            <!-- PHP code to display data on the web -->
            <div class="ref-fetch">
                <?php
                $host = 'localhost:3306';
                $db = 'request_docu';
                $user = 'root';
                $password = '';

                $conn = new mysqli($host, $user, $password, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM tbl_request_student";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // echo '<a href="summary.php?ref=' . $row["reference_num"] . '"><div class="ref_num">' . $row["reference_num"] .  $row["full_name"]. $row['req_status'].'</div></a>';
                        echo '<a href="summary.php?ref=' . $row["reference_num"] . '"><div class="ref_num">' . $row["reference_num"] . '<br>' .  $row["full_name"]. '<br>' .$row['req_status'].'</div></a>';

                    }
                } else {
                    echo "No data available";
                }

                $conn->close();
                ?>
            </div>
            
            <div class="ref-fetch1">
                <?php
                $host = 'localhost:3306';
                $db = 'request_docu';
                $user = 'root';
                $password = '';

                $conn = new mysqli($host, $user, $password, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM tbl_request_client";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="summary.php?ref=' . $row["reference_num"] . '"><div class="ref_num">' . $row["reference_num"] . '<br>' .  $row["full_name"]. '<br>' .$row['req_status'].'</div></a>';
                    }
                } else {
                    echo "No data available";
                }

                $conn->close();
                ?>
            </div>
          
        </div>

        <div class="header1" id="content2">
            <h2>Completed</h2>
            <h4>Here are all the students/clients who have paid and claimed their requested documents.</h4> 
            <!-- PHP code to display completed requests -->
           

        <!-- COMPLETED -->
            <div class="ref-fetch">
                <?php
                $host = 'localhost:3306';
                $db = 'request_docu';
                $user = 'root';
                $password = '';

                $conn = new mysqli($host, $user, $password, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM tbl_request_student WHERE progress_status = 'Claimed'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="summary.php?ref=' . $row["reference_num"] . '"><div class="ref_num">' . $row["reference_num"] . '<br>' .  $row["full_name"]. '<br>' .$row['req_status'].'</div></a>';
                    }
                } else {
                    echo "No data available";
                }

                $conn->close();
                ?>
            </div>
            
            <div class="ref-fetch1">
                <?php
                $host = 'localhost:3306';
                $db = 'request_docu';
                $user = 'root';
                $password = '';

                $conn = new mysqli($host, $user, $password, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM tbl_request_client WHERE progress_status = 'Claimed'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="summary.php?ref=' . $row["reference_num"] . '"><div class="ref_num">' . $row["reference_num"] . '<br>' .  $row["full_name"]. '<br>' .$row['req_status'].'</div></a>';
                    }
                } 

                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>
<script src="admin.js"></script>
</body>
</html>
