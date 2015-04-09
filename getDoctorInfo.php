<?php
  $db_connection = new mysqli("stardock.cs.virginia.edu", "cs4750bh3ay", "cs2015", "cs4750bh3ay");
  if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    return null;
  }

  $id = $_POST['id'];

  $stmt = $db_connection->stmt_init();
  if($stmt->prepare("SELECT specialization,first_name,middle_name,last_name,email,phone FROM doctor WHERE license_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->bind_result($specialization,$first_name,$middle_name,$last_name,$email,$phone);
      while ($stmt->fetch()) {
        echo "<table class=\"table\">";
        echo " <tr><td><b>First Name:</b></td> <td>$first_name</td> </tr>";
        echo " <tr><td><b>Middle Name:</b></td><td>$middle_name</td> </tr>";
        echo " <tr><td><b>Last Name:</b></td> <td>$last_name</td> </tr>";
        echo " <tr><td><b>Specialization:</b></td> <td>$specialization</td> </tr>";
        echo " <tr><td><b>Email:</b></td> <td>$email</td> </tr>";
        echo " <tr><td><b>Phone:</b></td> <td>$phone</td> </tr>";
        echo "</table>";
      }
    $stmt->close();
  }
  $db_connection->close();
  exit();
?>