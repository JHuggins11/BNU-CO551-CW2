<?php
    // CO551 CW2 - Tasks 2-3, 5-6 (Bootstrap reference: https://getbootstrap.com/docs/5.1/content/tables/)

    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // Account login check
    if (isset($_SESSION['id'])) {
        echo template("templates/partials/header.php");
        echo template("templates/partials/nav.php");

        // Select all records from the student table
        $sql = "SELECT studentid, password, dob, firstname, lastname, house, town, county, country, postcode, image FROM student";
        $result = mysqli_query($conn, $sql);

        $data['content'] .= "<h2>List of Students</h2>";

        // Wraps table within an HTML form tag, with the form posting to the specified script to delete the selected student records
        $data['content'] .= "<form action='deletestudents.php' onsubmit=\"return confirm('Are you sure you want to delete this?');\" 
            method='post'>";

        // Prepare page content and create HTML table
        $data['content'] .= "<table class='table table-bordered' align='left' border='1'>";
        $data['content'] .= "<tr><th align='left'>Student ID</th><th align='left'>Password</th><th align='left'>Date of Birth</th>"
            . "<th align='left'>First Name</th><th align='left'>Last Name</th><th align='left'>House Address</th>"
            . "<th align='left'>Town/City</th><th align='left'>County</th><th align='left'>Country</th>"
            . "<th align='left'>Postcode</th><th>Image</th><th>Select</th></tr>";

        // Display each record from the student table in the HTML table
        while ($row = mysqli_fetch_assoc($result)) {
            $data['content'] .= "<tr>";
            $data['content'] .= "<td>" . $row["studentid"] . "</td>";
            $data['content'] .= "<td>" . $row["password"] . "</td>";
            $data['content'] .= "<td>" . $row["dob"] . "</td>";
            $data['content'] .= "<td>" . $row["firstname"] . "</td>";
            $data['content'] .= "<td>" . $row["lastname"] . "</td>";
            $data['content'] .= "<td>" . $row["house"] . "</td>";
            $data['content'] .= "<td>" . $row["town"] . "</td>";
            $data['content'] .= "<td>" . $row["county"] . "</td>";
            $data['content'] .= "<td>" . $row["country"] . "</td>";
            $data['content'] .= "<td>" . $row["postcode"] . "</td>";
            $data['content'] .= "<td><img src='_includes/getjpg.php?studentid=" . $row["studentid"] . "'></td>";
            $data['content'] .= "<td><input type='checkbox' name='students[]' value='$row[studentid]'></td>";
            $data['content'] .= "</tr>";
        }

        $data['content'] .= "</table>";

        $data['content'] .= "<input type='submit' class='btn btn-danger' name='btndelete' value='Delete'>";
        $data['content'] .= "</form>";
        $data['content'] .= "WARNING: Don't delete the first record, otherwise you won't be able to login again.";

        // Render the template
        echo template("templates/default.php", $data);
    } 
    else {
        header("Location: index.php");
    }

    echo template("templates/partials/footer.php");
?>