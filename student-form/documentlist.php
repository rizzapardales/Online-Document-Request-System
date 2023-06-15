<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "request_docu");
$ref_num = $_SESSION['ref_num'];
$name = $_SESSION['name'];
$query_run = null;


if(isset($_POST['save_multiple_checkbox'])) {
    $documents = isset($_POST['documents']) ? $_POST['documents'] : array();
    $numcopies = isset($_POST['numcopies']) ? $_POST['numcopies'] : array();
    $amount = isset($_POST['amount']) ? $_POST['amount'] : array();
    $total = isset($_POST['total_amount']) ? $_POST['total_amount'] : '';


    if (is_array($documents)) {
        foreach ($documents as $key => $document) {
            $numcopy = isset($numcopies[$key]) ? $numcopies[$key] : 0;
            $amountValue = isset($amount[$key]) ? $amount[$key] : 0;


            $query = "INSERT INTO tbl_document_request (for_refnum, document_id, num_copies, amount) VALUES ('$ref_num', '$document', '$numcopy', '$amountValue')";
            $query_run = mysqli_query($con, $query);
        }
    }


    if($query_run){
        $status = $_SESSION['status'] = "success";
    } else {
        $status = $_SESSION['status'] = "failed";
    }
}


if(isset($_POST['total_amount'])) {
    $total = $_POST['total_amount'];


    $query2 = "UPDATE tbl_request_student SET total_amount = '$total' WHERE reference_num = '$ref_num'";
    $query_run2 = mysqli_query($con, $query2);


    if($query_run2){
        // $_SESSION['status'] = "Updated Successfully";
    }
}
?>




<?php unset($_SESSION['status']); ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/pitlogo.png" type="image/x-icon">
    <title>Document List</title>
    <link rel="stylesheet" href="document-style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
    <input type="hidden" id="status" value="<?php echo isset($status) ? $status : '' ?>">
    <main>
        <div class="document-container">
            <div class="header-container">
                Document List
            </div>        
            <div class="documentform">
                <form action="../landing-page/generateref.php" method="POST">
                    <input type="text" value="<?php echo $ref_num ?>" name="ref" id="ref" hidden>
                    <input type="text" value="<?php echo $name ?>" name="name" id="name" hidden>
                    <input type="text" value="<?php echo $total ?>" name="total" id="total" hidden>


                    <div class="popup-container">
                        <div class="popup" id="popup">
                            <img src="../img/robnote.png" alt="">
                            <h2>Request Complete</h2>
                            <p>Thank you for completing your document request form. You can now go to the PIT Cashier to pay for your requested documents. Please save the reference number below.</p>
                            <p class="bold-text">Reference Number: <?php echo $ref_num ?> </p>




                            <button id="close-popup-btn" type="button" onclick="closePopup()">OK</button>
                            <button id="generate-pdf" type="submit" name="create" value="Generate PDF.pdf">Save</button>
                        </div>
                    </div>
                </form>
                <form action="" method="post" id="myform">
                    <div class="container">
                        <div class="popup" id="error-popup">
                            
                            <h2>Please put documents</h2>
                            <p>Check the documents you want and set the number of copies</p>
                           
                            <button type="button" name="save_multiple_checkbox" onclick="closePopup()">OK</button>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td style="width:40%">Request for:</td>
                                <td style="width:20%">Price</td>
                                <td style="width:20%">No. of copies</td>
                                <td style="width:20%">Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="input-flex1">
                                    <input type="checkbox" name="documents[0]" value="1" data-checkbox> Diploma <br>
                                    </div>
                                </td>
                                <td>550 pesos</td>
                                <td>
                                    <div class="input-field">
                                        <div class="input-flex">
                                        <input type="number" name="numcopies[0]" class="content" id="diploma_copies" value="0" min="0" max="2" onchange="calculateAmount()" data-input disabled>








                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="amount[0]" class="content1" id="diploma_amount" value="0">
   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-flex1">
                                        <input type="checkbox" name="documents[1]" value="2" data-checkbox> Transcript of Records <br>
                                    </div>
                                </td>
                                <td>241 pesos</td>
                                <td>
                                    <div class="input-field">
                                        <div class="input-flex">
                                        <input type="number" name="numcopies[1]" class="content" id="tor_copies" value="0" min="0" max="2" onchange="calculateAmount()" data-input disabled>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="amount[1]"  class="content1" id="tor_amount" value="0" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-flex1">
                                        <input type="checkbox" name="documents[2]" value="3" data-checkbox> Honorable Dismissal <br>
                                    </div>
                                </td>
                                <td>146 pesos</td>
                                <td>
                                    <div class="input-field">
                                        <div class="input-flex">
                                        <input type="number" name="numcopies[2]" class="content" id="honorable_copies" value="0" min="0" max="2" onchange="calculateAmount()" data-input disabled>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="amount[2]" class="content1" id="honorable_amount" value="0" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-flex1">
                                        <input type="checkbox" name="documents[3]" value="4" data-checkbox> Certification of Grades <br>
                                    </div>
                                </td>
                                <td>146 pesos</td>
                                <td>
                                    <div class="input-field">
                                        <div class="input-flex">
                                        <input type="number" name="numcopies[3]" class="content" id="grades_copies" value="0" min="0" max="2" onchange="calculateAmount()" data-input disabled>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="amount[3]" class="content1" id="grades_amount" value="0" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-flex1">
                                        <input type="checkbox" name="documents[4]" value="5" data-checkbox> Certification of Graduation <br>
                                    </div>
                                </td>
                                <td>146 pesos</td>
                                <td>
                                    <div class="input-field">
                                        <div class="input-flex">
                                        <input type="number" name="numcopies[4]" class="content" id="grad_copies" value="0" min="0" max="2" onchange="calculateAmount()" data-input disabled>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="amount[4]" class="content1" id="grad_amount" value="0" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-flex1">
                                        <input type="checkbox" name="documents[5]" value="6" data-checkbox> Certification of Units Earned <br>  
                                    </div>
                                </td>
                                <td>146 pesos</td>
                                <td>
                                    <div class="input-field">
                                        <div class="input-flex">
                                        <input type="number" name="numcopies[5]" class="content" id="units_copies" value="0" min="0" max="2" onchange="calculateAmount()" data-input disabled>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="amount[5]" class="content1" id="units_amount" value="0" >
   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-flex1">
                                        <input type="checkbox" name="documents[6]" value="7" data-checkbox> Certification of Enrollment <br>  
                                    </div>
                                </td>
                                <td>146 pesos</td>
                                <td>
                                    <div class="input-field">
                                        <div class="input-flex">
                                        <input type="number" name="numcopies[6]" class="content" id="enrollment_copies" value="0" min="0" max="2" onchange="calculateAmount()" data-input disabled>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="amount[6]" class="content1" id="enrollment_amount" value="0" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-flex1">
                                        <input type="checkbox" name="documents[7]" value="8" data-checkbox> DFA/CHED authentication of Student's Record <br>    
                                    </div>
                                </td>
                                <td>584 pesos</td>
                                <td>
                                    <div class="input-field">
                                        <div class="input-flex">
                                        <input type="number" name="numcopies[7]" class="content" name="ched_copies" id="ched_copies" value="0" min="0" max="2" onchange="calculateAmount()" data-input disabled>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="amount[7]" class="content1" id="ched_amount" value="0" >
                                </td>
                            </tr>
                           
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="input-field">
                                        <div class="input-flex">
                                            <label for="total_amount">Total:</label>
                                            <input type="number" class="content1" id="total_amount" name="total_amount" value="0">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>    








                    <div class="button">
                        <a href="studentform.html" class="backbtn">Back</a>
                        <button class="submit-btn" type="submit" name="save_multiple_checkbox">Submit</button>
                    </div>
                   
                </form>
               
                <div class="note">
                    <p>If the document/s you wish to request are not <br>listed above, kindly contact the registrar at <br><span>registrar@pit.edu.ph</span> for further assistance.</p>
                </div>
            </div>
        </div>
    </main>




   
    <script>
            // let closeBtn = document.getElementById('close-popup-btn');
            // closeBtn.addEventListener('click', () => {
            //     closePopup();
            //     location.href="../landing-page/home.php";
            // })
           
            let popup = document.getElementById("popup");
            let errorPopup =document.getElementById("error-popup");




            function openPopup() {
                popup.classList.add("open-popup");
            }
   
            function closePopup() {
                popup.classList.remove("open-popup");
                location.href="../student-form/documentlist.php";
            }




            function openErrorPopup() {
                errorPopup.classList.add("open-popup");
            }




        document.addEventListener('DOMContentLoaded', ()=> {
            const status = document.getElementById('status');
           
            if (status.value === 'success') {
                popup.classList.add("open-popup");
                // openPopup();
                popup.classList.add('animate__animated', 'animate__fadeInUp');
            } else if (status.value === 'failed') {
                // openErrorPopup();
                errorPopup.classList.add("open-popup");
                errorPopup.classList.add('animate__animated', 'animate__fadeInUp');
            }
        })
        <?php unset($_SESSION['status']); ?>
    </script>




    <script>
        // Get the checkbox and amount input elements
        const checkboxes = document.querySelectorAll('[data-checkbox]');
        const amountInputs = document.querySelectorAll('[data-input]');








        // Add event listeners to all checkboxes
        checkboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', function() {
            amountInputs[index].disabled = !checkbox.checked;
            if (!checkbox.checked) {
            amountInputs[index].value = "0";
            }
        });
        });
    function calculateAmount() {
      var diploma_price = 550;
      var tor_price = 241;
      var honorable_price = 146;
      var grades_price = 146;
      var grad_price = 146;
      var units_price = 146;
      var enrollment_price = 146;
      var ched_price = 584;
     








      var diploma_copies = parseInt(document.getElementById("diploma_copies").value);
      var tor_copies = parseInt(document.getElementById("tor_copies").value);
      var honorable_copies = parseInt(document.getElementById("honorable_copies").value);
      var grades_copies = parseInt(document.getElementById("grades_copies").value);
      var grad_copies = parseInt(document.getElementById("grad_copies").value);
      var units_copies = parseInt(document.getElementById("units_copies").value);
      var enrollment_copies = parseInt(document.getElementById("enrollment_copies").value);
      var ched_copies = parseInt(document.getElementById("ched_copies").value);








      var diploma_amount = diploma_price * diploma_copies;
      var tor_amount = tor_price * tor_copies;
      var honorable_amount = honorable_price * honorable_copies;
      var grades_amount = grades_price * grades_copies;
      var grad_amount = grad_price * grad_copies;
      var units_amount = units_price * units_copies;
      var enrollment_amount = enrollment_price * enrollment_copies;
      var ched_amount = ched_price * ched_copies;








      var total_amount = diploma_amount + tor_amount + honorable_amount + grades_amount + grad_amount + units_amount + enrollment_amount + ched_amount;








      document.getElementById("diploma_amount").value = diploma_amount;
      document.getElementById("tor_amount").value = tor_amount;
      document.getElementById("honorable_amount").value = honorable_amount;
      document.getElementById("grades_amount").value = grades_amount;
      document.getElementById("grad_amount").value = grad_amount;
      document.getElementById("units_amount").value = units_amount;
      document.getElementById("enrollment_amount").value = enrollment_amount;
      document.getElementById("ched_amount").value = ched_amount;
      document.getElementById("total_amount").value = total_amount;
    }
    </script>
</body>
</html>
