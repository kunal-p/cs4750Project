function showFooter(){
	document.getElementById("footer").innerHTML = '<div class="footer"><div class="container"><div class="row"><div class="col-footer col-md-4 col-xs-6"><h3>Group Members</h3><p class="contact-us-details"><b>Boyang Huang (bh3ay)</b><br/> <b>Kunal Patel (kp2ef)</b><br/> <b>Miwa Tritt (tmt7rc)</b><br/> <b>Teddy Peneva (tzp5vg)</b><br/> </p></div></div></div></div>';
}

function showHeaderPatient(){
	 document.getElementById("header").innerHTML = '<div class="mainmenu-wrapper"><div class="container"><nav id="mainmenu" class="mainmenu"><ul><li class="logo-wrapper"><a href="index.html"><img src="img/mPurpose-logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li><li><a href="index.html">Home</a></li><li><a href="view-Doctors.html">View Doctors</a></li><li><a href="patient-calender-view.html">Make Appointment</a></li><li><a href="cancel-appointment.html">View/Cancel Appointments</a></li></ul></nav></div></div>';
}

function showHeaderDoctor(){
	 document.getElementById("header").innerHTML = '<div class="mainmenu-wrapper"><div class="container"><nav id="mainmenu" class="mainmenu"><ul><li class="logo-wrapper"><a href="index.html"><img src="img/mPurpose-logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li><li><a href="index.html">Home</a></li><li><a href="view-Patients.html">View Patients</a></li><li><a href="doctor-calender-view.html">View Schedule</a></li></ul></nav></div></div>';
}