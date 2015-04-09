<?php
  $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4750bh3ay", "cs2015", "cs4750bh3ay");
  if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    return null;
  }

  $stmt = $db_connection->stmt_init();
  $return_arr = array();
  $dept = $_POST['dept'];
  if($stmt->prepare("select first_name, last_name,license_id from doctor where specialization ='$dept'
") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $license_id);
      while ($stmt->fetch()) {
        echo "<li><input type=\"button\" class=\"btn-link\" onclick=\"getEvents('$license_id')\" value=\"$first_name $last_name\"></input></li>";
      }
    $stmt->close();
  }
  $db_connection->close();

?>