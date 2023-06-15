<?php
session_start();

$statuslog = isset($_SESSION['statuslog']) ? $_SESSION['statuslog'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Log In</title>
    <link rel="stylesheet" href="inlog3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="img/pitlogo.png" type="image/x-icon">
</head>
<body>
<input type="hidden" id="statuslog" value="<?php echo $statuslog ?>">
    <div class="container">
    <div class="big_logo">
        <div class="info1">
            <h3>Weclome <span>Admin! </span> You have reached the <span> <br> Polyverse Institute of Technology</span>, Admin Page</h3>
        </div>
        <img src="img/pitlogo.png" alt="school logo">
    </div>

    <div class="login-container1">
        <div class="login">
            <h1>Admin Log<span>in</span></h1>
            <form class="form" method="post" action="adminloginback.php">
                <div class="input-field">
                    <label for="employee_num">Employee Number</label>
                    <input class="content" type="text" id="employee_num" name="employee_num" placeholder="Enter Employee Number">    
                </div>
               
                <div class="input-field">
                    <label for="password">Password</label>
                    <input class="content" type="password" id="pass_input" name="password" placeholder="Enter Password">
                    <i class="fa-solid fa-eye" id="togglePassword1" style="margin-left:350px;cursor: pointer;"></i>
                </div>

                <span class="btn-container">
                    <input class="btn1" type="submit" value="Login">
                </span>
            </form>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword1');
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
            let popup = document.getElementById("error-popup");
            function openPopup() {
                popup.classList.add("open-popup");
            }
   
            function closePopup() {
                popup.classList.remove("open-popup");
            }
    </script>


    <!-- Include the SweetAlert library in the HTML head section -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>


    <script type="text/javascript">
        // Check the status in the session and display the appropriate popup
        const statuslog = document.getElementById('statuslog');


        if (statuslog.value == 'failed') {
            // openPopup();
            swal("Oops", "Incorrect user or password!", "error");
        } else if (statuslog.value == 'empty') {
            swal("Error", "Please input user or password", "warning");
        }


        // Clear the session variables related to the status
        <?php unset($_SESSION['statuslog']); ?>
    </script>




    <script>
        const userInput = document.getElementById('employee_num');
        const passInput = document.getElementById('pass_input');


    </script>

</body>
</html>