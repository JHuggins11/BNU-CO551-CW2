<?php
    // CO551 CW2 - Tasks 5 & 7

    include("config.inc");
    include("dbconnect.inc");
    include("functions.inc");

    // Tells browser to render an image; embedded within the response
    header("Content-type: image/jpeg");

    /* Non-prepared statement
    $sql = "SELECT image FROM student WHERE studentid='" . $_GET["studentid"] . "';";
    $result = mysqli_query($conn, $sql);*/

    // Prepare statement and bind values
    $stmt = $conn->prepare("SELECT image FROM student WHERE studentid = ?;");
    $stmt->bind_param("s", $_GET["studentid"]);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = mysqli_fetch_array($result);
    $jpg = $row["image"];

    echo $jpg;
?>