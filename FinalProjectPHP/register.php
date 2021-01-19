<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
 	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@500&family=PT+Serif&display=swap" rel="stylesheet">
 	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
 	<style>
 		.format
 		{
 			font-size: 18px;
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
		     	<a class="nav-item nav-link" href="login.php">Log in</a>
		    	<a class="nav-item nav-link active" href="register.php">Register<span class="sr-only">(current)</span></a>
		    </div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row justify-content-center align-items-center ">
			<div class="col-8 welcome text-center mt-4">
				<h3>Welcome to <span class="span"><strong>USC</strong></span> Keck School of Medicine!</h3>
			</div>
		</div>
	</div>

	<div class="container format">
		<div class="row">
			<div class="col text-center">
				<h4>Register</h4><hr>
			</div>
		</div>
		<form action="register_confirmation.php" method="POST">
			<!-- Name -->
			<div class="row justify-content-center">
				<label for="name-id" class="col-10 col-md-8 col-form-label">
					<strong>Full Name</strong>
				</label>
			</div>
			<div class="row justify-content-center">
				<div class="col-10 col-md-8">
					<input type="text" class="form-control" id="name-id" name="name" placeholder="Tommy Trojan">
				</div>
			</div>

			<!-- Date of Birth -->
			<div class="row justify-content-center">
				<label for="dob-id" class="col-10 col-md-8 col-form-label">
					<strong>Date of Birth</strong>
				</label>
			</div>
			<div class="row justify-content-center">
				<div class="col-10 col-md-8">
					<input type="date" class="form-control" id="dob-id" name="dob">
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
					<button type="submit" class="btn btn-dark">Register</button>
				</div>
			</div> 
		</form>
	</div>

	<script>
		//Client-side Authentication
		document.querySelector('form').onsubmit = function(e)
		{
			//if one of the fields is empty
			if (document.querySelector('#username-id').value.trim().length == 0 || document.querySelector('#password-id').value.trim().length == 0 || document.querySelector('#dob-id').value.trim().length == 0 || document.querySelector('#name-id').value.trim().length == 0) 
			{
				e.preventDefault();
				alert("Fill out all fields");
			}
		}
	</script>
</body>
</html>