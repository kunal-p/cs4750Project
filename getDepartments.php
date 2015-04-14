<?php
  $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4750bh3ay", "cs2015", "cs4750bh3ay");
  if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    return null;
  }

  $id = $_POST['id'];
  $stmt = $db_connection->stmt_init();
  $return_arr = array();
  if($stmt->prepare("select distinct specialization from hospital natural join works_at natural join doctor WHERE hospital.hospital_id = $id") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->bind_result($specialization);
      while ($stmt->fetch()) {
        echo "<li><input type=\"button\" class=\"btn-link\" onclick=\"getDoctors('$specialization')\" value=\"$specialization\"></input></li>";
      }
    $stmt->close();
  }
  $db_connection->close();

?>