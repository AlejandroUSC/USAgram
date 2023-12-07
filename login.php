<?php
require "config/config.php";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header('Location: main.php');
} else if (isset($_SESSION['logged_out']) && $_SESSION['logged_out'] == true) {
    session_destroy();
} else {
    if (isset($_POST['log_email']) && isset($_POST['log_pass'])) {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        echo 'here';
        if ($mysqli->connect_errno) {
            echo $mysqli->connect_error;
            exit();
        }

        $email = $mysqli->escape_string($_POST['log_email']);
        $pass = hash('sha256', $mysqli->escape_string($_POST['log_pass']));

        $sqlSelect = "SELECT * FROM user WHERE email = '$email' AND password = '$pass';";

        $result = $mysqli->query($sqlSelect);
        echo 'here2';
        if (!$result) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }

        $mysqli->close();

        if ($result->num_rows == 1) {
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $_POST['log_email'];
            header('Location: main.php');
            echo ('logged in');
        } else {
            $error = "Invalid Email or Password.";
        }
        echo 'here3';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>


<!-- https://getbootstrap.com/docs/4.3/components/forms/? -->
<!-- https://mdbootstrap.com/docs/standard/extended/modal-form/#example1 -->

<!-- Template used for this. has modifications -->

<body class="login-body">

    <?php include 'nav.php'; ?>


    <div class="container cust-container">
        <div class="row">
            <div class="cust-col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Login to Your Account</h3>
                        <form action="login.php" id="login-form" method="POST">
                            <div class="font-italic text-danger">
                                <?php if (!empty($error)) echo $error; ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" name="log_email" id="email" placeholder="Enter email" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone.</small>
                                <small id="email-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="log_pass" id="password" placeholder="Password" required>
                                <small id="pass-error" class="form-text text-danger"></small>
                            </div>
                            <button type="submit" class="btn btn-primary  mx-auto d-block">Login</button>
                            <p class="text-center" id="p-text-center">Don't have an account?
                                <a href="#" data-toggle="modal" data-target="#registerModal">Create one</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Template grabbed for this - has modification -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Sign Up</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form action="register_confirm.php" method="POST" id="reg-form">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="reg-fname">First Name</label>
                            <input type="text" id="reg-fname" name="fname" class="form-control" required>
                            <small id="reg-fn-error" class="form-text text-danger"></small>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="reg-lname">Last Name</label>
                            <input type="text" id="reg-lname" name="lname" class="form-control" required>
                            <small id="reg-ln-error" class="form-text text-danger"></small>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="reg-email">Email address</label>
                            <input type="email" id="reg-email" name="remail" class="form-control"  required>
                            <small id="reg-email-error" class="form-text text-danger"></small>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="reg-password">Password</label>
                            <input type="password" id="reg-password" name="rpass" class="form-control" required>
                            <small id="reg-pass-error" class="form-text text-danger"></small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
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

    <script src="js/script.js"></script>

</body>

</html>