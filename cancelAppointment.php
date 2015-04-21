<?php
include_once("./users.php");
$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
  if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    return null;
  }
  $patient_id = $_POST['patient_id'];
  $license_id = $_POST['license_id'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $stmt = $db_connection->stmt_init();
  if($stmt->prepare("DELETE FROM `appointments` WHERE patient_id='$patient_id' AND license_id='$license_id' AND start='$start' AND end='$end'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->close();
  }
  $db_connection->close();

?>