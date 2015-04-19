<?php
session_start();//starting session
$id;
if(isset($_SESSION['id'])){
	if($_SESSION['type'] == 1){
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
        	getData();

    	});
        var hospital;
        var department;
        var id  = <?php echo $id;?>;//////////////////////////////Need to update with login session info 
        var events;
        //$('#calendar').fullCalendar( 'refresh' );//going to have to call when update choices
        </script>
        <script type="text/javascript">
        function getData(){
        	$.ajax({
		      url: 'appointmentsDoctor.php',
		      type: 'get',
		      data: {'id':id },
		      		      dataType: "json",
		      success: function(data, status) {
		      	//var obj = data;
		      	var d = "text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(data));
		      	$('<a href="data:' + d + '" download="data.json" class="download">Download JSON</a>').appendTo('#download');
		      }
		    });
        }
	    function cancelAppointment(id, start, end){
	    	$.ajax({
		      url: 'cancelAppointment.php',
		      type: 'post',
		      data: {'id':id,
		      		'start': moment(start).format('YYYY-MM-DD HH:mm:00'),
		  			'end': moment(end).format('YYYY-MM-DD HH:mm:00'), },
		      success: function(data, status) {
		      }
		    });

	    }
	    function updateHours(start, end){
	    	var d = new Date(start);
	    	var dayStart; 
	    	var dayEnd;
	    	if(d.getDay() == 1){
	    		dayStart = 'mon_start';
	    		dayEnd = 'mon_end';
	    	}else if(d.getDay() ==2){
	    		dayStart = 'tues_start';
	    		dayEnd = 'tues_end';
	    	}else if(d.getDay() ==3){
	    		dayStart = 'wed_start';
	    		dayEnd = 'wed_end';
	    	}else if(d.getDay() ==4){
	    		dayStart = 'thurs_start';
	    		dayEnd = 'thurs_end';
	    	}else if(d.getDay() ==5){
	    		dayStart = 'fri_start';
	    		dayEnd = 'fri_end';
	    	}else if(d.getDay() ==6){
	    		dayStart = 'sat_start';
	    		dayEnd = 'sat_end';
	    	}else if(d.getDay() ==0){
	    		dayStart = 'sun_start';
	    		dayEnd = 'sun_end';
	    	}
	    	$.ajax({
		      url: 'updateHours.php',
		      type: 'post',
		      data: {'id':id,
		      		'start': moment(start).format('YYYY-MM-DD HH:mm:00'),
		  			'end': moment(end).format('YYYY-MM-DD HH:mm:00'), 
		  			'dayStart': dayStart,
		  			'dayEnd': dayEnd},
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
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "hours0" );
		    for(i in array){
		        if (event == array[i]){
		           return true;
		        }
		    }
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "hours1" );
		    for(i in array){
		        if (event == array[i]){
		           return true;
		        }
		    }
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "hours2" );
		    for(i in array){
		        if (event == array[i]){
		           return true;
		        }
		    }
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "hours3" );
		    for(i in array){
		        if (event == array[i]){
		           return true;
		        }
		    }
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "hours4" );
		    for(i in array){
		        if (event == array[i]){
		           return true;
		        }
		    }
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "hours5" );
		    for(i in array){
		        if (event == array[i]){
		           return true;
		        }
		    }
		    var array = $('#calendar').fullCalendar( 'clientEvents' , "hours6" );
		    for(i in array){
		        if (event == array[i]){
		           return true;
		        }
		    }
		    return false;
		}

	   function getEvents(){
	   	$('.fc-event').remove();
		    $.ajax({
		      url: 'events.php',
		      type: 'post',
		      data: {id: id},
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
				  		id: "hours1",
				        title:"Monday Hours",
				        start: data['mon_start'], 
				        end: data['mon_end'], 
				        editable: true,
				        dow: [ 1 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['mon_start'],
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 1 ] 
					},
					{
				    	id: "out",
				    	start: data['mon_end'],
						end: "23:59:59",
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 1 ] 
					},
				    {
				    	id: "hours2",
				        title:"Tuesday Hours",
				        start: data['tues_start'], 
				        end: data['tues_end'], 
				        editable: true,
				        dow: [ 2 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['tues_start'],
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 2 ] 
					},
					{
				    	id: "out",
				    	start: data['tues_end'],
						end: "23:59:59",
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 2 ] 
					},
				    {
				    	id: "hours3",
				        title:"Wednesday Hours",
				        start: data['wed_start'], 
				        end: data['wed_end'], 
						editable: true,
				        dow: [ 3 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['wed_start'],
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 3 ] 
					},
									    {
				    	id: "out",
				    	start: data['wed_end'],
						end: "23:59:59",
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 3 ] 
					},
				    {
				    	id: "hours4",
				        title:"Thursday Hours",
				        start: data['thurs_start'], 
				        end: data['thurs_end'], 
				        editable: true,
				        dow: [ 4 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['thurs_start'],
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 4 ] 
					},
										{
				    	id: "out",
				    	start: data['thurs_end'],
						end: "23:59:59",
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 4 ] 
					},
				    {
				    	id: "hours5",
				        title:"Friday Hours",
				        start: data['fri_start'], 
				        end: data['fri_end'], 
				        editable: true,
				        dow: [ 5 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['fri_start'],
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 5 ] 
					},
										{
				    	id: "out",
				    	start: data['fri_end'],
						end: "23:59:59",
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 5 ] 
					},
				    {
				    	id: "hours6",
				        title:"Saturday Hours",
				        start: data['sat_start'], 
				        end: data['sat_end'], 
				        editable: true,
				        dow: [ 6 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['sat_start'],
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 6 ] 
					},
					{
				    	id: "out",
				    	start: data['sat_end'],
						end: "23:59:59",
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 6 ] 
					},
				    {
				    	id: "hours0",
				        title:"Sunday Hours",
				        start: data['sun_start'], 
				        end: data['sun_end'], 
				        editable: true,
				        dow: [ 0 ] 
				    },
				    {
				    	id: "out",
				    	start: '00:00:00',
						end: data['sun_start'],
						 
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 0 ] 
					},
										{
				    	id: "out",
				    	start: data['sun_end'],
						end: "23:59:59",
						rendering: 'background',
						color: '#ff9f89',
						dow: [ 0 ] 
					}
				    ],
				  eventSources: [
				        {
				            url: 'appointmentsDoctor.php?id='+id, 
				            color: 'blue',    
				            textColor: 'white',  
				            editable: false

				        }
				    ],
				    eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) { 
				    	if(myEvent(event)){
				    		updateHours(event.start, event.end);
				    		//$('#stuff').html("sent");
				    	}else{
				    		//$('#stuff').html("not");
				    	}

				    }

				});
				var text = $("h2").text();
				text = text.replace('â€”', '-');
				$("h2").text(text);
		      }
		    }); // end ajax call
	   }

	   getEvents();
        </script>
    </head>
    <body>

    	<div id="header"></div>
    	<script type="text/javascript">showHeaderDoctor();</script>

        <!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>View Appointments</h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section">
	    	<div class="container">
				<div class="row">
					<div class="holder">
						<div class="blog-post blog-single-post">
							<div class="single-post-title">
								<h3>View Appointments</h3>
							</div>
							<div id="download"></div>
							<div id="stuff"></div>
							<div class="single-post-content" id="calendarContent">
								<div id="calendar"></div>
					
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