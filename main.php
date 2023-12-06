<?php

require 'config/config.php';

if (
  !isset($_POST['email']) || trim($_POST['email'] == '')
  || !isset($_POST['username']) || trim($_POST['username'] == '')
  || !isset($_POST['password']) || trim($_POST['password'] == '')
) {
  $error = "Please fill out all required fields.";
} else {
  // All required fields present.
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
  }

  $email = $mysqli->escape_string($_POST['email']);
  $username = $mysqli->escape_string($_POST['username']);
  $password = $mysqli->escape_string($_POST['password']);

  $password = hash('sha256', $password);

  $sql_registered = "SELECT * 
						FROM users
						WHERE username = '$username'
						OR email = '$email';";

  $results_registered = $mysqli->query($sql_registered);

  if (!$results_registered) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
  }

  if ($results_registered->num_rows > 0) {
    $error = "Username or email already registered.";
  } else {
    $sql = "INSERT INTO users (username, email, password)
			VALUES ('$username','$email','$password');";

    $results = $mysqli->query($sql);

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
  <title>US'Agram</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <script src="simplemaps/mapdata.js"></script>
  <script src="simplemaps/usmap.js"></script>
</head>

<body>

  <?php include 'nav.php'; ?>

  <div class="div-body">
    <div id="map"></div>
  </div>

  <div id="footer">
    <div class="row">
      <div id="footer-text" class="col-12 text-center">
        This map was created and can be edited at
        <a href="http://simplemaps.com/custom/us/uCVg3D6K">http://simplemaps.com/custom/us/uCVg3D6K</a>
        <br>
        © 2023 Alejandro Martinez
      </div>
    </div>
  </div>




  <script src="js/script.js"></script>

</body>

</html>