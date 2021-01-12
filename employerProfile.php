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
	<h1>Employer profile</h1><br>
	
	<div>
		<h2>Personal information</h2>
		<?php 
			$sql = "SELECT * FROM employer WHERE eID=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: employerProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while($row = mysqli_fetch_assoc($result)){
					
					echo 'Username: '.$row['username'].'<br>';
					
					echo '<form action="changeUsername.inc.php" method="post">
							<label for="method">Change username:</label><br>
							<input type="text" name="username" placeholder="New username"/>
							<button type="submit" name="username-submit">Update</button>
						</form><br>';
						
						
					echo 'e-mail: '.$row['email'].'<br>';
					
					echo '<form action="changeEmail.inc.php" method="post">
							<label for="method">Change e-mail:</label><br>
							<input type="text" name="username" placeholder="New e-mail"/>
							<button type="submit" name="email-submit">Update</button>
						</form><br>';
				}
				
				
				$sql = "SELECT * FROM employerCategory WHERE eID=?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: employerProfile.php?error=sqlerror");
					exit();
				}
				else{
					
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					while($row = mysqli_fetch_assoc($result)){
					
						echo 'Category: '.$row['category'].'<br>';
						echo 'Charge: '.$row['charge'].'<br><br>';
						
						echo '<form action="changeCategory.inc.php" method="post">
							<label for="category">Change category:</label><br>
							<select id="category" name="category"><br>
								<option value="Basic">Basic</option>
								<option value="Prime">Prime</option>
								<option value="Gold">Gold</option>
							</select>
							<button type="submit" name="category-submit">Update</button>
						</form><br>';
					}
					
					$sql = "SELECT * FROM account WHERE employer_eID=?";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: userProfile.php?error=sqlerror");
						exit();
					}
					else{
					
						mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						while($row = mysqli_fetch_assoc($result)){
					
							echo 'Credit card number: '.$row['credit_card_number'].'<br>';
							
							echo '<form action="changeCredit.inc.php" method="post">
								<label for="method">Change/Add credit card number:</label><br>
								<input type="text" name="credit" placeholder="Credit card number"/>
								<button type="submit" name="credit-submit">Update</button>
							</form><br>';
							
							
							echo 'Checking account number: '.$row['checking_account_number'].'<br>';
							
							echo '<form action="changeChecking.inc.php" method="post">
								<label for="method">Change/Add checking account number:</label><br>
								<input type="text" name="checking" placeholder="Cheking account number"/>
								<button type="submit" name="checking-submit">Update</button>
							</form><br>';
							
							
							echo 'Withdrawal method: '.$row['withdrawal_method'].'<br><br>';
							
							echo '<form action="changeMethod.inc.php" method="post">
								<label for="method">Change withdrawal method:</label><br>
								<select id="method" name="method"><br>
									<option value="automatic">Automatic</option>
									<option value="manual">Manual</option>
								</select>
								<button type="submit" name="method-submit">Update</button>
							</form><br>';
						}
						
					}
				}
			}
		?>
		<form action="delete.inc.php" method="POST" onsubmit="confirm('Are you sure you want to delete your account?');">
			<input type="submit" name="delete" value="Delete account" />
		</form>
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
