<?php
	include_once("./users.php");
	$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
		return null;
	}
	$count = 0;
	$id =$_POST['id'];
	$stmt = $db_connection->stmt_init();
		if($stmt->prepare("select * from appointments where patient_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
		$stmt->execute();
		$stmt->bind_result($patient_id,$license_id, $start, $end, $purpose);

		echo "<table class=\"table\">";
	    while ($stmt->fetch()) {
        echo " <tr id=\"submitButton$count\"><td><b>Start:</b></td> <td>$start</td>";
        echo " <td><b>End:</b></td><td>$end</td> ";
        echo " <td><b>Purpose:</b></td> <td>$purpose</td>";
        echo " <td><button class=\"btn btn-primary\" onclick=\"cancelAppointment('submitButton$count','$patient_id', '$license_id', '$start', '$end')\">Cancel</button></td></tr>";
		
        $count++;
		}

		echo "</table>";
		$stmt->close();
	}


	$db_connection->close();

	exit();

?>