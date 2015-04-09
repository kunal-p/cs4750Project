<?php
	$db_connection = new mysqli("stardock.cs.virginia.edu", "cs4750bh3ay", "cs2015", "cs4750bh3ay");
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
		return null;
	}
	$id =$_GET['id'];
	$return_arr = array();
	$stmt = $db_connection->stmt_init();
		if($stmt->prepare("select patient_id,start,end from appointments where license_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
		$stmt->execute();
		$stmt->bind_result($patient_id,$start, $end);
	    while ($stmt->fetch()) {
		    $row_array['start'] = $start;
		    $row_array['end'] = $end;
		    $row_array['id'] = "patient";
		    $row_array['title'] = "Patient: ".$patient_id;
		    //color: 'blue',    // an option!
			//textColor: 'white',  // an option!
			//editable: false,
			//title: 'Occupied'

		    array_push($return_arr,$row_array);
		}
		$stmt->close();
	}


	$db_connection->close();
	echo json_encode($return_arr);
	exit();

?>