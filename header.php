<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="this is an example of a meta description. This will often show up in search results.">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
	
		<header>
			<nav>
				<ul>
					<?php 
						if(isset($_SESSION['userID'])){
							echo'<li><a href="index.php">Home</a></li>
							<li><a href="userProfile.php">User profile</a></li>
							<li><a href="userApplications.php">Current applications</a></li>
							<li><a href="search.php">Search</a></li>
                            <li><a href="searchCat.php">Search by category</a></li>';
						}
						else if(isset($_SESSION['employerID'])){
							echo'<li><a href="index.php">Home</a></li>
							<li><a href="employerProfile.php">Employer profile</a></li>
							<li><a href="currentApplication.php">Current application</a></li>
							<li><a href="postJobs.php">Post jobs</a></li>
							<li><a href="contact.php">Contact Us<a/></li>';
						}
						else if(isset($_SESSION['adminID'])){
							echo'<li><a href="index.php">Home</a></li>
							<li><a href="adminProfile.php">Admin profile</a></li>';
						}
						else{
							echo'<li><a href="index.php">Home</a></li>';
						}
					?>
				</ul>
			</nav>
			<div>
					<?php 
						if(isset($_SESSION['username'])){
							echo '<form action="logout.inc.php" method="post">
								<button type="submit" name ="logout-submit">Logout</button>
							</form>';
						}
						else{
							echo '<label>User Login</label><br>
							<form action="login.inc.php" method="post">
								<input type="text" name="mailuid" placeholder="Username or E-mail">
								<input type="password" name="pwd" placeholder="Password">
								<button type="submit" name ="login-submit">Login</button>
                                <a href="forgotPassword.php">Forgot Password (user)</a>
							</form><br>
							<a href="signup.php">Sign up as user</a><br><br>
							<label>Employer Login</label><br>
							<form action="employerLogin.inc.php" method="post">
								<input type="text" name="mailuid" placeholder="Username or E-mail">
								<input type="password" name="pwd" placeholder="Password">
								<button type="submit" name ="login-submit">Login</button>
                                <a href="forgotPasswordEmp.php">Forgot Password (employer)</a>
							</form><br>
							<a href="employerSignup.php">Sign up as employer</a><br><br><br>';
							
						}
					?>
					
					
			</div>
			
		</header>
