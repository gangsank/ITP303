<?php
if ( !isset($_GET['id']) || empty($_GET['id']) 
		|| !isset($_GET['doctor_id']) || empty($_GET['doctor_id']) ) 
{
	$error = "Appointment does not exist";
} 
else 
{
	require 'config.php';

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	// Delete the appointmend id and doctor id from patient first
	$sql = "UPDATE patients SET doctor_id = null, appointment_id = null WHERE id = " . $_GET['id'] . ";";

	$results = $mysqli->query($sql);

	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	// Delete the appointment
	$stmt = $mysqli->prepare("DELETE FROM appointments WHERE patient_id = ? AND doctor_id = ?");
	$stmt->bind_param("ii", $_GET['id'], $_GET['doctor_id']);

	$run = $stmt->execute();
	if(!$run) {
		echo $mysqli->error;
	}

	$stmt->close();

	//Update session
	$_SESSION["doctor_id"] = null;
	$_SESSION["appt"] = null;

	$mysqli->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Delete Confirmation</title>
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
		    	<a class="nav-item nav-link" href="profile.php">My Profile</span></a>
		     	<a class="nav-item nav-link" href="login.php">Log Out</a>
		    </div>
		</div>
	</nav>

	<?php if(isset($error) && !empty($error) ) : ?>
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<div class="text-danger"><?php echo $error; ?></div>
				<a href="main.php" role="button" class="btn btn-dark my-1">Back to main</a>
			</div> 
		</div>
	</div> 

	<?php else : ?>
	<div class="container">
		<div class="row mt-4">
			<div class="col-12 text-success">
				<div class="text-success">Appointment Succeesfully Deleted</div>
				<a href="main.php" role="button" class="btn btn-dark my-1">Back to main</a>
			</div> 
		</div> 
	</div>
	<?php endif; ?>
</body>
</html>