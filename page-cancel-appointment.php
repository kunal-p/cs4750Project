<?php
session_start();//starting session
$id;
if(isset($_SESSION['id'])){
	if($_SESSION['type'] == 0){
		$id = $_SESSION['id'];
	}else{
		header('Location: index.html');
	}
} else{
	header('Location: index.html');
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>View/Cancel Appointments</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/icomoon-social.css">
        <link rel="stylesheet" href="css/bootstrap-combined.min.css">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/leaflet.css" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="css/main.css">
		 <script src="js/jquery.min.js"></script>

        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="js/javascript.js"></script>
        <script type="text/javascript">
        var id = '<?php echo $id; ?>';
        $("document").ready(function(){
			//$('#submitButton').onclick = function() { doSubmit(); };
	        $.ajax({
		      url: 'appointmentsPatient.php',
		      type: 'post',
		      data:{'id': id},
		      success: function(data, status) {
		          $('#appointments').html(data);
		      }
		    }); // end ajax call
    	});

        var events;
        </script>
        <script>
        function cancelAppointment(btn_id,patient_id, license_id, start, end){
	    	$.ajax({
		      url: 'cancelAppointment.php',
		      type: 'post',
		      data: {'license_id': license_id,
		      		'patient_id':patient_id,
		      		'start': moment(start).format('YYYY-MM-DD HH:mm:00'),
		  			'end': moment(end).format('YYYY-MM-DD HH:mm:00') },
		      success: function(data, status) {
		      }
		    });
		    $('#'+btn_id).remove();
        }
        </script>

    </head>
    <body>

    	<div id="header"></div>
    	<script type="text/javascript">showHeaderPatient();</script>

        <!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>View Doctors</h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section" >
	    	<div class="container">
				<div class="row">
					<!-- Sidebar -->
					<div class="col-sm-8" id="apt-container">
						<div class="blog-post blog-single-post">
							<div class="single-post-title">
								<h2>Appointments</h2>
							</div>
							<div class="single-post-content" id="appointments">
					
							</div>

						</div>
					</div>
					<!-- End Blog Post -->
				</div>
			</div>
	    </div>


	    <!-- Footer -->
	    <div id="footer"></div>
	    <script>showFooter();</script>


        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="js/jquery.fitvids.js"></script>
        <script src="js/jquery.sequence-min.js"></script>
        <script src="js/jquery.bxslider.js"></script>
        <script src="js/main-menu.js"></script>

        <script src="js/jquery.min.js"></script>
        <script src="js/date.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/fullcalendar.min.js"></script>
		<link rel="stylesheet" href="css/fullcalendar.min.css">
		<script src="js/gcal.js"></script>
		<link rel="stylesheet" href="css/calendar.css">

		<script>
		function dismissModal(){
		   	 $( "#createEventModal" ).removeClass( "show" ).addClass( "hide" );
		 }
		</script>
    </body>
</html>