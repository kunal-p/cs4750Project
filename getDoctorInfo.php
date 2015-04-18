<?php
  $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4750bh3ay", "cs2015", "cs4750bh3ay");
  if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    return null;
  }

  $id = $_POST['id'];

  $stmt = $db_connection->stmt_init();
  if($stmt->prepare("SELECT * FROM doctor_info_view WHERE license_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->bind_result($license_id,$first_name,$middle_name,$last_name,$specialization,$email,$room_number,$floor,$name,$street,$city,$state,$zipcode,$classification,$phone);
      if($stmt->fetch()) {
        echo "<table class=\"table\">";
        echo " <tr><td><b>First Name:</b></td> <td>$first_name</td> </tr>";
        echo " <tr><td><b>Middle Name:</b></td><td>$middle_name</td> </tr>";
        echo " <tr><td><b>Last Name:</b></td> <td>$last_name</td> </tr>";
        echo " <tr><td><b>Specialization:</b></td> <td>$specialization</td> </tr>";
        echo " <tr><td><b>Room Number:</b></td> <td>$room_number</td> </tr>";
        echo " <tr><td><b>Floor:</b></td> <td>$floor</td> </tr>";
        echo " <tr><td><b>Email:</b></td> <td>$email</td> </tr>";
      }
      echo " <tr><td><b>Phone:</b></td>  <td>$phone</td> </tr>";
      while ($stmt->fetch()) {
            echo "<tr><td></td><td>$phone</td></tr>";
      }
      echo " <tr><td><b>Hospital:</b></td> <td>$name</td> </tr>";
      echo " <tr><td><b>Location:</b></td> <td>$street $city, $state $zipcode</td> </tr>";
      echo " <tr><td><b>Classification:</b></td> <td>$classification</td> </tr>";
      echo "</table>";
    $stmt->close();
  }
  $db_connection->close();
  exit();
?>