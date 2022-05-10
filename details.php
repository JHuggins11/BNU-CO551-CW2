<?php
// CO551 CW2 - Task 6 (Bootstrap reference: https://getbootstrap.com/docs/5.1/forms/overview/)

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // build an sql statment to update the student details
      $sql = "update student set firstname ='" . $_POST['txtfirstname'] . "',";
      $sql .= "lastname ='" . $_POST['txtlastname']  . "',";
      $sql .= "house ='" . $_POST['txthouse']  . "',";
      $sql .= "town ='" . $_POST['txttown']  . "',";
      $sql .= "county ='" . $_POST['txtcounty']  . "',";
      $sql .= "country ='" . $_POST['txtcountry']  . "',";
      $sql .= "postcode ='" . $_POST['txtpostcode']  . "' ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your details have been updated</p>";

   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2>My Details</h2>
   <form name="frmdetails" action="" method="post">
   <label for="txtfirstname" class="form-label">First Name:</label>
   <input name="txtfirstname" type="text" class="form-control" style="width:15%;" value="{$row['firstname']}" /><br/>
   <label for="txtlastname" class="form-label">Surname:</label>
   <input name="txtlastname" type="text" class="form-control" style="width:15%;" value="{$row['lastname']}" /><br/>
   <label for="txthouse" class="form-label">Number and Street:</label>
   <input name="txthouse" type="text" class="form-control" style="width:15%;" value="{$row['house']}" /><br/>
   <label for="txttown" class="form-label">Town:</label>
   <input name="txttown" type="text" class="form-control" style="width:15%;" value="{$row['town']}" /><br/>
   <label for="txtcounty" class="form-label">County:</label>
   <input name="txtcounty" type="text" class="form-control" style="width:15%;" value="{$row['county']}" /><br/>
   <label for="txtcountry" class="form-label">Country:</label>
   <input name="txtcountry" type="text" class="form-control" style="width:15%;" value="{$row['country']}" /><br/>
   <label for="txtpostcode" class="form-label">Postcode:</label>
   <input name="txtpostcode" type="text" class="form-control" style="width:15%;" value="{$row['postcode']}" /><br/>
   <input type="submit" class="btn btn-primary" value="Save" name="submit"/>
   </form>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
