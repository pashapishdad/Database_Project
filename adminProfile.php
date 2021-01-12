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
	require "dbh.inc.php";
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
	<h1>User profile</h1><br>
	
	<div>
		<h2>Personal information</h2>
		<?php 
			$sql = "SELECT * FROM admin WHERE aID=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: adminProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "i", $_SESSION['adminID']);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)){
					
					echo 'Username: '.$row['username'].'<br>';
					echo 'e-mail: '.$row['email'].'<br>';
				}
			}
		?>
	</div>
	<div>
		<h2>Users information</h2>
		<h3>Employers</h3>
		<?php 
			$sql = "SELECT * FROM employer";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck > 0){
				
				while($row = mysqli_fetch_assoc($result)){
					
					$eID = $row['eID'];
					
					if($row['activated'] == 1){
						$activation = 'Activated';
					}
					else{
						$activation = 'Deactivated';
					}
					
					echo 'Username: '.$row['username'].' | e-mail: '.$row['email'].' | Activation status: '.$activation;
					
					echo '<form action="changeEActivation.inc.php" method="post">
							<input type="hidden" name="eID" value ="'.$eID.'" />
							<button type="submit" name="activation-submit">Activate/Deactivate</button>
						</form><br>';
				}
			}
			else{
				header("Location: adminProfile.php?error=sqlerror");
				exit();
			}
		?>
		<h3>Users</h3>
		<?php 
			$sql = "SELECT * FROM user";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			
			if($resultCheck > 0){
				while($row = mysqli_fetch_assoc($result)){
					
					$uID = $row['uID'];
					
					if($row['activated'] == 1){
						$activation = 'Activated';
					}
					else{
						$activation = 'Deactivated';
					}
					
					echo 'Username: '.$row['username'].' | e-mail: '.$row['email'].' | Activation status: '.$activation;
					
					echo '<form action="changeUActivation.inc.php" method="post">
							<input type="hidden" name="uID" value ="'.$uID.'" />
							<button type="submit" name="activation-submit">Activate/Deactivate</button>
						</form><br>'; 
				}
			}
			else{
				header("Location: adminProfile.php?error=sqlerror");
				exit();
			}
		?>
	</div>
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