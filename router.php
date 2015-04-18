<?php

session_start();
if($_SESSION["type"] == 0) {
	header( "Location: patient.php" );
}
else if($_SESSION["type"] == 1) {
	header( "Location: doctor.php");
}
else {
	echo "Error, you must log in before viewing these pages!";
}

?>