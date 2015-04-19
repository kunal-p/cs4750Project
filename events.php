<?php
include_once("./users.php");
$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
		return null;
	}

	$stmt = $db_connection->stmt_init();
	$return_arr = array();
	$id =$_POST['id'];
	//$id ='12312';
	//echo $_POST['id'];
	if($stmt->prepare("select license_id,first_name,last_name, mon_start,mon_end,tues_start,tues_end,wed_start,wed_end,thurs_start,thurs_end,fri_start,fri_end,sat_start,sat_end,sun_start,sun_end from schedule natural join doctor where license_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
		$stmt->execute();
		$stmt->bind_result($id, $first_name, $last_name, $mon_start, $mon_end, $tues_start, $tues_end, $wed_start, $wed_end, $thurs_start, $thurs_end, $fri_start, $fri_end, $sat_start, $sat_end, $sun_start, $sun_end);
	    while ($stmt->fetch()) {
	        //printf ("%s (%s)\n", $id, $name);
	        $return_arr['license_id'] = $id;
	        $return_arr['first_name'] = $first_name;
	        $return_arr['last_name'] = $last_name;
	    	$return_arr['mon_start'] = $mon_start;
	    	$return_arr['mon_end'] = $mon_end;
	    	$return_arr['tues_start'] = $tues_start;
	    	$return_arr['tues_end'] = $tues_end;
	    	$return_arr['wed_start'] = $wed_start;
	    	$return_arr['wed_end'] = $wed_end;
	    	$return_arr['thurs_start'] = $thurs_start;
	    	$return_arr['thurs_end'] = $thurs_end;
	    	$return_arr['fri_start'] = $fri_start;
	    	$return_arr['fri_end'] = $fri_end;
	    	$return_arr['sat_start'] = $sat_start;
	    	$return_arr['sat_end'] = $sat_end;
	    	$return_arr['sun_start'] = $sun_start;
	    	$return_arr['sun_end'] = $sun_end;
	    }
	}

	if($stmt->prepare("select start,end from appointments where license_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
		$stmt->execute();
		$stmt->bind_result($start, $end);
	    while ($stmt->fetch()) {
		    $row_array['start'] = $start;
		    $row_array['end'] = $end;

		    array_push($return_arr,$row_array);
		}
		$stmt->close();
	}


	$db_connection->close();
	echo json_encode($return_arr);
	exit();

?>