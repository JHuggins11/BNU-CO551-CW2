<!-- CO551 CW2 - Tasks 4-5 -->
<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");

    // Checks account login first, then if the form has been submitted, it will insert the inputted student into the student table. Otherwise, it will display the form.
    if (isset($_SESSION['id'], $_POST["btnsubmit"])) {
        // Obtain file sent to server within the response
        $image = $_FILES["imgstudent"]["tmp_name"];

        // Get file binary data
        $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));
        
        $sql = "INSERT INTO student ";
        $sql .= "VALUES ('$_POST[txtstudentid]', '" . password_hash($_POST['txtpassword'], PASSWORD_DEFAULT) . "', '$_POST[datedob]', ";
        $sql .= "'$_POST[txtfname]', '$_POST[txtlname]', '$_POST[txthouse]', '$_POST[txttown]', '$_POST[txtcounty]', ";
        $sql .= "'$_POST[txtcountry]', '$_POST[txtpostcode]', '$imagedata');";

        $result = mysqli_query($conn, $sql);

        echo "New student has been added.";
    }
    else { ?>
        <!DOCTYPE html>
        <html>
            <head></head>
            <body>
                <h2>Add New Student</h2>
                <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
                    <label for="txtstudentid">Student ID (7 digits long beginning with 2):</label>
                    <input type="text" id="txtstudentid" name="txtstudentid" 
                        pattern="^2[0-9]{7}$" placeholder="e.g. 20000006" required><br><br>

                    <label for="txtpassword">Password:</label>
                    <input type="password" id="txtpassword" name="txtpassword" required><br><br>

                    <label for="datedob">Date of Birth:</label>
                    <input type="date" id="datedob" name="datedob" required><br><br>

                    <label for="txtfname">First Name:</label>
                    <input type="text" id="txtfname" name="txtfname" required><br><br>

                    <label for="txtlname">Last Name:</label>
                    <input type="text" id="txtlname" name="txtlname" required><br><br>

                    <label for="txthouse">House Address:</label>
                    <input type="text" id="txthouse" name="txthouse" required><br><br>

                    <label for="txttown">Town/City:</label>
                    <input type="text" id="txttown" name="txttown" required><br><br>

                    <label for="txtcounty">County:</label>
                    <input type="text" id="txtcounty" name="txtcounty" required><br><br>

                    <label for="txtcountry">Country:</label>
                    <input type="text" id="txtcountry" name="txtcountry" placeholder="e.g. UK" required><br><br>

                    <label for="txtpostcode">Postcode:</label>
                    <input type="text" id="txtpostcode" name="txtpostcode" required><br><br>

                    <label for="imgstudent">Image (JPEG only):<label>
                    <input type="file" name="imgstudent" accept="image/jpeg" required><br><br>

                    <input type="submit" name="btnsubmit" value="Submit">
                </form>
            </body>
        </html>
<?php } ?>