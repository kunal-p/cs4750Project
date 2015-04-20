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
        <title>Appointment Scheduler</title>
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

        $("document").ready(function(){
		//$('#submitButton').onclick = function() { doSubmit(); };
        $.ajax({
	      url: 'getHospitals.php',
	      type: 'post',
	      success: function(data, status) {
	          $('#allHospitals').html(data);
	      }
	    }); // end ajax call
    	});
        var hospital;
        var department;
        var patient_id = '<?php echo $id; ?>';
        var license_id;

        var events;
        //$('#calendar').fullCalendar( 'refresh' );//going to have to call when update choices
        </script>
        <script type="text/javascript">
	    function getDepartments(id){
	    	$( "#allDepartmentsHeader" ).removeClass( "hide" ).addClass( "show" );
	    	$( "#allDoctorsHeader" ).removeClass( "show" ).addClass( "hide" );
	    	$( "#allDoctors" ).removeClass( "show" ).addClass( "hide" );
		    $.ajax({
		      url: 'getDepartments.php',
		      type: 'post',
		      data: {'id': id},
		      success: function(data, status) {
		          $('#allDepartments').html(data);
		      }
		    }); // end ajax call
	    }
	    function getDoctors(dept){
	    	$( "#allDoctorsHeader" ).removeClass( "show" ).addClass( "hide" );
	    	$( "#allDoctors" ).removeClass( "show" ).addClass( "hide" );
		    $.ajax({
		      url: 'getDoctors.php',
		      type: 'post',
		      data: {'dept': dept},
		      success: function(data, status) {
		      	  $('#allDoctors').html(data);
		          $( "#allDoctorsHeader" ).removeClass( "hide" ).addClass( "show" );
		          $( "#allDoctors" ).removeClass( "hide" ).addClass( "show" );
		      }
		    }); 
	    }
	    function makeAppointment(reason, start, end){
	    	var startTime = new Date(start);
			var endTime = new Date(end);
			var day;
			if (startTime.is().monday()) {
				day = "mon";
			}else if(startTime.is().tuesday()) {
				day = "tues";
			}else if (startTime.is().wednesday()) {
				day="wed";
			}else if (startTime.is().thursday()) {
				day="thurs";
			}else if (startTime.is().friday()) {
				day="fri";
			}else if (startTime.is().saturday()) {
				day="sat";
			}else if (startTime.is().sunday()) {
				day="sun";
			}
			$.ajax({
		      url: 'makeAppointment.php',
		      type: 'post',
		      data: {'reason':reason,
		      		'start': moment(start).format('YYYY-MM-DD HH:mm:00'),
		  			'end': moment(end).format('YYYY-MM-DD HH:mm:00'), 
		  			'patient_id':patient_id,
		      		'license_id':license_id},
		      success: function(data, status) {
		      }
		    });
	    }
	    function cancelAppointment(id, start, end){
	    	$.ajax({
		      url: 'cancelAppointment.php',
		      type: 'post',
		      data: {'patient_id':patient_id,
		      		'license_id':license_id,
		      		'start': moment(start).format('YYYY-MM-DD HH:mm:00'),
		  			'end': moment(end).format('YYYY-MM-DD HH:mm:00'), },
		      success: function(data, status) {
		      }
		    });

	    }
		function isOverlappingOut(event){
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "out" );
		    for(i in array){
		        if (event.end > array[i].start && event.start < array[i].end){
		           return true;
		        }
		    }
		    return false;
		}
		function isOverlappingOther(event){
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "apt" );
		    for(i in array){
		        if (event.end > array[i].start && event.start < array[i].end){
		           return true;
		        }
		    }
		    return false;
		}
		function isOverlappingPatient(event){
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "patient" );
		    for(i in array){
		        if (event.end > array[i].start && event.start < array[i].end){
		           return true;
		        }
		    }
		    return false;
		}

		function myEvent(event){
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "apt" );
		    for(i in array){
		        if (event == array[i]){
		           return true;
		        }
		    }
		    return false;
		}

	   function getEvents(id){
		var element = document.getElementById("calendar");
		element.parentNode.removeChild(element);

	    var e = document.getElementById("calendarContent");
	    var e2 = document.createElement('div');
	    e2.setAttribute("id", "calendar");
	    e.appendChild(e2);
	   	license_id = id;
	   	$('.fc-event').remove();
		    $.ajax({
		      url: 'events.php',
		      type: 'post',
		      data: {id: license_id},
		      dataType: "json",
		      success: function(data, status) {	
		      	if(data['sun_start'].toString() == "00:00:00"){
		      		data['sun_start'] = "23:59:58";
		      		data['sun_end'] = "23:59:59";
		      	}	  
		      	if(data['mon_start'].toString() == "00:00:00"){
		      		data['mon_start'] = "23:59:58";
		      		data['mon_end'] = "23:59:59";
		      	}
		      	if(data['tues_start'].toString() == "00:00:00"){
		      		data['tues_start'] = "23:59:58";
		      		data['tues_end'] = "23:59:59";
		      	}
		      	if(data['wed_start'].toString() == "00:00:00"){
		      		data['wed_start'] = "23:59:58";
		      		data['wed_end'] = "23:59:59";
		      	}
		      	if(data['thurs_start'].toString() == "00:00:00"){
		      		data['thurs_start'] = "23:59:58";
		      		data['thurs_end'] = "23:59:59";
		      	}
		        if(data['fri_start'].toString() == "00:00:00"){
		      		data['fri_start'] = "23:59:58";
		      		data['fri_end'] = "23:59:59";
		      	}
		      	if(data['sat_start'].toString() == "00:00:00"){
		      		data['sat_start'] = "23:59:58";
		      		data['sat_end'] = "23:59:59";
		      	}  
				$('#calendar').fullCalendar({
				    defaultDate: moment(),
				    header: {
				        left: 'month,agendaWeek,agendaDay',
				        center: 'title',
				        right: 'prev,next today'
				    },
				    defaultView: 'month',
				    	      
				  slotEventOverlap:false,
				  editable: true,
			      selectable: true,
			      defaultView: 'agendaWeek',
			      events: [{
				  		id: "hours",
				  		rendering: 'background',
				        title:"Monday Hours",
				        start: data['mon_start'], 
				        end: data['mon_end'], 
				        editable: false,
				        dow: [ 1 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['mon_start'],
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 1 ] 
					},
					{
				    	id: "out",
				    	start: data['mon_end'],
						end: "23:59:59",
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 1 ] 
					},
				    {
				    	id: "hours",
				  		rendering: 'background',
				        title:"Tuesday Hours",
				        start: data['tues_start'], 
				        end: data['tues_end'], 
				        editable: false,
				        dow: [ 2 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['tues_start'],
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 2 ] 
					},
					{
				    	id: "out",
				    	start: data['tues_end'],
						end: "23:59:59",
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 2 ] 
					},
				    {
				    	id: "hours",
				  		rendering: 'background',
				        title:"Wednesday Hours",
				        start: data['wed_start'], 
				        end: data['wed_end'], 
				        editable: false,
				        dow: [ 3 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['wed_start'],
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 3 ] 
					},
									    {
				    	id: "out",
				    	start: data['wed_end'],
						end: "23:59:59",
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 3 ] 
					},
				    {
				    	id: "hours",
				  		rendering: 'background',
				        title:"Thursday Hours",
				        start: data['thurs_start'], 
				        end: data['thurs_end'], 
				        editable: false,
				        dow: [ 4 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['thurs_start'],
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 4 ] 
					},
										{
				    	id: "out",
				    	start: data['thurs_end'],
						end: "23:59:59",
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 4 ] 
					},
				    {
				    	id: "hours",
				  		rendering: 'background',
				        title:"Friday Hours",
				        start: data['fri_start'], 
				        end: data['fri_end'], 
				        editable: false,
				        dow: [ 5 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['fri_start'],
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 5 ] 
					},
										{
				    	id: "out",
				    	start: data['fri_end'],
						end: "23:59:59",
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 5 ] 
					},
				    {
				    	id: "hours",
				  		rendering: 'background',
				        title:"Saturday Hours",
				        start: data['sat_start'], 
				        end: data['sat_end'], 
				        editable: false,
				        dow: [ 6 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['sat_start'],
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 6 ] 
					},
					{
				    	id: "out",
				    	start: data['sat_end'],
						end: "23:59:59",
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 6 ] 
					},
				    {
				    	id: "hours",
				  		rendering: 'background',
				        title:"Sunday Hours",
				        start: data['sun_start'], 
				        end: data['sun_end'], 
				        editable: false,
				        dow: [ 0 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['sun_start'],
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 0 ] 
					},
										{
				    	id: "out",
				    	start: data['sun_end'],
						end: "23:59:59",
						overlap: false,
						rendering: 'background',
						color: '#ff9f89',
						editable: false,
						selectable: false,
						dow: [ 0 ] 
					}
				    ],
				  eventSources: [
				        {
				            url: 'appointments.php?id='+license_id, 
				            color: 'blue',    
				            textColor: 'white',  
				            editable: false,
				            title: 'Occupied'

				        }
				    ],
				    select: function(start, end, allDay) {
			          starttime= moment(start).format("MMMM DD, h:mm ");
			          endtime = moment(end).format("MMMM DD, h:mm ");
			          var mywhen = starttime + ' - ' + endtime;
			          //$('#createEventModal #patientName').empty();
			          $('#createEventModal #patientName').val(" ");
			          $('#createEventModal #doctor').text (data['first_name']+" "+data['last_name']);
			          $('#createEventModal #apptStartTime').val(start);
			          $('#createEventModal #apptEndTime').val(end);
			          $('#createEventModal #when').text(mywhen);
			          $( "#createEventModal" ).removeClass( "hide" ).addClass( "show" );


			          $('#submitButton').on('click', function(e){
					    e.preventDefault();
					    doSubmit(start, end);
					  });

			       }

				});
				var text = $("h2").text();
				text = text.replace('â€”', '-');
				$("h2").text(text);
		      }
		    }); // end ajax call

				function doSubmit(start, end){
					    $( "#createEventModal" ).removeClass( "show" ).addClass( "hide" );
					    console.log($('#apptStartTime').val());
					    console.log($('#apptEndTime').val());
					    //alert("form submitted");
					        
					    var eventData;
						eventData = {
							title: $('#patientName').val(),
							id: 'apt',
							start: start,
							end: end,
							color: '#ff5353', 
							constraint: 'hours',
							editable: false
						};
						if(!isOverlappingOut(eventData) && !isOverlappingOther(eventData) && !isOverlappingPatient(eventData)){
							$('#calendar').fullCalendar('renderEvent', eventData, false);
							makeAppointment($('#patientName').val(),start, end);
						}

						$('#calendar').fullCalendar('unselect');
					}
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
						<h1>Appointment Scheduler</h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section">
	    	<div class="container">
				<div class="row">
					<!-- Sidebar -->
					<div class="col-sm-4 blog-sidebar">
						<h4>Select a Hospital</h4>
						<ul class="recent-posts" id="allHospitals">
						</ul>
						<h4 class="hide" id="allDepartmentsHeader">Select a Department</h4>
						<ul class="blog-categories" id="allDepartments">
						</ul>
						<h4 class="hide" id="allDoctorsHeader">Select a Doctor</h4>
						<ul class="blog-categories" id="allDoctors">
						</ul>
					</div>
					<!-- End Sidebar -->
					<div class="col-sm-8">
						<div class="blog-post blog-single-post">
							<div class="single-post-title">
								<h3>Choose An Appointment Time</h3>
								*Green areas indicate hours the doctor is available</br>
								*Red areas indicate hours the doctor is <b>not</b> available
							</div>

							<div class="single-post-content" id="calendarContent">
								<div id="calendar"></div>
									<div id="createEventModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
									    <div class="modal-header">
									        <h3 id="myModalLabel1">Create Appointment</h3>
									    </div>
									    <div class="modal-body">
									    <form id="createAppointmentForm" class="form-horizontal">
									        <div class="control-group">
									            <label class="control-label" for="inputPatient">Reason for Appointment:</label>
									            <div class="controls">
									                <input type="text" name="patientName" id="patientName" style="margin: 0 auto;" />
									                  <input type="hidden" id="apptStartTime"/>
									                  <input type="hidden" id="apptEndTime"/>
									                  <input type="hidden" id="apptAllDay" />
									            </div>
									        </div>
									        <div class="control-group">
									        	<label class="control-label" for="doctor">Doctor:</label>
									           	<div class="controls controls-row" id="doctor" style="margin-top:5px;"></div>
									        </div>
									        <div class="control-group">
									            <label class="control-label" for="when">When:</label>
									            <div class="controls controls-row" id="when" style="margin-top:5px;">
									            </div>
									        </div>
									    </form>
									    </div>
									    <div class="modal-footer">
									        <button type="submit" class="btn btn-primary" id="submitButton" >Save</button>
									    </div>
									</div>
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