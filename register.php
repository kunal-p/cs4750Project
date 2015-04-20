<?php
session_start();//starting session

	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750bh3ay', 'cs2015', 'cs4750bh3ay');
  	if (mysqli_connect_errno()) {
		echo "NOOOOOO!!!!!";
	}
	echo "works somewhat:";
	echo $_POST["password"];
	$username = mysql_escape_string($_POST["username"]);
	$password = mysql_escape_string($_POST["password"]);
	$confirm_password = mysql_escape_string($_POST["password2"]);
	$email = mysql_escape_string($_POST["email"]);
	$firstname = mysql_escape_string($_POST["firstname"]);
	$middlename = mysql_escape_string($_POST["middlename"]);
	$lastname = mysql_escape_string($_POST["lastname"]);
	$dob = mysql_escape_string($_POST["dob"]);
	$weight = mysql_escape_string($_POST["weight"]);
	$address = mysql_escape_string($_POST["address"]);
	$height = mysql_escape_string($_POST["height"]);
	$bloodtype = mysql_escape_string($_POST["bloodtype"]);
	$phone = mysql_escape_string($_POST["phone"]);
	$meds = mysql_escape_string($_POST["meds"]);
	$randID = getRandomString(5);
	$flag = 0;
	echo $confirm_password;
	if ($password !== $confirm_password) {
		echo "Your passwords didn't match!";
		sys.exit();
	}

	while ($flag == 0) {
		$flag = 1;
		$stmt = $db_connection->stmt_init();
		if ($stmt -> prepare("SELECT id FROM users")) {
			echo "first query correct";
			$stmt->execute();
			$stmt->bind_result($id2);
			while ($stmt->fetch()) {
				if ($id2 == $randID) {
					$flag = 0;
					$randID = getRandomString(5);
				}
			}
		}
	}
	$stmt = $db_connection->stmt_init();
	if($stmt->prepare("SELECT username FROM users")) {
		$stmt->execute();
		$stmt->bind_result($username2);
		while($stmt->fetch()){
			if ($username == $username2) {
				echo "username already taken";
				sys.exit();
			}
		}
	}

	$stmt = $db_connection->stmt_init();
	if($stmt->prepare("CALL insertPersonInfo('$randID', '$firstname', '$lastname', '$middlename', '$bloodtype', '$weight', '$height', '$email', '$dob', '$address', '$allergy', '$phone', '$meds', '$username', '$password')")) {
		echo "THE STATEMENT IS VALID";
		$stmt->execute();
		$stmt->bind_result($username2, $email2, $id2);
		while($stmt->fetch()){
			echo "WORKS";
		}
		echo $username;
		$_SESSION['id'] = $randID;
		$_SESSION['type'] = 0;
		header("Location: router.php");
	}



	function getRandomString($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $string = '';

	    for ($i = 0; $i < $length; $i++) {
	        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
	    }

	    return $string;
	}
?>
