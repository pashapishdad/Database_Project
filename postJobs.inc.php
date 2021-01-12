<?php
session_start();
if(isset($_POST['job-submit'])){
	
	require 'dbh.inc.php';
	
	$name = $_POST['name'];
	$description = $_POST['description'];
	$salary = $_POST['salary'];
	$category = $_POST['category'];
	$number = $_POST['numberNeeded'];
	
	
	if(empty($name) || empty($description) || empty($salary) || empty($category)){
		
		header("Location: postJobs.php?error=emptyfields");
		exit();
	}
	else{
		
		
		$sql = "SELECT category FROM employerCategory WHERE eID=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: postJobs.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
				
				$eCategory = $row['category'];
			}
		}
		
		$sql = "SELECT COUNT(jID) AS jobCount FROM job WHERE employer_eID=? AND user_uID=-1 GROUP BY employer_eID";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: postJobs.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
				
				$jobCount = $row['jobCount'];
			}
		}
		
		if($eCategory == 'Gold' || $jobCount < 5){
			$sql = "INSERT INTO job (name, description, category, salary, employer_eID, user_uID, accept, date) VALUES (?, ?, ?, ?, ?, -1, ?, CURDATE())";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: postJobs.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "sssdii", $name, $description, $category, $salary, $_SESSION['employerID'], $number);
				mysqli_stmt_execute($stmt);
				header("Location: postJobs.php?postjob=success");
				exit();
			
			}
		}
		else{
			header("Location: postJobs.php?postjob=denied");
			exit();
		}
		
		
	}
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($conn);
}
else{
	header("Location: postJobs.php");
	exit();
}
