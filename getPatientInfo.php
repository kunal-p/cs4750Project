<?php
include_once("./users.php");
$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
  if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    return null;
  }

  $id = $_POST['id'];


  $stmt = $db_connection->stmt_init();
  if($stmt->prepare("SELECT * FROM patient WHERE patient_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->bind_result($blood_type, $weight, $height, $patient_id, $first_name, $last_name, $middle_name, $email, $dob, $address);
      while ($stmt->fetch()) {
        echo "<table class=\"table\">";
        echo "<tr><td><b>Patient ID:</b></td> <td>$patient_id</td> </tr>";
        echo " <tr><td><b>First Name:</b></td> <td>$first_name</td> </tr>";
        echo " <tr><td><b>Middle Name:</b></td><td>$middle_name</td> </tr>";
        echo " <tr><td><b>Last Name:</b></td> <td>$last_name</td> </tr>";
        echo " <tr><td><b>Blood Type:</b></td> <td>$blood_type</td> </tr>";
        echo " <tr><td><b>Weight:</b></td> <td>$weight</td> </tr>";
        echo " <tr><td><b>Height:</b></td> <td>$height</td> </tr>";
        echo " <tr><td><b>DOB:</b></td> <td>$dob</td> </tr>";

        if($stmt->prepare("SELECT medication FROM medication WHERE patient_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
          $stmt->execute();
          $stmt->bind_result($medication);
          if($stmt->fetch()) {
            echo " <tr><td><b>Medication:</b></td>  <td>$medication</td> </tr>";
          }
          while ($stmt->fetch()) {
            echo "<tr><td></td><td>$medication</td></tr>";
          }
        }
        if($stmt->prepare("SELECT allergy FROM allergy WHERE patient_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
          $stmt->execute();
          $stmt->bind_result($allergy);
          if($stmt->fetch()) {
            echo " <tr><td><b>Allergies:</b></td>  <td>$allergy</td> </tr>";
          }
          while ($stmt->fetch()) {
            echo "<tr><td></td><td>$allergy</td></tr>";
          }
        }
        echo " <tr><td><b>Address:</b></td> <td>$address</td> </tr>";
        if($stmt->prepare("SELECT phone_number FROM patient_phone WHERE patient_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
          $stmt->execute();
          $stmt->bind_result($phone);
          if($stmt->fetch()) {
            echo " <tr><td><b>Phone:</b></td>  <td>$phone</td> </tr>";
          }
          while ($stmt->fetch()) {
            echo "<tr><td></td><td>$phone</td></tr>";
          }
        }

        echo " <tr><td><b>Email:</b></td> <td>$email</td> </tr>";
        echo "</table>";
      }
    $stmt->close();
  }
  $db_connection->close();
  exit();
?>