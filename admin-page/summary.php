<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="admin8.css">
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
            <h2>Summary</h2>
            <h4>Here are all the summary of the requested documents of students/clients.</h4>


            <div class="summary">
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
                        echo '<div class="maincontent">';
                        echo '<p class="AppInfo">Applicants Information</p>';




                        echo '<div class="flex">';
                        echo '<p><strong>Fullname:</strong> ' . $row['full_name'] . '</p>';
                        echo '<div class="space"><p><strong>Student Number</strong>: ' . $row['student_num'] . '</p></div>';
                        echo '<div class="space"><p><strong>Course:</strong> ' . $row['course'] . '</p></div>';
                        echo '</div>';




                        echo '<div class="flex1">';
                        echo '<p><strong>College:</strong> ' . $row['college'] . '</p>';
                        echo '<div class="space1"><p><strong>Purpose:</strong> ' . $row['purpose'] . '</p></div>';
                        echo '</div>';
                       
                       
                        echo '<p class="Con">Contact Details</p>';




                        echo '<div class="flex2">';
                        echo '<p><strong>Contact Number:</strong> ' . $row['contact_num'] . '</p>';
                        echo '<div class="space2"><p><strong>Address:</strong> ' . $row['address'] . '</p></div>';
                        echo '<div class="space3"><p><strong>Email:</strong> ' . $row['email'] . '</p></div>';
                        echo '</div>';


                        echo '<div class="mainstatus">';
                        echo '<p class="Set">Set</p>';
                        echo '<div class="row-text"><p><strong>Status:</strong> ' . $row['req_status'] . '</p></div>';
                        echo '<div class="row-text"><p><strong>Payment Status:</strong> ' . $row['payment_status'] . '</p></div>';
                        echo '<div class="row-text"><p><strong>Progress:</strong> ' . $row['progress_status'] . '</p></div>';
                        echo '<div class="row-text"><p><strong>Claim Date:</strong> ' . $row['claim_date'] . '</p></div>';
                        echo '</div>';


                    }
                    echo '</div>';
                    }
                }
           


            if (isset($_GET['ref'])) {
                $referenceNumber = $_GET['ref'];
                $sql = "SELECT * FROM tbl_request_client WHERE reference_num = '$referenceNumber'";
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    // Display the additional information
                    while ($row = $result->fetch_assoc()) {
                        // Display the additional information here based on your requirements
                        echo '<div class="maincontent">';
                        echo '<p class="AppInfo">Applicants Information</p>';


                       
                        echo '<div class="flex3">';
                        echo '<p><strong>Fullname:</strong> ' . $row['full_name'] . '</p>';
                        echo '<div class="space"><p><strong>Student Number</strong>: ' . $row['student_num'] . '</p></div>';
                        echo '<div class="space1"><p><strong>Purpose:</strong> ' . $row['purpose'] . '</p></div>';
                        echo '</div>';




                       
                       
                        echo '<p class="Con">Contact Details</p>';




                       
                        echo '<div class="flex2">';
                        echo '<p><strong>Contact Number:</strong> ' . $row['contact_num'] . '</p>';
                        echo '<div class="space2"><p><strong>Address:</strong> ' . $row['address'] . '</p></div>';
                        echo '<div class="space3"><p><strong>Email:</strong> ' . $row['email'] . '</p></div>';
                        echo '</div>';


                        echo '<div class="mainstatus">';
                        echo '<p class="Set">Set</p>';
                        echo '<div class="row-text"><p><strong>Status:</strong> ' . $row['req_status'] . '</p></div>';
                        echo '<div class="row-text"><p><strong>Payment Status:</strong> ' . $row['payment_status'] . '</p></div>';
                        echo '<div class="row-text"><p><strong>Progress:</strong> ' . $row['progress_status'] . '</p></div>';
                        echo '<div class="row-text"><p><strong>Claim Date:</strong> ' . $row['claim_date'] . '</p></div>';
                        echo '</div>';




                    }
                    echo '</div>';
                    }
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
                        $documentSql = "SELECT description FROM tbl_document_list WHERE document_id = '$documentId'";
                        $documentResult = $conn->query($documentSql);
                        if ($documentResult->num_rows > 0) {
                            $documentRow = $documentResult->fetch_assoc();
                            $documentDescription = $documentRow['description'];


                            // Display the additional information with the document description
                            echo '<div class="Req">';
                                echo '<p class="text">Requested Documents</p>';
                                echo '<div class="pdocu">';
                                echo '<p><strong>Document:</strong> ' . $documentDescription . '</p>';
                                echo '<p><strong>Copies:</strong> ' . $row['num_copies'] . '</p>';
                                echo '<p><strong>Amount:</strong> ' . $row['amount'] . '</p>';
                                echo '<div class="space2"></div>';


                                echo '</div>';
                            echo '</div>';
                        }
                    }
                }
            }


            $conn->close();
        ?>
<?php
$imageHost = 'localhost:3306';
$imageDb = 'payment_info';
$imageUser = 'root';
$imagePassword = '';


$imageConn = new mysqli($imageHost, $imageUser, $imagePassword, $imageDb);
if ($imageConn->connect_error) {
    die("Image database connection failed: " . $imageConn->connect_error);
}


if (isset($_GET['ref'])) {
    $referenceNumber = $_GET['ref'];


    // Escape the reference number to prevent SQL injection
    $referenceNumber = $imageConn->real_escape_string($referenceNumber);


    $imageSql = "SELECT image FROM tbl_payment_info WHERE reference_num = '$referenceNumber'";
    $imageResult = $imageConn->query($imageSql);


    if ($imageResult) {
        if ($imageResult->num_rows > 0) {
            $imageRow = $imageResult->fetch_assoc();
            $imageData = $imageRow['image'];


            // Display the image
            // echo '<img class="receipt" src='.$imageData.' alt="img"/>';


            // echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Image" />';
        } else {
            echo "No image found for the provided reference number.";
        }
    } else {
        echo "Error executing the image query: " . $imageConn->error;
    }
}
$imageConn->close();
?>




            </div>


    <form method="POST" action="all.php?ref=<?php echo $_GET['ref']; ?>" style="display: flex; flex-direction: row;">




    <!-- Begin popup image code. -->
    <div id="pop-up-div" style="display:none; z-index:96; position:fixed; top:0px; right:0px; bottom:0px; left:0px; background-color:transparent;" onclick="CloseImagePopup('pop-up-div')">


    <!-- The div with the image. -->
    <div id="pop-up-image-div" style="position: relative; display: block; z-index: 97; width: auto; margin: 0px auto;">
        <!-- The image in the popup. -->
        <img id="pop-up-image" src="<?php echo $imageData ?>" style="z-index: 98; border: none; outline: none; margin-top: 0; width: 100%; height: auto;">
        <!-- Optional "close popup" icon -->
        <img src="//www.willmaster.com/images/closeboxXbold25.png" style="position:absolute; top:0; right:0; z-index:99; cursor:pointer;" onclick="CloseImagePopup('pop-up-div')">
    </div><!-- id="pop-up-image-div" -->


    </div><!-- id="pop-up-div" -->
    <!-- End of popup image code. -->




    <!-- Div for the image visible on page load. -->
<div style="position:relative; width:150px; cursor:pointer;" onclick="ShowImagePopup('pop-up-div','pop-up-image-div','pop-up-image','<?php echo $imageData?>')">


<!-- The image visible on page load. -->
<!-- <img src="<?php echo $imageData?>" style="width:100%; height:auto;" alt="Image for example"> -->


<!-- Optional magnifying glass div and image. -->
<div style="display:table; z-index:2; position:absolute; top:-0px; right:-0px; left:5px; cursor:pointer; font-weight:bold; text-decoration: underline; font-size:18px" onclick="ShowImagePopup('pop-up-div','pop-up-image-div','pop-up-image','<?php echo $imageData?>')">
    <p>View Receipt</p>
</div>


</div>
<!-- End of div for the image visible on page load. -->
    <div class="show">
        <div class="overlay"></div>
        <div class="img-show">
            <span>X</span>
            <img src="">
        </div>
    </div>

    
    <div style="margin-right: 120px; margin-top: 50px; margin-left: -150px">
        <label for="status">Set Status</label>
        <br>
        <select name="status" id="status-select" style="background-color:  #c17b12; color: #fff; ">
            <option value="Not Processed">Not Processed</option>
            <option value="Pending">Pending</option>
            <option value="Ready to Claim">Ready to Claim</option>
        </select>
    </div>




    <div style="margin-right: 120px; margin-top: 50px">
        <label for="date">Set Date of Claiming</label>
        <br>
        <input type="date" class="content" id="date" name="date" placeholder="MM/DD/YYYY" style="background-color:  #c17b12;; color: #fff; border:none">
    </div>




    <div style="margin-top: 50px">
        <label for="progress">Set Progress</label>
        <br>
        <select name="progress" id="progress-select" style="background-color: #c17b12; ; color: #fff;">
            <option value="Unclaimed">Unclaimed</option>
            <option value="Claimed">Claimed</option>
        </select>
    </div>




    <br><br>
    <div class="update">
        <a href="admin.php" class="backbtn">Back</a>
        <input class="up" type="submit" value="Update">
    </div>
</form>
        </div>


        <div class="header1" id="content2">
            <h2>Completed</h2>
            <h4>Here are all the students/clients who have paid and claimed their requested documents.</h4>
        </div>
    </div>
</div>
<script src="admin.js"></script>


<script type="text/javascript">
function CloseImagePopup(divid) { document.getElementById(divid).style.display = "none"; }
function ShowImagePopup(dividname,imgdividname,imgidname,imgurl)
{
   var imgid = document.getElementById(imgidname);
   var divid = document.getElementById(dividname);
   var imgdivid = document.getElementById(imgdividname);
   imgid.src = imgurl;
   var vpheight = 0;
   if(document.documentElement && document.documentElement.clientHeight) { vpheight = document.documentElement.clientHeight; }
   else if(document.body) { vpheight = document.body.clientHeight; }
   else if(self.innerWidth) { vpheight = self.innerHeight; }
   if( ! vpheight ) { return; }
   var imgwidth = parseInt(imgid.naturalWidth);
   if( ! imgwidth ) { return; }
   var imgheight = parseInt(imgid.naturalHeight);
   imgdivid.style.maxWidth = imgwidth + "px";
   imgdivid.style.maxHeight = imgheight + "px";
   imgdivid.style.marginTop = parseInt((vpheight/2)-(imgheight/2)) + "px";
   divid.style.display = "block";
   var scrollHeight = imgdivid.scrollHeight;
   if( scrollHeight > vpheight )
   {
      scrollHeight = vpheight;
      imgid.style.height = vpheight + "px";
      imgdivid.style.width = parseInt(vpheight*(imgwidth/imgheight)) + "px";
   }
   imgdivid.style.marginTop = parseInt((vpheight/2)-(scrollHeight/2)) + "px";
} // function ShowImagePopup()
</script>


</body>
</html>


