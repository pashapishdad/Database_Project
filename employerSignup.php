<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Web Careers</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">
			<button class="navbar-toggler" type="button" data-toggle="collapse" 
				data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav mx-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#"></a>
				</li>
				<li class="nav-item active">
<!--HEADER STARTS-->
<?php
	require "header.php";
?>

<!--HEADER ENDS-->
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="row jumbotron">
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
		<p class="lead">
	
<!--PHPBODY STARTS-->

	<main>
	<h1>Sign up as employer</h1>
		<?php 
			if(isset($_GET['error'])){
				if($_GET['error'] == "emptyfields"){
					echo '<p>Fill in all fields!</p>';
				}
				else if($_GET['error'] == "invalidmailuid"){
					echo '<p>Invalid username and e-mail!</p>';
				}
				else if($_GET['error'] == "invaliduid"){
					echo '<p>Invalid username!</p>';
				}
				else if($_GET['error'] == "invalidmail"){
					echo '<p>Invalid e-mail!</p>';
				}
				else if($_GET['error'] == "passwordcheck"){
					echo '<p>Your passwords do not match!</p>';
				}
				else if($_GET['error'] == "usertaken"){
					echo '<p>Username is already taken!</p>';
				}
			}
			else if(isset($_GET['signup'])){
				
				echo '<p>Sign up successful!</p>';
			}
		?>
		<form action="employerSignup.inc.php" method="post">
			<input type="text" name="uid" placeholder="Username"><br>
			<input type="text" name="mail" placeholder="E-mail"><br>
			<input type="password" name="pwd" placeholder="Password"><br>
			<input type="password" name="pwd-repeat" placeholder="Repeat password"><br><br>
			<label for="category">Choose a category:</label><br>
			<select id="category" name="category"><br>
				<option value="Prime">Prime</option>
				<option value="Gold">Gold</option>
			</select><br><br>
			<button type="submit" name="signup-submit">Sign up</button>
		</form>
	</main>
<!--PHPBODY ENDS-->
		</p>
	</div>
</div>



<!--- Footer -->
<footer>
<div class="container-fluid padding">
<div class="row text-center">
	<div class="col-12">
		<?php
	require "footer.php"
?>
	</div>
</div>
</div>	
</footer>



</body>
</html>

