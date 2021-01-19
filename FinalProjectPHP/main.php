<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>USC Keck School of Medicine</title>
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
 		ul
 		{
 			list-style-type:none;
 			padding-left: 0;
 			
		}
		img
		{
			width:60%;
		}
		.specialty
		{
			float:left;
			width:300px;	
		}
		.doctor
		{
			border-bottom: 2px grey solid;
		}
		.btn
		{
			position: relative;
		}
		.btn .overlay {
			background-color: #990000;
			display: block;
			color: white;
			text-align: center;
			position: absolute;
			right: 0px;
			left: 0px;
			top: 0px;
			bottom: 0px;

			opacity:0;
			transition: opacity 0.5s 0s;
		}
		.btn:hover
		{
			border: none;

			animation-name: bounce;
			animation-duration: 1.7s;
			animation-delay: 0.5s;
		}
		.btn:hover p
		{
			line-height: 35px;
		}
		.btn:hover .overlay {
			opacity: 1;
		}
		@media(max-width: 768px)
		{
			img
			{
				max-width: 170px;
			}
		}
		@media(min-width: 768px)
		{
		.btn
			{
				position: absolute;
				bottom: 10px;
			}
		}
		@keyframes bounce
		{
			0%
			{
				transform: translate(0px, 0px);
			}
			30%
			{
				transform: translate(30px, 0px);
			}
			100%
			{
				transform: translate(0px, 0px);
			}
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
		    	<a class="nav-item nav-link" href="profile.php">My Profile</a>
		     	<a class="nav-item nav-link" href="logout.php">Log Out</a>
		    </div>
		</div>
	</nav>

	<div class="container-fluid main">
		<!-- Doctor Header-->
		<div class="row">
			<div class="col ml-3 mt-3">
				<h3>Available Doctors</h3>
			</div>
		</div>
		
		<!-- Doctor List -->
		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "castro" src = "images/castro.jpg" alt="Castro" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><b>M. Eugenia Castro, CCC-SLP</b></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					 	<li>Speech-Language Pathology</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
						<li>Medicine</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=1" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>

		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "hong" src = "images/hong.jpg" alt="Hong" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><strong>Kurt Hong, MD</strong></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					 	<li>Movement Disorders Neurology</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
					 	<li>Neurology</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=2" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>

		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "israel" src = "images/israel.jpg" alt="Israel" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><strong>Jennifer J. Israel, MD</strong></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					  	<li>Medical Oncology</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
					 	<li>Gynecology</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=3" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>

		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "Nune" src = "images/nune.jpg" alt="Nune" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><strong>George Nune, MD</strong></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					 	<li>Clinical Neurophysiology</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
					 	<li>Neurology</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=4" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>

		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "sahakian" src = "images/sahakian.jpg" alt="Sahakian" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><strong>Ara Sahakian, MD</strong></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					 	<li>Gastroenterology</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
					 	<li>Medicine</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=5" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>

		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "rao" src = "images/rao.jpg" alt="Rao" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><strong>Narsing A. Rao, MD</strong></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					 	<li>Anatomic Pathology</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
					 	<li>Pathology</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=6" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>

		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "bonyadlou" src = "images/bonyadlou.jpg" alt="Bonyadlou" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><strong>Sharam Bondaylou, MD</strong></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					 	<li>Cardiac Imaging</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
					 	<li>Cardiology</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=7" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>

		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "carey" src = "images/carey.jpg" alt="Carey" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><strong>Joseph Carey, MD</strong></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					 	<li>Plastic Surgery</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
					 	<li>Surgery</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=8" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>

		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "colletti" src = "images/colletti.jpg" alt="Colletti" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><strong>Patrick M. Colletti, MD</strong></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					 	<li>Nuclear Medicine</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
					 	<li>Radiology</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=9" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>

		<div class="row doctor mx-1 py-2">
			<div class="col-12 col-md-3 mr-2">
				<img id = "donovan" src = "images/donovan.jpg" alt="Donovan" class="rounded">
			</div>
			<div class="col-12 col-md-5 mt-1">
				<div class="name"> 
					<h5><strong>John A. Donovan, MD</strong></h5>
				</div>

				<div class="specialty">
					<h6><b>Specialty</b></h6>
					<ul>
					 	<li>Hepatology</li>
					</ul>
				</div>
				
				<div class="department">
					<h6><b>Department</b></h6>
					<ul>
					 	<li>Medicine</li>
					</ul>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<a href="book.php?doctor_id=10" class="btn btn-dark">Book an Appointment
					<div class="overlay">
						<p>Get Started! -></p>
					</div>
				</a>
			</div>
		</div>
	</div>

	<script>
		let doctors = document.querySelectorAll(".doctor");

		for (let i=0; i<doctors.length; i++)
		{
			doctors[i].onmouseover = function()
			{
				doctors[i].style.backgroundColor = "#DBDBDB";
			}
			doctors[i].onmouseleave = function()
			{
				doctors[i].style.backgroundColor = "white";
			}
		}
	</script>
</body>
</html>