<?php

require 'config/config.php';
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Thank you for visiting up on USAgram! We hope you had a lovely time and will visit back soon! You've been successfully logged out.">
    <title>Logged Out</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>


<body class="login-body">

    <?php include 'required/nav.php'; ?>

    <div class="container cust-container">

            <div class="text-syccess">
                Successfully logged out. Click <a href="#" onclick="redirectHome(); return false;"> here </a> to redirect home or wait 5 seconds.</div>
       
    </div>


    <div id="footer" class="container-fluid">
        <div class="row">
            <div id="footer-text" class="col-12 text-center">
                © 2023 Alejandro Martinez
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/login.js"></script>
    <script>
        redirectTimer();
    </script>
</body>

</html>