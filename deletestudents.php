<!-- CO551 CW2 - Task 3 -->
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
                // Troubleshooting
                var_dump($_POST);
                die();

                // Select all records from the student table
                //$sql = "SELECT studentid, password, dob, firstname, lastname, house, town, county, country, postcode, image FROM student";
                //$result = mysqli_query($conn, $sql);

                // Redirect
                header("Location: students.php");
            } 
            else {
                header("Location: index.php");
            }
        ?>
    </body>
</html>