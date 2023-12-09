<?php

require 'config/config.php';

if (
    !isset($_POST['remail']) || trim($_POST['remail'] == '')
    || !isset($_POST['fname']) || trim($_POST['fname'] == '')
    || !isset($_POST['lname']) || trim($_POST['lname'] == '')
    || !isset($_POST['rpass']) || trim($_POST['rpass'] == '')
) {
    $error = "Missing fields. Fill out all required fields.";
} else {
    // All required fields present.
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($mysqli->connect_errno) {
        echo $mysqli->connect_error;
        exit();
    }

    $email = $mysqli->escape_string($_POST['remail']);
    $pass = $mysqli->escape_string($_POST['rpass']);
    $pass = hash('sha256', $pass);
    $fname = $mysqli->escape_string($_POST['fname']);
    $lname = $mysqli->escape_string($_POST['lname']);

    $sqlSelect = "SELECT * FROM user WHERE email = '$email';";

    $existCheck = $mysqli->query($sqlSelect);
    if (!$existCheck) {
        echo $mysqli->error;
        $mysqli->close();
        exit();
    }

    if ($existCheck->num_rows > 0) {
        $error = "Email is already pre-existing.";
    } else {
        $sqlInsert = "INSERT INTO user (first, last, email, password)
                VALUES  ('$fname','$lname','$email', '$pass');";

        $results = $mysqli->query($sqlInsert);

        if (!$results) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }
    }

    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Thank you for signing up on USAgram! Please hold while we redirect you to the next available page.">
    <title>Sign Up Confirmation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>


<body class="login-body">

    <?php include 'required/nav.php'; ?>

    <div class="container cust-container">

        <?php if (isset($error) && trim($error) != '') : ?>
            <div class="text-danger"><?php echo $error; ?> <br>
                Click <a href="#" onclick="redirectTimer(); return false;"> here </a> to redirect back home or wait 5 seconds.</div>
        <?php else : ?>
            <div class="text-success"><?php echo $fname . " " . $lname; ?> your account was successfully registered.<br>
                Click <a href="#" onclick="redirectLogin(); return false;"> here </a> to redirect back or wait 5 seconds.</div>

        <?php endif; ?>

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
    <script>
        redirectTimerLog();
    </script>
</body>

</html>