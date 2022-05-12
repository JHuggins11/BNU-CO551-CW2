<?php
// CO551 CW2 - Tasks 6-7 (Bootstrap reference: https://getbootstrap.com/docs/5.1/forms/overview/)

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // If a module has been selected
   if (isset($_POST['selmodule'])) {
      // Non-prepared statement
      //$sql = "insert into studentmodules values ('" .  $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
      //$result = mysqli_query($conn, $sql);

      // Prepare statement and bind values
      $stmt = $conn->prepare("INSERT INTO studentmodules VALUES (?, ?);");
      $stmt->bind_param("ss", $_SESSION['id'], $_POST['selmodule']);
      $stmt->execute();
      $result = $stmt->get_result();

      $data['content'] .= "<p>The module " . $_POST['selmodule'] . " has been assigned to you</p>";
   }
   else  // If a module has not been selected
   {
      // Build SQL statement that selects all the modules
      $sql = "select * from module";
      $result = mysqli_query($conn, $sql);

      $data['content'] .= "<form name='frmassignmodule' action='' method='post' >";
      $data['content'] .= "<label for='selmodule' class='form-label'>Select a module to assign:</label><br/>";
      $data['content'] .= "<select class='form-select' style='width:20%;' name='selmodule' >";
      // Display the module name sin a drop down selection box
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
      }
      $data['content'] .= "</select><br/>";
      $data['content'] .= "<input type='submit' class='btn btn-primary' name='confirm' value='Save' />";
      $data['content'] .= "</form>";
   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
