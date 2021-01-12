<?php
session_start();
if(isset($_POST['method-submit'])){
	
	require 'dbh.inc.php';
	$method = $_POST['method'];
	
	
	if(empty($method)){
		
		header("Location: index.php?error=emptyfields");
		exit();
	}
	else{
		if(isset($_SESSION['userID'])){
			
			
			$sql = "UPDATE account SET  withdrawal_method=? WHERE user_uID=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: userProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "si", $method, $_SESSION['userID']);
				mysqli_stmt_execute($stmt);
				header("Location: userProfile.php?postjob=success");
				exit();
			}
		}
		else if(isset($_SESSION['employerID'])){
			
			
			$sql = "UPDATE account SET withdrawal_method=? WHERE employer_eID=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: employerProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "si", $method, $_SESSION['employerID']);
				mysqli_stmt_execute($stmt);
				header("Location: employerProfile.php?postjob=success");
				exit();
			}
		}
		else{
			
			header("Location: userProfile.php?error=sqlerror");
			exit();
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($conn);
}
else{
	header("Location: userProfile.php");
	exit();
}
