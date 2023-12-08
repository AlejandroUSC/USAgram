<?php

require 'config/config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}

if (isset($_SESSION['logged_out']) && $_SESSION['logged_out'] == true) {
    header('Location: main.php');
} else {
    if (isset($_GET['sub']) && !empty($_GET['sub'])) {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($mysqli->connect_errno) {
            echo $mysqli->connect_error;
            exit();
        }
        $subID = $_GET['sub'];
        $sqlSelect =  "SELECT submission.id AS ID, user.id AS userID, user.first, user.last, submission.date, city.name AS city, state.name AS state, submission.description AS des, submission.file_name AS file
                FROM `submission` 
                LEFT JOIN user ON submission.user_id = user.id
                LEFT JOIN city ON submission.city_id = city.id
                LEFT JOIN state ON submission.state_id = state.id
                WHERE submission.id = $subID;";
        $sub = $mysqli->query($sqlSelect)->fetch_assoc();

        $mysqli->close();
    }
}


if (isset($_POST['desc'], $_POST['submission_id'])) {
    $mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli2->connect_errno) {
        echo $mysqli->connect_error;
        $mysqli2->close();
        exit();
    }

    $newDesc =  $mysqli->escape_string($_POST['desc']);
    $submissionId = $_POST['submission_id'];

    $sql = $mysqli2->query("UPDATE submission SET description = '$newDesc' WHERE id = $submissionId");

    if (!$sql) {
        echo $mysqli2->error;
        $mysqli2->close();
        exit();
    } else {
        header('Location: main.php');
    }
    $mysqli2->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing Post</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>


<body class="body">

    <?php include 'nav.php'; ?>

    <div class="post-container">
        <div class="post-header">
            <span class="user-name">User: <?php echo $sub['first'] . ' ' .  $sub['last']; ?></span>
            <span class="state-name">Location: <?php echo $sub['city'] . ", " . $sub['state']; ?></span>
            <span class="post-date">Date: <?php echo $sub['date']; ?></span>
        </div>
        <div class="post-body">
            <img class="user-image" src="<?php echo $sub['file']; ?>" alt=" <?php echo $sub['first'] . ' ' . $sub['last'] . ' uploaded picture'; ?>">
            <div class="post-description">
                <form action="edit_content.php" method="POST">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="desc" rows="5" maxlength="300" required><?php echo htmlspecialchars($sub['des']); ?></textarea>
                    </div>
                    <input type="hidden" name="submission_id" value="<?php echo $sub['ID']; ?>">
                    <button type="submit" class="btn btn-primary">Update Description</button>
                </form>
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
</body>

</html>