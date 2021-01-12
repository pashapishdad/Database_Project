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
                    <!--HEADER GOES HERE-->
<?php
	require "header.php";
?>
                    <!--HEADER ENDS-->
				</li>
			</ul>
		</div>
	</div>
</nav>

<!--BODY-->
<div class="row jumbotron">
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
		<p class="lead">
	
        <!--PHPBODY-->
	<main>
	<h1>Search for a job</h1>
		<?php 
			if(isset($_GET['error'])){
				if($_GET['error'] == "emptyfield"){
					echo '<p>Fill in all fields!</p>';
				}
				else if($_GET['error'] == "noresult"){
					echo '<p>No result!</p>';
				}
			}
		?>
		<form action="search.inc.php" method="post">
			<input type="text" name="search" placeholder="Search for a job">
			<button type="submit" name="search-submit">Search</button>
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
