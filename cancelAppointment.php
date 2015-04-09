<?php
  $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4750bh3ay", "cs2015", "cs4750bh3ay");
  if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    return null;
  }

  $id=$_POST['id'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $stmt = $db_connection->stmt_init();
  if($stmt->prepare("DELETE FROM `appointments` WHERE license_id='$id' AND start='$start' AND end='$end'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->close();
  }
  $db_connection->close();

?>