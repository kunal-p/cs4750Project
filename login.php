<?php
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750bh3ay', 'cs2015', 'cs4750bh3ay');
  	if (mysqli_connect_errno()) {
		echo "Error in establishing connection with database.";
	}
	else {
		echo "Connection established with database <br>";
	}
	$username = $_POST["username"];
	$password = $_POST["password"];
	$bool = 0;
	if (strpos($username, "'") !== false || strpos($password, "'" !== false)) {
		echo "STOP TRYING TO DO BAD STUFF <br>";
		exit("Script exiting");
	}
	$stmt = $db_connection->stmt_init();
	if($stmt->prepare("select username, password from users")) {
	    $stmt->execute();
		$stmt->bind_result($username2, $password2);
		while($stmt->fetch()) {
			if ($username == $username2 && $password == $password2) {
				$bool = 1;
				$_SESSION['username'] = $username;
				echo "Currently logged on as ".$username."<br>";
			}
		}
	}
	if ($bool == 0) {
		echo "INCORRECT USER/PASSWORD WHATEVER";
	}
?>
