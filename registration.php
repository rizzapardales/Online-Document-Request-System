<?php
session_start();

$status = isset($_SESSION['status']) ? $_SESSION['status'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration-style1.css">
    <link rel="shortcust icon" href="img/pitlogo.pngy" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Create New Account</title>
</head>
<body>
    <main>
        <div class="form-container">
            <div class="header-container">
                Registration Form
            </div>
            <div class="contents">
                <div class="form">
                    <form action="registrationbackend.php" method="post" id="regform">
                        <h1>Applicant's Information</h1>
                        <div class="input-field">
                            <span class="input-flex">
                                <label for="last-name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" required>
                            </span>

                            <span class="input-flex">
                                <label for="first-name">First Name</label>
                                <input type="text" id="first_name" name="first_name" required>
                            </span>
     
                        </div>

                        <div class="input-field">
                            <span class="input-flex">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" id="middle_name" name="middle_name">  
                            </span>
                           
                            <span class="input-flex">
                                <label for="ext-name">Extension Name</label>
                                <input type="text" id="extension_name" name="extension_name">
                            </span>
                        </div>
   
                        <div class="input-field">
                            <span class="input-flex">
                                <label for="contact-num">Contact Number</label>
                                <input type="number" id="contact_num" name="contact_num" required>
                            </span>
                           
                            <span class="input-flex">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" required>
                            </span>
                        </div>

                        <h1>Account Details</h1>

                        <div class="input-field">
                            <span class="input-flex">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" required>
                            </span>

                            <span class="input-flex">
                                <label for="password">Password</label>
                                <input type="password" id="pw-input1" name="password_input" required>
                                <i class="fa-solid fa-eye" id="togglePassword" style="margin-left:150px;cursor: pointer;"></i>
                            </span>
                        </div>

                        <div class="input-field">
                            <span class="input-flex">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" id="pw-input2" name="confirm_password" required>
                            </span>
                           
                        </div>


                        <span class="button-container">
                            <input id="back-btn" type="button" value="Back" onclick="location.href='clientlogin.php'">
                            <input id="submit-btn" type="button" value="Register" onclick="openConfirmPopup()" required>
                        </span>


                        <div class="container">
                            <div class="popup" id="confirm-popup">
                                <img src="../img/robnote.png" alt="">
                                <h2>Oops</h2>
                                <p>Are you sure you the information are correct?</p>
                                <input type="submit" id="confirm-btn" name="save_multiple_checkbox" value="Yes" onclick="closeConfirmPopup()">
                                <input type="button" value="No" onclick="closeConfirmPopup()">
                            </div>
                        </div>




                    </form>
                </div>
                <aside class="privacy">
                    <h1>DATA PRIVACY NOTICE</h1>
                    <p class="statement">We value and protect your personal information in compliance with the Data Privacy Act of 2012 (RA 10173). All data will be kept secure and confidential by the Polyverse Institute of Technology only. The information will serve as a reference for communication. Any personal information will not be disclosed without your consent.</p>
   
                    <form class="data-privacy-form" action="">
                        <div class="checkbox">
                            <input type="radio" name="terms" id="accept" data-terms>
                            <p>I hereby acknowledge that I have read, and <span class="coloredtext">do accept</span> the Data Privacy Policy contained in this form.</p>
                        </div>
   
                        <div class="checkbox">
                            <input type="radio" name="terms" id="decline" data-terms>
                            <p>I hereby acknowledge that I have read, and <span class="coloredtext">do not accept</span> the Data Privacy Policy contained in this form.</p>
                        </div>
   
                    </form>
                </aside>
            </div>


            <div class="container">
                <div class="popup" id="popup">
                    <img src="../img/robnote.png" alt="">
                    <h2>Oops</h2>
                    <p>Password does not match!</p>
                    <button type="submit" name="save_multiple_checkbox" onclick="closePopup()">OK</button>
                </div>
            </div>
        </div>
    </main>

    
    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwords = document.querySelectorAll('input[type="password"]'); // Select all password inputs


    togglePassword.addEventListener('click', function (e) {
        // Toggle the type attribute for each password input
        passwords.forEach(password => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });


        // Toggle the eye slash icon
        togglePassword.classList.toggle('fa-eye-slash');
    });
</script>
    


    <script>
        let popup = document.getElementById("popup");
        let confirmPopup = document.getElementById("confirm-popup");


        function openPopup() {
            popup.classList.add("open-popup");
        }


        function closePopup() {
            popup.classList.remove("open-popup");
        }


        function openConfirmPopup() {
            confirmPopup.classList.add("open-popup");
        }


        function closeConfirmPopup() {
            confirmPopup.classList.remove("open-popup");
        }


        let privacyTerms = document.getElementById('accept');
        let termsInput = document.querySelectorAll('[data-terms]');
        let declineTerms = document.getElementById('decline');
        let regForm = document.getElementById('regform');




        document.addEventListener('DOMContentLoaded', () => {
            let passInput1 = document.getElementById("pw-input1");
            let passInput2 = document.getElementById("pw-input2");
            let registerBtn = document.getElementById("submit-btn");




            function handleEmptyInput() {
                if (passInput1.value === '' || passInput2.value === '' || !privacyTerms.checked) {
                    registerBtn.setAttribute('disabled', '');
                }   else {
                    registerBtn.removeAttribute('disabled');
                }
            }




            function handlePasswordInput() {
                if ((passInput1.value === '') && (passInput2.value === '') || !privacyTerms.checked) {
                    registerBtn.setAttribute('disabled', '');
                } else {
                    registerBtn.removeAttribute('disabled');
                }
            }


            function handPasswordUnmatched() {
                if (passInput1.value !== passInput2.value){
                    openPopup();
                    closeConfirmPopup()
                    regForm.preventDefault();
                }
                else {
                    return true;
                    registerBtn.removeAttribute('disabled');
                }
            }


            function handleWeakPassword() {
                if (passInput1.value.length < 8) {
                    registerBtn.setAttribute('disabled', '');
                    closeConfirmPopup()
                    alert('The minimum password length should be 8!');
                } else {
                    registerBtn.removeAttribute('disabled');
                }
            }




            window.addEventListener('DOMContentLoaded', handleEmptyInput);
            passInput1.addEventListener('input', handlePasswordInput);
            passInput2.addEventListener('input', handlePasswordInput);


            privacyTerms.addEventListener('input', handlePasswordInput);




            termsInput.forEach((e) => {
            e.addEventListener('input', handlePasswordInput);
            });


            registerBtn.addEventListener('click', handleWeakPassword);
            registerBtn.addEventListener('click', handPasswordUnmatched);


        });
    </script>




</body>
</html>


