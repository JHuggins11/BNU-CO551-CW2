<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <?php
            include("_includes/config.inc");
            include("_includes/dbconnect.inc");
            include("_includes/functions.inc");

            // Select all records from the student table
            $sql = "SELECT studentid, password, dob, firstname, lastname, house, town, county, country, postcode FROM student";

            $result = mysqli_query($conn, $sql);

            // Create HTML table
            echo "<table align='left' border='1'>";
            echo "<tr><th align='left'>Student ID</th><th align='left'>Password</th><th align='left'>Date of Birth</th>"
                . "<th align='left'>First Name</th><th align='left'>Last Name</th><th align='left'>House Address</th>"
                . "<th align='left'>Town/City</th><th align='left'>County</th><th align='left'>Country</th>"
                . "<th align='left'>Postcode</th></tr>";

            // Display each record from the student table in the HTML table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["studentid"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["dob"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["house"] . "</td>";
                echo "<td>" . $row["town"] . "</td>";
                echo "<td>" . $row["county"] . "</td>";
                echo "<td>" . $row["country"] . "</td>";
                echo "<td>" . $row["postcode"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        ?>
    </body>
</html>