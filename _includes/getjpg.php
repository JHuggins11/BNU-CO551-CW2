<?php
    // CO551 CW2 - Task 5

    include("config.inc");
    include("dbconnect.inc");
    include("functions.inc");

    // Tells browser to render an image; embedded within the response
    header("Content-type: image/jpeg");

    $sql = "SELECT image FROM student WHERE studentid='" . $_GET["studentid"] . "';";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
    $jpg = $row["image"];

    echo $jpg;
?>