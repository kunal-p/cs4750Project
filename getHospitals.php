<?php
include_once("./users.php");
$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
  if (mysqli_connect_errno()) {
    echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    return null;
  }

  $stmt = $db_connection->stmt_init();
  $return_arr = array();
  if($stmt->prepare("select hospital_id, name from hospital") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    $stmt->execute();
    $stmt->bind_result($id, $name);
      while ($stmt->fetch()) {
        echo "<li><input type=\"button\" class=\"btn-link\" onclick=\"getDepartments($id)\" value=\"$name\"></input></li>";
      }
    $stmt->close();
  }
  $db_connection->close();

?>