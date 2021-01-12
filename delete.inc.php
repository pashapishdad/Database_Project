<?php
session_start();

	
	require 'dbh.inc.php';
	
	
	
		if(isset($_SESSION['userID'])){
			
				
				$sql = "DELETE FROM userCategory WHERE uID=?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: index.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
					mysqli_stmt_execute($stmt);
				
				}
				
				$sql = "DELETE FROM account WHERE user_uID=?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: index.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
					mysqli_stmt_execute($stmt);
				}
				
				$sql = "DELETE FROM user WHERE uID=?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: userProfile.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
					mysqli_stmt_execute($stmt);
				}
				
				$sql = "UPDATE job SET user_uID=-1 WHERE user_uID=?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: index.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
					mysqli_stmt_execute($stmt);
					
					session_unset();
					session_destroy();
					header("Location: index.php");
				
				}
			
		}
		else if(isset($_SESSION['employerID'])){
			
				
				$sql = "DELETE FROM employerCategory WHERE eID=?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: index.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
					mysqli_stmt_execute($stmt);
				
				}
				
				$sql = "DELETE FROM account WHERE employer_eID=?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: index.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
					mysqli_stmt_execute($stmt);
				}
				
				$sql = "DELETE FROM job WHERE employer_eID=?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: index.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
					mysqli_stmt_execute($stmt);
				
				}
				
				$sql = "DELETE FROM employer WHERE eID=?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: employerProfile.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['employerID']);
					mysqli_stmt_execute($stmt);
					
					session_unset();
					session_destroy();
					header("Location: index.php");
				}
			
		}
		else{
			
			header("Location: index.php?error=sqlerror");
			exit();
		}
		
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($conn);
	
	session_unset();
	session_destroy();
	header("Location: index.php");


