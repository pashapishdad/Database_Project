<?php
session_start();
if(isset($_POST['category-submit'])){
	
	require 'dbh.inc.php';
	$category = $_POST['category'];
	
	
	if(empty($category)){
		
		header("Location: userProfile.php?error=emptyfields");
		exit();
	}
	else{
		if(isset($_SESSION['userID'])){
			if($category == "Basic"){
					$charge = 0;
					$numberOfApp = 0;
			}
			else if($category == "Prime"){
				$charge = 10;
				$numberOfApp = 5;
			}
			else{
				$charge = 20;
				$numberOfApp = 100;
			}
			
			
			$sql = "UPDATE userCategory SET category=?, charge=?, numberOfApp=? WHERE uID=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: userProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "siii", $category, $charge, $numberOfApp, $_SESSION['userID']);
				mysqli_stmt_execute($stmt);
				header("Location: userProfile.php?postjob=success");
				exit();
			}
		}
		else if(isset($_SESSION['employerID'])){
			if($category == "Prime"){
					$charge = 50;
					$numberOfJobs = 5;
			}
			else{
				$charge = 100;
				$numberOfJobs = 100;
			}
			
			$sql = "UPDATE employerCategory SET category=?, charge=?, numberOfJobs=? WHERE eID=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: userProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "siii", $category, $charge, $numberOfJobs, $_SESSION['employerID']);
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
