function showFooter(){
	document.getElementById("footer").innerHTML = '<div class="footer"><div class="container"><div class="row"><div class="col-footer col-md-4 col-xs-6"><h3>Group Members</h3><p class="contact-us-details"><b>Boyang Huang (bh3ay)</b><br/> <b>Kunal Patel (kp2ef)</b><br/> <b>Miwa Tritt (tmt7rc)</b><br/> <b>Teddy Peneva (tzp5vg)</b><br/> </p></div></div></div></div>';
}

function showHeaderPatient(){
	 document.getElementById("header").innerHTML = '<div class="mainmenu-wrapper"><div class="container"><nav id="mainmenu" class="mainmenu"><ul><li class="logo-wrapper"><a href="index.html"><img src="img/logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li><li><a href="index.html">Home</a></li><li><a href="page-view-Doctors.php">View Doctors</a></li><li><a href="page-patient-calender-view.php">Make Appointment</a></li><li><a href="page-cancel-appointment.php">View/Cancel Appointments</a></li><li><form action="logout.php"><input class="btn" type="submit" value="Logout"></form></li></ul></nav></div></div>';
}

function showHeaderDoctor(){
	 document.getElementById("header").innerHTML = '<div class="mainmenu-wrapper"><div class="container"><nav id="mainmenu" class="mainmenu"><ul><li class="logo-wrapper"><a href="index.html"><img src="img/logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li><li><a href="index.html">Home</a></li><li><a href="page-view-Patients.php">View Patients</a></li><li><a href="page-doctor-calender-view.php">View Schedule</a></li><li><form action="logout.php"><input class="btn" type="submit" value="Logout"></form></li></ul></nav></div></div>';
}

function showHeaderNewUser(){

 document.getElementById("header").innerHTML = '<div class="mainmenu-wrapper"><div class="container"><nav id="mainmenu" class="mainmenu"><ul><li class="logo-wrapper"><a href="index.html"><img src="img/logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li><li><a href="index.html">Home</a></li><li><a href="page-login.html">Login</a></li><li><a href="page-register.html">Register</a></li></ul></nav></div></div>';
}


