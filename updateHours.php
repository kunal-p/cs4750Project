<?php
	$db_connection = new mysqli("stardock.cs.virginia.edu", "cs4750bh3ay", "cs2015", "cs4750bh3ay");
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
		return null;
	}
	//$id = $_SESSION['id'];
	$id = '12312';
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