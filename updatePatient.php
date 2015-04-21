<?php
include_once("./users.php");
$pk = $_POST['pk'];
$name = $_POST['name'];
$value = $_POST['value'];

if(!empty($value)){

	$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
  	if (mysqli_connect_errno()) {
    		echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
    	return null;
  
	}
	$stmt = $db_connection->stmt_init();
                if($stmt->prepare("UPDATE `patient` SET `$name`='$value' WHERE patient_id='$pk'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
                $stmt->execute();
                $stmt->close();
        }


}
else{
	header('HTTP 400 Bad Request', true, 400);
	echo "This field is required!";

}

?>
