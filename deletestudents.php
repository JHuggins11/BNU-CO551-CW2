<!-- CO551 CW2 - Task 3 -->
<?php
    // CO551 CW2 - Task 3

    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // Account login check
    if (isset($_SESSION['id'])) {
        // Troubleshooting
        //var_dump($_POST['students']);
        //die();

        // If the students array is empty, redirect
        if (empty($_POST['students'])) {
            header("Location: students.php");
        }

        // TODO: prepared statement
        // Loops over students array and runs a SQL delete query
        foreach ($_POST['students'] as $student) {
            $sql = "DELETE FROM student WHERE studentid = $student";
            $result = mysqli_query($conn, $sql);
        }

        if ($result) {
            echo "Record(s) deleted.";
        }

        // Redirect
        header("Location: students.php");
    } 
    else {
        header("Location: index.php");
    }
?>