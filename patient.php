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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>myHealthcare</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/icomoon-social.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/leaflet.css" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="css/main.css">

        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="js/javascript.js"></script>
   </head>
    <body>


    	<div id="header"></div>
    	<script type="text/javascript">showHeaderPatient();</script>
    	<!-- <script type="text/javascript">showHeaderDoctor();</script> -->
	    
	<!-- Content-->
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

	<div class="container">
		<div class="container">
  <div class="row">
    <div class="col-md-8 col-xs-10 col-md-offset-2">
      <div class="well panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 col-sm-4 text-center">
              <img src="http://d13beo3f7vpmvd.cloudfront.net/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png" alt="" class="center-block img-circle img-thumbnail img-responsive">
              <ul class="list-inline ratings text-center" title="Ratings">
                <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
              </ul>
            </div>
            <!--/col--> 
            <div class="col-xs-12 col-sm-8">
              
		<?php
		include_once("./users.php");
		$db_connection = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
		if (mysqli_connect_errno()) {
			echo("Can't connect to MySQL Server. Error code: " .  mysqli_connect_error());
			return null;
		}
		$stmt = $db_connection->stmt_init();
 		if($stmt->prepare("SELECT * FROM patient WHERE patient_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
    			$stmt->execute();
    			$stmt->bind_result($blood_type, $weight, $height, $patient_id, $first_name, $last_name, $middle_name, $email, $dob, $address);
			while($stmt->fetch()){
				echo "<table class=\"table\">";
		        	echo "<tr><td><b>Patient ID:</b></td> <td>$patient_id</td> </tr>";
		       		echo " <tr><td><b>First Name:</b></td> <td>$first_name</td> </tr>";
		     	   	echo " <tr><td><b>Middle Name:</b></td><td>$middle_name</td> </tr>";
		    	    	echo " <tr><td><b>Last Name:</b></td> <td>$last_name</td> </tr>";
		        	echo " <tr><td><b>Blood Type:</b></td> <td>$blood_type</td> </tr>";
		        	echo " <tr><td><b>Weight:</b></td> <td>$weight</td> </tr>";
		        	echo " <tr><td><b>Height:</b></td> <td>$height</td> </tr>";
       		 		echo " <tr><td><b>DOB:</b></td> <td>$dob</td> </tr>";
				echo " <tr><td><b>Email:</b></td> <td>$email</td> </tr>";
			        echo " <tr><td><b>Address:</b></td> <td>$address</td> </tr>";
				
				if($stmt->prepare("SELECT medication FROM medication WHERE patient_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
		         		$stmt->execute();
          				$stmt->bind_result($medication);
          				echo " <tr><td><b>Medication:</b></td></tr>";
          				while ($stmt->fetch()) {
            					echo "<tr><td></td><td>$medication</td></tr>";
          				}
        			}		
        			if($stmt->prepare("SELECT allergy FROM allergy WHERE patient_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
          				$stmt->execute();
          				$stmt->bind_result($allergy);
          				echo " <tr><td><b>Allergies:</b></td></tr>";
          				while ($stmt->fetch()) {
            					echo "<tr><td></td><td>$allergy</td></tr>";
          				}
				}
        			if($stmt->prepare("SELECT phone_number FROM patient_phone WHERE patient_id='$id'") or die("<br/>Error Building Query!<br/>" . mysqli_error($db_connection))) {
          				$stmt->execute();
          				$stmt->bind_result($phone);
          				echo " <tr><td><b>Phone:</b></td></tr>";
          				while ($stmt->fetch()) {
            					echo "<tr><td></td><td>$phone</td></tr>";
          				}
        			}





				
				echo "</table>";
     			}
    			$stmt->close();
  		}
  		$db_connection->close();
		?>


            </div>
            <!--/col-->          
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-4">
              <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> View Doctors </button>
            </div>
            <!--/col-->
            <div class="col-xs-12 col-sm-4">
              <button class="btn btn-info btn-block"><span class="fa fa-user"></span> Make Appointments </button>
            </div>
            <!--/col-->
            <div class="col-xs-12 col-sm-4">
              <button type="button" class="btn btn-primary btn-block"><span class="fa fa-gear"></span> View Appointments </button>  
            </div>
            <!--/col-->
          </div>
          <!--/row-->
        </div>
        <!--/panel-body-->
      </div>
      <!--/panel-->
    </div>
    <!--/col--> 
  </div>
  <!--/row--> 
</div>
<!--/container-->	
	</div>
	
	<!-- END CONTENT-->


<!-- Footer -->
	    <div id="footer"></div>
	    <script>showFooter();</script>

        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="js/jquery.fitvids.js"></script>
        <script src="js/jquery.sequence-min.js"></script>
        <script src="js/jquery.bxslider.js"></script>
        <script src="js/main-menu.js"></script>
        <script src="js/template.js"></script>

    </body>
</html>
