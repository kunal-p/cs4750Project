<?php
if($_SERVER["HTTPS"] != "on"){
  header("Location: https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
}
	session_start();//starting session
	$db_connection = new mysqli('stardock.cs.virginia.edu', 'cs4750bh3aya', 'loginDB', 'cs4750bh3ay');
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
	echo "This line is the password being hashed: ";
	echo $password;
	echo "<br>";
	echo "This line is the hashed input password: ";
	echo hash('sha256', $password);
	$stmt = $db_connection->stmt_init();
	if($stmt->prepare("select username, password, id, type from users")) {
	    $stmt->execute();
		$stmt->bind_result($username2, $password2, $id, $type);
		while($stmt->fetch()) {
				echo "<br>";
				echo $password2;
				echo "<br>";
			if ($username == $username2 && hash('sha256', $password) === $password2) {
				echo hash('sha256', $password);
				echo $password2;
				$bool = 1;
				$_SESSION['username'] = $username;
				$_SESSION['id'] = $id;
				$_SESSION['type'] = $type;
				header("Location: router.php");
			}
		}
	}
	if ($bool == 0) {
		echo $username;
		echo $password;
		echo "INCORRECT USER OR PASSWORD";
	}
?>
