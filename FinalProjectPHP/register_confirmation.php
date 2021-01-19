<?php
require 'config.php';

if ( !isset($_POST['name']) || empty($_POST['name'])
	|| !isset($_POST['dob']) || empty($_POST['dob'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all required fields.";
}

else
{
	//connect to the db with mysqli
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno)
	{
		echo $mysqli->connect_error;
		exit();
	}

	// Check if username is already taken
	$sql_duplicate = "SELECT * FROM patients
	WHERE username = '" .$_POST["username"] . "';";

	$results_duplicate = $mysqli->query($sql_duplicate);
	if(!$results_duplicate)
	{
		echo $mysqli->error;
		exit();
	}

	if($results_duplicate->num_rows > 0)
	{
		$error = "Username has been already taken. Please try a different one";
	}

	//Add the user into DB
	else
	{
	$password = hash("sha256", $_POST["password"]);
	$statement = $mysqli->prepare("INSERT INTO patients(name, dob, username, password) VALUES (?, ?, ? ,?)");
	$statement->bind_param("ssss", $_POST['name'], $_POST['dob'], $_POST['username'], $password);

	$executed = $statement->execute();
	if(!$executed) {
		echo $mysqli->error;
	}

	$statement->close();
}

	$mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Confirmation</title>
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
	 	<a class="navbar-brand" href="#"><span class="span"><strong>USC</strong></span> Keck<br>School of Medicine</a>
	 		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  		</button>
	 	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		    <div class="navbar-nav ml-auto text-right">
		     	<a class="nav-item nav-link" href="login.php">Log in</a>
		    	<a class="nav-item nav-link active" href="register.php">Register<span class="sr-only">(current)</span></a>
		    </div>
		</div>
	</nav>

	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['name']; ?> with a username "<?php echo $_POST['username']; ?>" was successfully registered.</div>
				<?php endif; ?>
			</div> 
		</div> 

		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="register.php" role="button" class="btn btn-dark my-1">Back</a>
				<a href="login.php" role="button" class="btn btn-info my-1">Log In</a>
			</div> 
		</div> 
	</div>

</body>
</html>