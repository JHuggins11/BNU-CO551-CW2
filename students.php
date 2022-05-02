<!-- CO551 CW2 - Tasks 2-3, 5 -->
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <?php
            include("_includes/config.inc");
            include("_includes/dbconnect.inc");
            include("_includes/functions.inc");

            // Account login check
            if (isset($_SESSION['id'])) {
                // Select all records from the student table
                $sql = "SELECT studentid, password, dob, firstname, lastname, house, town, county, country, postcode, image FROM student";
                $result = mysqli_query($conn, $sql);

                // Create HTML table
                echo "<table align='left' border='1'>";
                echo "<tr><th align='left'>Student ID</th><th align='left'>Password</th><th align='left'>Date of Birth</th>"
                    . "<th align='left'>First Name</th><th align='left'>Last Name</th><th align='left'>House Address</th>"
                    . "<th align='left'>Town/City</th><th align='left'>County</th><th align='left'>Country</th>"
                    . "<th align='left'>Postcode</th><th>Image</th><th>Select</th></tr>";

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
                    echo "<td>" . $row["image"] . "</td>";
                    echo "<td><input type='checkbox' name='selectedrecord'></td>";
                    echo "</tr>";
                }

                echo "</table>";

                // Adding multiple line breaks so the delete button is below the table.
                for ($i=0; $i < 12; $i++) { 
                    echo "<br>";
                }

                echo "<input type='submit' name='btndelete' value='Delete'>";

                // TODO: Needs fixing as the delete button doesn't work when records are checked.
                // Deletes the records that have checked checkboxes.
                if (isset($_POST['selectedrecord'], $_POST['btndelete'])) {
                    $sql = "DELETE FROM student WHERE studentid = '$_GET[studentid]'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo "<p>Record(s) deleted.</p>";
                    }
                }
            }
        ?>
    </body>
</html>