<?php
session_start();
if(isset($_POST['email-submit'])){
	
	require 'dbh.inc.php';
	$email = $_POST['username'];
	
	
	if(empty($email)){
		
		header("Location: index.php?error=emptyfields");
		exit();
	}
	else{
		if(isset($_SESSION['userID'])){
			
			$sql = "UPDATE user SET email=? WHERE uID=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: userProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "si", $email, $_SESSION['userID']);
				mysqli_stmt_execute($stmt);
				header("Location: userProfile.php?postjob=success");
				exit();
			}
					
		}
		else if(isset($_SESSION['employerID'])){
			
			
			$sql = "UPDATE employer SET email=? WHERE eID=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: employerProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "si", $email, $_SESSION['employerID']);
				mysqli_stmt_execute($stmt);
				header("Location: employerProfile.php?postjob=success");
				exit();
			}
		}
		else{
			
			header("Location: index.php?error=sqlerror");
			exit();
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($conn);
}
else{
	header("Location: index.php");
	exit();
}
