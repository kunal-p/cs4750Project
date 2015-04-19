<?php
session_start();//starting session
include_once("./users.php");
$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
		return null;
	}
	$id = $_SESSION['id'];
	$start =$_POST['start'];
	$end = $_POST['end'];
	$dayEnd = $_POST['dayEnd'];
	$dayStart = $_POST['dayStart'];
	$return_arr = array();
	$stmt = $db_connection->stmt_init();
		if($stmt->prepare("UPDATE `schedule` SET `$dayStart`='$start',`$dayEnd`= '$end' WHERE license_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
		$stmt->execute();
		$stmt->close();
	}


	$db_connection->close();
	echo json_encode($return_arr);
	exit();

?>