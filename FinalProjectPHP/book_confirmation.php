<?php
	require 'config.php';

if ( !isset($_GET['appt-time']) || empty($_GET['appt-time']) ) {
	$error = "Please fill out your appointment time.";
}

else
{
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno)
	{
		echo $mysqli->connect_error;
		exit();
	}

	//Add the appointment into DB
	$statement = $mysqli->prepare("INSERT INTO appointments(patient_id, time, doctor_id) VALUES (?, ?, ?)");
	$statement->bind_param("isi", $_SESSION['id'], $_GET['appt-time'], $_GET['doctor_id']);

	$executed = $statement->execute();
	if(!$executed) {
		echo $mysqli->error;
	}

	$statement->close();

	// fetch the info add it to session as well
	$sql = "SELECT * FROM appointments
				WHERE patient_id = " . $_SESSION['id'] . ";";
			
			$results = $mysqli->query($sql);

			if(!$results) {
				echo $mysqli->error;
				exit();
			}
	$_SESSION["doctor_id"] = $_GET['doctor_id'];
	$row = $results->fetch_assoc();

	//Update the patient's doctor/appointment info
	$stmt = $mysqli->prepare("UPDATE patients SET doctor_id = ?, appointment_id = ? WHERE id = " . $_SESSION['id'] . ";");
	$stmt->bind_param("ii", $_GET['doctor_id'], $row["id"]);

	$run = $stmt->execute();
	if(!$run) {
		echo $mysqli->error;
	}

	$stmt->close();

	// Update Session
	$_SESSION["doctor_id"] = $_GET['doctor_id'];

	$mysqli->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Booking Confirmation</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
 	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@500&family=PT+Serif&display=swap" rel="stylesheet">
 	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
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
		     	<a class="nav-item nav-link" href="profile.php">My Profile</a>
		    	<a class="nav-item nav-link" href="logout.php">Log out</a>
		    </div>
		</div>
	</nav>

	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"> Your Appointment at <?php echo $_GET['appt-time']; ?> was successfully booked.</div>
				<?php endif; ?>
			</div> 
		</div> 

		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="main.php" role="button" class="btn btn-dark my-1">Back to main</a>
			</div> 
		</div> 
	</div>

</body>
</html>