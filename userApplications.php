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
	<h1>User Applications</h1><br>
	
	<div>
		
		<?php 
			$sql = "SELECT * FROM job WHERE user_uID=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: userApplications.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)){
					
					echo 'Name: '.$row['name'].'<br>';
					echo 'Description: '.$row['description'].'<br>';
					echo 'Category: '.$row['category'].'<br>';
					echo 'Salary: '.$row['salary'].'$<br>';
					$accept = $row['accept'];
					if($accept == 0){
						$status = 'no response';
					}
					else if($accept == 1){
						$status = 'employer offer received';
					}
					else if($accept == 2){
						$status = 'employer offer accepted';
					}
					else if($accept == 3){
						$status = 'employer offer denied';
					}
					echo 'Status: '.$status.'<br>';
					
					echo '<form action="withdrawApplication.inc.php" method="post">
							<input type="hidden" name="jID" value="'.$row['jID'].'"/>
							<button type="submit" name="withdraw-submit">Withdraw application</button>
						</form><br>';
				}	
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
