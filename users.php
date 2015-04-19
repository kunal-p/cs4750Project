<?php
session_start();//starting session
$type = 0;////TODO delete 
if(isset($_SESSION['type'])){
	$type = $_SESSION['type'];

	if($type == 0){//patient db user
		$SERVER = 'stardock.cs.virginia.edu';
		$USERNAME = 'cs4750bh3ayb';
		$PASSWORD = 'patientDB';
		$DATABASE = 'cs4750bh3ay';
	}else if($type == 1){//doctor db user
		$SERVER = 'stardock.cs.virginia.edu';
		$USERNAME = 'cs4750bh3ayc';
		$PASSWORD = 'doctorDB';
		$DATABASE = 'cs4750bh3ay';
	}
}



?>