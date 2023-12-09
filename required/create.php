<?php 

$userID = -1; //Default
if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
    $em = $_SESSION['email'];
    $emailSQL = "SELECT * FROM `user` WHERE email = '$em';";
    $person = $mysqli->query($emailSQL);
    $personData = $person->fetch_assoc();
    $userID = $personData['id'];
}

if (empty($_FILES["image_up"])) {
    $error = "No file uploaded";
} else if ($_FILES["image_up"]['error'] > 0) {
    $error = "File uploaded error " . $_FILES["image_up"]['error'];
} else {
    $src = $_FILES['image_up']['tmp_name'];
    $imgurl = $_FILES['image_up']['name'];
    $dst = "usr_img/" . uniqid() . $imgurl;
    $dst = preg_replace('/\s/', '_', $dst);

    move_uploaded_file($src, $dst);
}
if (isset($_POST['city'])) {
    $city = $_POST['city'];

    $sqlFindCity = "SELECT * FROM city WHERE name = '$city' AND state_id = '$stateNum';";

    $cityResult = $mysqli->query($sqlFindCity);
    if (!$cityResult) {
        echo $mysqli->error;
        $mysqli->close();
        exit();
    }

    if ($cityResult->num_rows == 0) {
        $insert = "INSERT INTO city (name, state_id) VALUES ('$city', $stateNum);";
        $mysqli->query($insert);

        $sqlFindCity = "SELECT * FROM city WHERE name = '$city' AND state_id = '$stateNum';";
        $cityResult = $mysqli->query($sqlFindCity);
    }
    $cityID = $cityResult->fetch_assoc();
    $cityNum = $cityID['id'];

    $date = $_POST['date'];
    $desc = $_POST['desc'];
    $insertSub = "INSERT INTO submission (date, description, file_name, city_id, state_id, user_id)
                    VALUES ('$date', '$desc', '$dst', $cityNum, $stateNum, $userID);";

    $mysqli->query($insertSub);
    header("Refresh:0");
}
$mysqli->close();
?>