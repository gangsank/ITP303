<?php
require 'config.php';

if( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
	//Server-side Authentication
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		// User left one of the fields empty
		if ( empty($_POST['username']) || empty($_POST['password']) ) {
			$error = "Please enter username and password.";
		}
		else {
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			$passwordInput = hash("sha256", $_POST["password"]);

			$sql = "SELECT * FROM patients
						WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";
			
			$results = $mysqli->query($sql);

			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			if($results->num_rows == 1) {
				$row = $results->fetch_assoc();
				$_SESSION["id"] = $row["id"];
				$_SESSION["name"] = $row["name"];
				$_SESSION["dob"] = $row["dob"];
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["doctor_id"] = $row["doctor_id"];
				$_SESSION["logged_in"] = true;
				header("Location: main.php");
			}
			else {
				$error = "Invalid username or password.";
			}
		} 
	}
}

else {
	header("Location: main.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Log In</title>
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
 	<style>
 		.format
 		{
 			font-size: 22px;
 		}
 	</style>
</head>

<body>
	<!-- Navbar-->
	<nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark">
	 	<a class="navbar-brand" href="#"><span class="span"><strong>USC</strong></span> Keck<br>School of Medicine</a>
	 		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  		</button>
	 	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		    <div class="navbar-nav ml-auto text-right">
		     	<a class="nav-item nav-link active" href="login.php">Log in<span class="sr-only">(current)</span></a>
		    	<a class="nav-item nav-link" href="register.php">Register</a>
		    </div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row justify-content-center mx-2 mt-4">
			<div class="col welcome text-center">
				<h3>Welcome to <span class="span"><strong>USC</strong></span> Keck School of Medicine!</h3>
			</div>
		</div>
	</div>

	<div class="container-fluid format">
		<div class="row justify-content-center align-items-center">
			<div class="col text-center">
				<h3>Log In</h3><hr>
			</div>
		</div>
		<form action="login.php" method="POST">
			<div class="row mb-3">
				<div class="font-italic text-danger col-sm-9 ml-sm-auto">
					<?php
						if ( isset($error) && !empty($error) ) {
							echo $error;
						}
					?>
				</div>
			</div> 

			<!-- Username -->
			<div class="row justify-content-center">
				<label for="username-id" class="col-10 col-md-8 col-form-label"><strong>Username</strong></label>
			</div>
			<div class="row justify-content-center">
				<div class="col-10 col-md-8">
					<input type="text" class="form-control" id="username-id" name="username" placeholder="username">
				</div>
			</div>

			<!-- Password -->
			<div class = "row justify-content-center">
				<label for="password-id" class="col-10 col-md-8 col-form-label"><strong>Password</strong></label>
			</div>
			<div class="row justify-content-center">
				<div class="col-10 col-md-8">
					<input type="password" class="form-control" id="password-id" name="password" placeholder="password">
				</div>
			</div>

			<div class="row mt-2 justify-content-center">
				<div class="col-10 col-md-8 mt-2 text-right">
					<button type="submit" class="btn btn-dark">Log In</button>
				</div>
			</div> 
		</form>

		<div class="row justify-content-center mt-2">
			<div class="col-10 col-md-8 text-center">
				Not a member? <a href="register.php">Sign up here</a>
			</div>
		</div>
	</div>
	
	<script>
		//Client-side Authentication
		document.querySelector('form').onsubmit = function(e)
		{
			//if one of the fields is empty
			if (document.querySelector('#username-id').value.trim().length == 0 || document.querySelector('#password-id').value.trim().length == 0) 
			{
				e.preventDefault();
				alert("Fill out all fields");
			}
		}
	</script>

</body>
</html>