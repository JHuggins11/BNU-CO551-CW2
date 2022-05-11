<?php
    // CO551 CW2 - Tasks 4-7 (Bootstrap reference: https://getbootstrap.com/docs/5.1/forms/overview/)

    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // Check account login.
    if (isset($_SESSION['id'])) {
        echo template("templates/partials/header.php");
        echo template("templates/partials/nav.php");

        // If the form has been submitted, it will insert the inputted student into the student table. Otherwise, it will display the form.
        if (isset($_POST["btnsubmit"])) {
            // Obtain file sent to server within the response
            $image = $_FILES["imgstudent"]["tmp_name"];

            // Get file binary data
            $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));
            
            // Non-prepared statements
            $sql = "INSERT INTO student ";
            $sql .= "VALUES ('$_POST[txtstudentid]', '" . password_hash($_POST['txtpassword'], PASSWORD_DEFAULT) . "', '$_POST[datedob]', ";
            $sql .= "'$_POST[txtfname]', '$_POST[txtlname]', '$_POST[txthouse]', '$_POST[txttown]', '$_POST[txtcounty]', ";
            $sql .= "'$_POST[txtcountry]', '$_POST[txtpostcode]', '$imagedata');";

            $result = mysqli_query($conn, $sql);

            /* Prepare statement and bind values
            $stmt = $conn->prepare("INSERT INTO student VALUES (?, '" . password_hash($_POST['txtpassword'], PASSWORD_DEFAULT) . "', ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("sssssssssb", $_POST["txtstudentid"], $_POST["datedob"], $_POST["txtfname"], $_POST["txtlname"], 
                $_POST["txthouse"], $_POST["txttown"], $_POST["txtcounty"], $_POST["txtcountry"], $_POST["txtpostcode"], $imagedata);
            $stmt->execute();

            $result = $stmt->get_result();*/
            
            $data['content'] .= "New student has been added.";
        }
        else {
            $data['content'] .= "<h2>Add New Student</h2>";
            $data['content'] .= "<form enctype='multipart/form-data' action='{$_SERVER['PHP_SELF']}' method='post'>";
            
            // Using <<<EOD notation to allow building of a multi-line string
            $data['content'] .= <<<EOD
                <label for="txtstudentid" class="form-label">Student ID (7 digits long beginning with 2):</label>
                <input type="text" class="form-control" id="txtstudentid" name="txtstudentid" 
                    pattern="^2[0-9]{7}$" placeholder="e.g. 20000006" style="width:15%;" required><br>

                <label for="txtpassword" class="form-label">Password:</label>
                <input type="password" class="form-control" id="txtpassword" name="txtpassword"
                    style="width:15%;" required><br>

                <label for="datedob" class="form-label">Date of Birth:</label>
                <input type="date" class="form-control" id="datedob" name="datedob"
                    style="width:15%;" required><br>

                <label for="txtfname" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="txtfname" name="txtfname"
                    style="width:15%;" required><br>

                <label for="txtlname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="txtlname" name="txtlname" style="width:15%;" required><br>

                <label for="txthouse" class="form-label">House Address:</label>
                <input type="text" class="form-control" id="txthouse" name="txthouse" style="width:15%;" required><br>

                <label for="txttown" class="form-label">Town/City:</label>
                <input type="text" class="form-control" id="txttown" name="txttown" style="width:15%;" required><br>

                <label for="txtcounty" class="form-label">County:</label>
                <input type="text" class="form-control" id="txtcounty" name="txtcounty" style="width:15%;" required><br>

                <label for="txtcountry" class="form-label">Country:</label>
                <input type="text" class="form-control" id="txtcountry" name="txtcountry" placeholder="e.g. UK"
                    style="width:15%;" required><br>

                <label for="txtpostcode" class="form-label">Postcode:</label>
                <input type="text" class="form-control" id="txtpostcode" name="txtpostcode" 
                    style="width:15%;" required><br>

                <label for="imgstudent" class="form-label">Image (JPEG only):</label>
                <input type="file" class="form-control" name="imgstudent" accept="image/jpeg" style="width:15%;" required><br>

                <input type="submit" class="btn btn-primary" name="btnsubmit" value="Submit">
            </form>
            EOD;
        }
        
        // Render the template
        echo template("templates/default.php", $data);
    }
    else {
        header("Location: index.php");
    }
        
    echo template("templates/partials/footer.php");
?>