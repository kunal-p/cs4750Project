<?php
include_once("./users.php");
$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
		return null;
	}

	$stmt = $db_connection->stmt_init();
	$patient_id = $_POST['patient_id'];
	$license_id = $_POST['license_id'];
	$reason = $_POST['reason'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	if($stmt->prepare("	insert into `appointments`(`patient_id`, `license_id`, `start`, `end`,`purpose`) values ('$patient_id','$license_id','$start','$end','$reason')") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
		$stmt->execute();
		$stmt->close();
		echo $patient_id." ";
		echo $license_id." ";
		echo $reason." ";
		echo $start." ";
		echo $end;
	}
	$db_connection->close();

	exit();
?>