<?php
session_start();
if(isset($_POST['username-submit'])){
	
	require 'dbh.inc.php';
	$username = $_POST['username'];
	
	
	if(empty($username)){
		
		header("Location: index.php?error=emptyfields");
		exit();
	}
	else{
		if(isset($_SESSION['userID'])){
			
			$sql = "SELECT username FROM user WHERE username=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: userProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if($resultCheck > 0){
				
					header("Location: userProfile.php?error=usertaken");
					exit();
				}
				else{
					
					$sql = "UPDATE user SET username=? WHERE uID=?";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: userProfile.php?error=sqlerror");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt, "si", $username, $_SESSION['userID']);
						mysqli_stmt_execute($stmt);
						header("Location: userProfile.php?postjob=success");
						exit();
					}
				}
			}
		}
		else if(isset($_SESSION['employerID'])){
			
			
			$sql = "SELECT username FROM employer WHERE username=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: employerProfile.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if($resultCheck > 0){
				
					header("Location: employerProfile.php?error=usertaken");
					exit();
				}
				else{
					
					$sql = "UPDATE employer SET username=? WHERE eID=?";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: employerProfile.php?error=sqlerror");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt, "si", $username, $_SESSION['employerID']);
						mysqli_stmt_execute($stmt);
						header("Location: employerProfile.php?postjob=success");
						exit();
					}
				}
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
