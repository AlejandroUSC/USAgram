<?php
require "config/config.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}
$mysqli->set_charset('utf8');

require "yield.php"; // Displays submissions

// Below will create and post a submission
$em = $_SESSION['email'];
$emailSQL = "SELECT * FROM `user` WHERE email = '$em';";
$person = $mysqli->query($emailSQL);
$personData = $person->fetch_assoc();
$userID = $personData['id'];

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

// POST CALL FOR DELETING SUBMISSIONS
if(isset($_POST['submissionID']) && trim($_POST['submissionID']) != ""){
    $mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $submissionID = $_POST['submissionID'];
    $sqlDel = "DELETE FROM submission WHERE submission.id = " . $submissionID . ";";
    // echo $sqlDel;
    $mysqli2->query($sqlDel);
    $mysqli2->close();
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
    <!-- Use open-iconic from lecture example -->
    <link href="lib/font/css/open-iconic-bootstrap.min.css" rel="stylesheet">
</head>

<!-- Template grabbed and modified from this site -->
<!-- https://mdbootstrap.com/docs/standard/extended/modal-form/#example1 -->

<body>
    <?php include 'nav.php'; ?>

    <div id="content">

        <div id="state-div">
            <h1 id="state-name-rep">State</h1>
        </div>

        <div id="state-container">
            <div id="state-img">
                <img id="state-flag" src="usr_img/loading.jpeg" alt="State flag">
            </div>
            <div id="state-desc">
                <p></p>
            </div>
        </div>

        <hr>

        <?php while ($sub = $submissionResult->fetch_assoc()) : ?>
            <div class="post-container">
                <div class="post-header">
                    <span class="user-name">User: <?php echo $sub['first'] . ' ' .  $sub['last']; ?></span>
                    <span class="state-name">Location: <?php echo $sub['city'] . ", " . $sub['state']; ?></span>
                    <span class="post-date">Date: <?php echo $sub['date']; ?></span>
                    <?php if ($sub['userID'] == $userID) : ?>
                        <span class="todo-remove oi oi-circle-x del-button" title="Remove" data-submission-id="<?php echo $sub['ID']; ?>"></span>
                    <?php endif; ?>
                </div>
                <div class="post-body">
                    <img class="user-image" src="<?php echo $sub['file']; ?>" alt=" <?php echo $sub['first'] . ' ' . $sub['last'] . ' uploaded picture'; ?>">
                    <div class="post-description">
                        <p class="user-description"> <?php echo $sub['des']; ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) : ?>
        <button type="button" class="btn btn-primary" id="upload-button" data-toggle="modal" data-target="#uploadModal">
            + Add a Memory +
        </button>
    <?php endif; ?>

    <!-- Credit to https://bestjquery.com/tutorial/pagination/demo216/ -->
    <nav class="pagination-outer" aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item <?php if ($curr_page <= 1) {
                                        echo 'disabled';
                                    } ?>">
                <a href="<?php $_GET['page'] = $curr_page - 1;
                            echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET); ?>" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href=""><?php echo $curr_page; ?></a></li>
            <li class="page-item <?php if ($curr_page >= $fin_page) {
                                        echo 'disabled';
                                    } ?>">
                <a href="<?php $_GET['page'] = $curr_page + 1;
                            echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET); ?>" class="page-link" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Photo</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="upload-form" action="<?php echo $url; ?>" method="POST" enctype="multipart/form-data">
                        <div class="upload-form-group">
                            <label for="picture-upload">Select image to upload</label>
                            <input type="file" class="form-control" name="image_up" id="picture-upload" accept="image/png, image/jpeg, image/jpg" required>
                        </div>
                        <div class="upload-form-group">
                            <label for="location">What city was this picture taken in?</label>
                            <textarea class="form-control" id="location" name="city" rows="1" maxlength="100" required></textarea>
                        </div>
                        <div class="upload-form-group">
                            <label for="time">When was this picture taken?</label>
                            <input class="form-control" name="date" type="date" id="time" name="date" required>
                        </div>
                        <div class="upload-form-group">
                            <label for="description">Description (300 characters or less)</label>
                            <textarea class="form-control" id="description" name="desc" rows="3" maxlength="300" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginRegisterModal" tabindex="-1" role="dialog" aria-labelledby="loginModel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModel">Not Logged In</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You need to login inorder to share your memories!</p>
                    <a href="login.php" class="btn btn-primary">Register or Login now!</a>
                </div>
            </div>
        </div>
    </div>

    <div id="footer" class="container-fluid">
        <div class="row">
            <div id="footer-text" class="col-12 text-center">
                This map was created and can be edited at
                <a href="http://simplemaps.com/custom/us/uCVg3D6K">http://simplemaps.com/custom/us/uCVg3D6K</a>
                <br>
                © 2023 Alejandro Martinez
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/state_insert.js"></script>

    <script>
        $(document).ready(function() {
            $(".del-button").on("click", function() {
                var submissionID = $(this).data("submission-id");
                console.log("in ajax: " . submissionID);
                // Perform the AJAX request
                $.ajax({
                    type: "POST",
                    url: window.location.href,
                    data: {
                        submissionID: submissionID
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            });
        });
    </script>

</body>