<?php
	$db_connection = new mysqli("stardock.cs.virginia.edu", "cs4750bh3ay", "cs2015", "cs4750bh3ay");
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
		return null;
	}

	$stmt = $db_connection->stmt_init();
	$id = $_POST['id'];
	$reason = $_POST['reason'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	if($stmt->prepare("	insert into `appointments`(`patient_id`, `license_id`, `start`, `end`,`purpose`) values ('35546','$id','$start','$end','$reason')") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
		$stmt->execute();
		$stmt->close();
		echo $id." ";
		echo $reason." ";
		echo $start." ";
		echo $end;
	}
	$db_connection->close();

	exit();
?>