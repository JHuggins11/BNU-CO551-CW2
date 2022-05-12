<?php
// CO551 CW2 - Tasks 6-7 (Bootstrap reference: https://getbootstrap.com/docs/5.1/content/tables/)

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check login
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      /* Non-prepared statement
      $sql = "select * from studentmodules sm, module m where m.modulecode = sm.modulecode and sm.studentid = '" . $_SESSION['id'] ."';";
      $result = mysqli_query($conn,$sql);*/

      // Build prepared SQL statement selecting a student's modules
      $stmt = $conn->prepare("SELECT * FROM studentmodules AS sm, module AS m WHERE m.modulecode = sm.modulecode AND sm.studentid = ?;");
      $stmt->bind_param("s", $_SESSION['id']);
      $stmt->execute();
      $result = $stmt->get_result();

      // prepare page content
      $data['content'] .= "<table class='table table-bordered' style='width:40%;' border='1'>";
      $data['content'] .= "<tr><th colspan='5' align='center'>Modules</th></tr>";
      $data['content'] .= "<tr><th>Code</th><th>Type</th><th>Level</th></tr>";
      // Display the modules within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td> $row[modulecode] </td><td> $row[name] </td>";
         $data['content'] .= "<td> $row[level] </td></tr>";
      }
      $data['content'] .= "</table>";

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

?>
