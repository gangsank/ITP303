<?php
	require 'config.php';

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno)
	{
		echo $mysqli->connect_error;
		exit();
	}

	// look for the patient's appointment info
	if($_SESSION["doctor_id"] != null) 
	{
		$sql = "SELECT appointments.id, patient_id ,time,  doctors.name AS doctor
				FROM appointments
				LEFT JOIN doctors  
					ON appointments.doctor_id = doctors.id
				LEFT JOIN patients
					ON appointments.patient_id = patients.id
				WHERE doctors.id = " . $_SESSION['doctor_id'] . " AND patients.id = " . $_SESSION['id'] . ";";
			
		$results = $mysqli->query($sql);

		if(!$results) {
			echo $mysqli->error;
			exit();
		}

		//if the user does have a booked appointment
		if($results->num_rows > 0 ) {
			$row = $results->fetch_assoc();
		}
	}
	$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>My Profile</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
 	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@500&family=PT+Serif&display=swap" rel="stylesheet">
 	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
 	<style>
 		.info
 		{
 			font-size: 22px;
 		}
 		.btn
 		{
 			margin-left: 3px;
 		}
 	</style>
</head>
<body>
	<!-- Navbar-->
	<nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark">
	 	<a class="navbar-brand" href="main.php"><span class="span"><strong>USC</strong></span> Keck<br>School of Medicine</a>
	 		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  		</button>
	 	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		    <div class="navbar-nav ml-auto text-right">
		    	<div class="nav-item nav-link">
		    		<?php if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) : ?>
		    			<div class="header">Welcome, <?php echo $_SESSION["name"]; ?></div>
					<?php endif; ?>
				</div>
		    	<a class="nav-item nav-link active" href="profile.php">My Profile<span class="sr-only">(current)</span></a>
		     	<a class="nav-item nav-link" href="logout.php">Log Out</a>
		    </div>
		</div>
	</nav>

	<div class="container format mt-5">
		<div class="row">
			<div class="col text-center">
				<h3>My Profile</h3><hr>
			</div>
		</div>

		<!-- Full Name -->
		<div class="row info justify-content-center">
			<div class="col-10 mx-1">
				<b>Full Name:</b> <?php echo $_SESSION["name"]; ?>
			</div>
		</div>

		<!-- Username -->
		<div class="row info justify-content-center">
			<div class="col-10 mx-1">
				<b>Username:</b> <?php echo $_SESSION["username"]; ?>
			</div>
		</div>

		<!-- Date of Birth -->
		<div class="row info justify-content-center">
			<div class="col-10 mx-1">
				<b>Date of Birth:</b> <?php echo $_SESSION["dob"]; ?>
			</div>
		</div>

		<!-- Currently Booked -->
		<div class="row info justify-content-center">
			<div class="col-10 mx-1">
				<b>Currently Booked Appointment:</b>
				<?php if($_SESSION["doctor_id"] != null) : ?>
		    		<div class> You have an appointment at <?php echo $row["time"]; ?> with <?php echo $row["doctor"]; ?></div>
		    	<?php else :?>
		    		None
				<?php endif; ?>
			</div>
		</div>

		<?php if($_SESSION["doctor_id"] != null) : ?>
		<div class="row mt-2 justify-content-end">
			<div class="col-8 text-right">
				<a href="delete_confirmation.php?id=<?php echo $_SESSION['id']; ?>&doctor_id=<?php echo $_SESSION['doctor_id'];?>" class="btn btn-outline-danger my-1" onclick="return confirm('Do you really want to delete your appointment?')">
					Delete Appointment
				</a>
			</div>
		</div>

		<div class="row justify-content-end">
			<div class="col-8 text-right">
				<a href="edit.php?id=<?php echo  $_SESSION['id']; ?>&doctor_id=<?php echo $_SESSION['doctor_id'];?>" class="btn btn-outline-info my-1">
					Edit Appointment
				</a>
			</div>
		</div>
		<?php endif; ?>

		<div class="row justify-content-end">
			<div class="col-8 text-right">
				<a href="main.php" role="button" class="btn btn-dark my-1">Back to Main</a>
			</div>
		</div> 
	</div>
</body>
</html>