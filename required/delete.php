<?php

if (isset($_POST['submissionID']) && trim($_POST['submissionID']) != "") {
    $mysqli2 = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $submissionID = $_POST['submissionID'];
    $sqlDel = "DELETE FROM submission WHERE submission.id = " . $submissionID . ";";

    $mysqli2->query($sqlDel);
    $mysqli2->close();
}
?>