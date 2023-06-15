<?php
    session_start();
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $status1 = isset($_SESSION['status']) ? $_SESSION['status'] : '';
    // echo $_SESSION['status'];
    $ref2 = isset($_SESSION['reference']) ? $_SESSION['reference'] : '';
    $receipt2 = isset($_SESSION['receipt']) ? $_SESSION['receipt'] : '';
    $dop2 = isset($_SESSION['dop']) ? $_SESSION['dop'] : '';
    $amount2 = isset($_SESSION['amount']) ? $_SESSION['amount'] : '';


    echo "<p id=status>" . $status1 . "</p>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/pitlogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="stat4.css">
    <title>Status</title>
</head>
<body>
    <?php include 'headerdash_cl.php' ?>
    <input type="hidden" value="<?php echo isset($status) ? $status : '' ?>">


    <input type="hidden" id="doc_status" value="<?php echo isset($docstatus) ? $docstatus : '' ?>">


    <input class="slide" type="radio" id="tap1" name="tap" checked>
    <input class= "slide" type="radio" id="tap2" name="tap">
    <nav class="nav-slider">
        <ol>
            <li><label for ="tap1"><a id="link1">Payment Info</a></label></li>
            <li><label for ="tap2"><a class="track" id="link2">Tracking</a></label></li>
            <div class="slider"></div>
        </ol>
   </nav>


   <div class="container">
        <div class="content2" id="content2">
            <!-- FORM FOR STATUS CHECK -->
            <form name="tracksearch" action="" method="post">
                <p>Reference Number</p>
                <input type="text" class="track-input" id="reference_num" name="reference_num" required data-input>
                <input class="track-search" type="submit" value="Search" id="search-status" onsubmit="">
            </form>


            <div class="maindocu">
                <h1>Document Status:</h1>
                <?php
                if (isset($_POST['reference_num'])) {
                    $servername = "localhost:3306";
                    $username = "root";
                    $password = "";
                    $dbname = "request_docu";


                    $refNum = $_POST['reference_num'];


                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);




                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }  



                    // Query the database to get the progress of the reference number
                    $sql = "SELECT * FROM tbl_request_client WHERE reference_num = '$refNum'";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        // header("Location: status.php");
                        $row = $result->fetch_assoc();
                        $progress = $row["req_status"];
                        $claimdate = $row["claim_date"];


                        // $docstatus = $_SESSION['doc_status'] = $progress;
                        // echo "$progress";
                    } else {
                        echo "No record found for Reference Number $refNum";
                    }


                   
                    $conn->close();
                }
                ?>


                <div id="status-box">
                    <div id="circle"></div>
                    <p id="doc-status"><?php echo isset($progress) ? $progress : '' ?></p>
                </div>


            </div>
            <p id="not-processed" style="display: none;">Your documents have not been processed yet. Please pay at the PIT cashier in order to process your requested document(s).</p>
            <p id="pending">Your document(s) are now being processed. Please wait for the release of the date of claiming.</p>
            <p id="ready-claim">You may now claim your requested document(s) on <span> <?php echo isset($claimdate) ? $claimdate : '' ?></span> on wards. Please go to the PIT Registrar and present your Claim Stub with the Official Receipt.</p>


            <div class="info">
                <h3>For more inquiries or concerns, please email <span>ithelp@pit.edu.ph</span></h3>
            </div>
        </div>


        <div class="content1" id="content1">


            <!-- FORM FOR SUBMITTING PAYMENT INFO -->
            <form class="form" action="status_progress_cl.php" method="POST" enctype="multipart/form-data">
                <div class="form-contents">
                    <aside>
                        <p>Reference Number</p>
                        <input type="text" class="content" id="reference_num" name="reference_num" data-input>
                   
                        <p>Official Receipt Number</p>
                        <input type="number" class="content" id="receipt_num" name="receipt_num" data-input>


                        <p>Amount Paid</p>
                        <input type="number" class="content" id="amount_paid" name="amount_paid" data-input>
                   
                    </aside>
               
                    <aside>
                        <p>Date</p>
                        <input type="date" class="content" id="date" name="date" placeholder="MM/DD/YYYY">
                        <p>Proof of Receipt</p>
                        <label class="receipt-label" for="image"><i class="fa-solid fa-file-arrow-up"></i> Upload Receipt</label>
                        <input type="file" class="content" accept="image/*" id="image" name="image" data-input>
                    </aside>
                </div>
               
                <div>
                    <input type="submit" value="Submit" class="btn" id="submit-btn">
                </div>


            </form>


            <!-- FORM FOR POPUP THAT GENERATES PHP -->
            <form class="form" action="generate_cl.php" method="POST">
                    <input type="text"  id="refnum" name="refnum"  value="<?php echo isset($ref2) ? $ref2 : '' ?>" hidden>
                    <input type="number"  id="receipt" name="receipt"  value="<?php echo isset($receipt2) ? $receipt2 : '' ?>" hidden>
                    <input type="number" id="amount" name="amount" value="<?php echo isset($amount2) ? $amount2 : '' ?>" hidden>
                    <input type="date" id="date" name="date" placeholder="MM/DD/YYYY" value="<?php echo isset($dop2) ? $dop2 : ''?>" hidden>


                    <div class="popup" id="popup">
                        <img src="../img/check.png" alt="">
                        <h2>Payment Complete</h2>
                        <p>Expect your status to be updated within 5-10 business days.


                        Download and present the claim stub with the Official Receipt when claiming the requested document/s.</p>
                        <p class="bold-text">Claim Stub: <button id="generate-pdf" type="submit" name="create" value="Generate PDF.pdf">Download</button></p>
                        <button id="close-popup-btn" type="button" onclick="closePopup()">OK</button>
                    </div>
            </form>


            <!-- ERROR HANDLER POPUP -->
           
            <div class="popup" id="error-popup">
                        <img class="error-popup-img" src="../img/error.png" alt="">
                        <h2>Not Found!</h2>
                        <p>Please input valid reference number.</p>
                        <button id="close-popup-btn" type="button" onclick="closeErrorPopup()">OK</button>
            </div>
        </div>
     </div>
   </div>
   <script>
        const statusBox = document.getElementById('status-box');
        const statusIndicator = document.getElementById('circle');
        const statusText = document.getElementById('doc-status');


        const notprocessedText = document.getElementById('not-processed');
        const pendingText = document.getElementById('pending');
        const readyClaimText =document.getElementById('ready-claim');


        // window.addEventListener('DOMContentLoaded' () => {
        //     if (statusText.textContent === '') {
        //         alert('Empty');
        //         statusBox.style.visibility = 'hidden';
        //     } else {
        //         statusBox.style.visibility = 'visible';
        //     }
        // });


        if (statusText.textContent === 'Ready to Claim') {
            statusIndicator.style.backgroundColor = '#008000';
            readyClaimText.style.display = 'block';
        } else
        if (statusText.textContent === 'Pending') {
            statusIndicator.style.backgroundColor = '#E5900F';
            pendingText.style.display = 'block';
        } else
        if (statusText.textContent === 'Not Processed') {
            statusIndicator.style.backgroundColor = '#909090';
            notprocessedText.style.display = 'block';
        }
    </script>
   <script>
            let popup = document.getElementById("popup");
            let errorPopup =document.getElementById("error-popup");
            let status = document.getElementById('status');


            function openPopup() {
                popup.classList.add("open-popup");
            }
   
            function closePopup() {
                popup.classList.remove("open-popup");
                location.href="../landing-page/home.php";
            }


            function openErrorPopup() {
                errorPopup.classList.add("open-popup");
            }
           
            function closeErrorPopup() {
                errorPopup.classList.remove("open-popup");
            }


        document.addEventListener('DOMContentLoaded', ()=> {
            if (status.textContent === 'success') {
                status.style.display = 'none';
                popup.classList.add("open-popup");
                openPopup();
                popup.classList.add('animate__animated', 'animate__fadeInUp');
            } else if (status.textContent === 'failed') {
                status.style.display = 'none';
                openErrorPopup();
                errorPopup.classList.add('animate__animated', 'animate__fadeInUp');
            }
        })
        <?php unset($_SESSION['status']); ?>
    </script>
    <script>


        const inputs = document.querySelectorAll('[data-input]');
        const submitBtn = document.getElementById('submit-btn');


        document.addEventListener('DOMContentLoaded', () => {
            inputs.forEach((e) => {
                if(e.value === '') {
                    submitBtn.setAttribute('disabled', '');
                } else {
                    submitBtn.removeAttribute('disabled');
                }
                })
            function handleEmptyInput() {
                inputs.forEach((e) => {
                if(e.value === '') {
                    submitBtn.setAttribute('disabled', '');
                } else {
                    submitBtn.removeAttribute('disabled');
                }
                })
            }
            inputs.forEach((e) => {
            e.addEventListener('input', handleEmptyInput);
        })
        })
       
        // window.addEventListener('DOMContentLoaded', handleEmptyInput);
        function submitForm(e) {
            e.preventDefault();


            var myform = document.getElementById("myform");


            var formData = new FormData(myform);


            fetch("https://show.ratufa.io/json", {
                method: "POST",
                body: formData,
            })
                .then((response) => {
                if (!response.ok) {
                    throw new Error("network returns error");
                }
                return response.json();
                })
                .then((resp) => {
                // let respdiv = document.createElement("pre");
                // respdiv.innerHTML = JSON.stringify(resp, null, 2);
                // myform.replaceWith(respdiv);
                console.log("resp from server ", resp);
                })
                .catch((error) => {
                // Handle error
                console.log("error ", error);
                });
        }
       
        var myform = document.getElementById("myform");




        // myform.addEventListener("submit", submitForm);
    </script>
   <script src="status.js"></script>
</body>
</html>

