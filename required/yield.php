<?php 

if (isset($_GET['state'])) {
    $currentState = $_GET['state'];
}
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
$encodedState = urlencode($currentState);
$encodedState = str_replace('+', '_', $encodedState);

$url = 'state.php?state=' . $encodedState . '&page=' . $currentPage;
$sqlSelectState = "SELECT id FROM state WHERE name = '$currentState';"; // Holds the id 

$stateResult = $mysqli->query($sqlSelectState);
if (!$stateResult) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$stateID = $stateResult->fetch_assoc();
$stateNum = $stateID['id'];

$sqlSelectStateSubmissions = "SELECT submission.id AS ID, user.id AS userID, user.first, user.last, submission.date, city.name AS city, state.name AS state, submission.description AS des, submission.file_name AS file
FROM `submission` 
LEFT JOIN user ON submission.user_id = user.id
LEFT JOIN city ON submission.city_id = city.id
LEFT JOIN state ON submission.state_id = state.id
WHERE submission.state_id = '$stateNum'
ORDER BY submission.id DESC;";

$submissionResult = $mysqli->query($sqlSelectStateSubmissions);
if (!$submissionResult) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$submissionTotal = $submissionResult->num_rows;
$rpp = 3;

$fin_page = ceil($submissionTotal / $rpp);

if (isset($_GET['page']) && trim($_GET['page']) != '') {
    $curr_page = $_GET['page'];
} else {
    $curr_page = 1;
}
if ($curr_page < 1 || $curr_page > $fin_page) {
    $curr_page = 1;
}

$start = ($curr_page - 1) * $rpp;

$sqlSelectStateSubmissions = rtrim($sqlSelectStateSubmissions, ';');
$sqlSelectStateSubmissions = $sqlSelectStateSubmissions . " LIMIT $start, $rpp";
$submissionResult = $mysqli->query($sqlSelectStateSubmissions);
if (!$submissionResult) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

?>