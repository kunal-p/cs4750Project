<?php
include_once("./users.php");
$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
  if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    return null;
  }
  $id = $_POST['id'];
  $patients = array();
  $stmt = $db_connection->stmt_init();
  $return_arr = array();
  if($stmt->prepare("SELECT DISTINCT patient_id FROM patient natural join appointments WHERE license_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->bind_result($patient_id);
    while($stmt->fetch()){
      array_push($patients, $patient_id);
      //echo $patient_id;
    }
  }

  foreach ($patients as &$value) {
  if($stmt->prepare("SELECT * FROM patient natural join appointments WHERE license_id='$id' AND patient_id='$value'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->bind_result($patient_id, $blood_type, $weight, $height, $first_name, $last_name, $middle_name, $email, $dob, $address, $license_id, $start, $end, $purpose);
    if($stmt->fetch()){
        echo "<li><input type=\"button\" class=\"btn-link\" onclick=\"getPatientInfo('$patient_id')\" value=\"$first_name $last_name\"></input></li>";
      }
    }
  }

  $stmt->close();
  $db_connection->close();
  exit();
?>
