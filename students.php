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
                echo template("templates/partials/header.php");
                echo template("templates/partials/nav.php");

                // Select all records from the student table
                $sql = "SELECT studentid, password, dob, firstname, lastname, house, town, county, country, postcode, image FROM student";
                $result = mysqli_query($conn, $sql);

                // Prepare page content and create HTML table
                $data['content'] .= "<table align='left' border='1'>";
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
                    $data['content'] .= "<td>" . $row["image"] . "</td>";
                    $data['content'] .= "<td><input type='checkbox' name='selectedrecord'></td>";
                    $data['content'] .= "</tr>";
                }

                $data['content'] .= "</table>";

                // Adding multiple line breaks so the delete button is below the table.
                for ($i=0; $i < 12; $i++) { 
                    $data['content'] .= "<br>";
                }

                $data['content'] .= "<input type='submit' name='btndelete' value='Delete'>";

                // TODO: Needs fixing as the delete button doesn't work when records are checked.
                // Deletes the records that have checked checkboxes.
                if (isset($_POST['selectedrecord'], $_POST['btndelete'])) {
                    $sql = "DELETE FROM student WHERE studentid = '$_GET[studentid]'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $data['content'] .= "<p>Record(s) deleted.</p>";
                    }
                }

                // Render the template
                echo template("templates/default.php", $data);
            } 
            else {
                header("Location: index.php");
            }

            echo template("templates/partials/footer.php");
        ?>
    </body>
</html>