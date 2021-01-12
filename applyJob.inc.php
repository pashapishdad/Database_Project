<?php
session_start();
	
	require 'dbh.inc.php';
	$jID = $_POST['jID'];
	
	
	$sql = "SELECT category FROM userCategory WHERE uID=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: userProfile.php?error=sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($row = mysqli_fetch_assoc($result)){
			
			$uCategory = $row['category'];
		}
	}
	
	$sql = "SELECT COUNT(jID) AS appCount FROM job WHERE user_uID=? GROUP BY user_uID";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: userProfile.php?error=sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($row = mysqli_fetch_assoc($result)){
			
			$appCount = $row['appCount'];
		}
	}
	
	if($uCategory == 'Gold' || ($uCategory == 'Prime' && $appCount < 5)){
		$sql = "SELECT * FROM job WHERE jID=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: index.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "i", $jID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
			
				$name = $row['name'];
				$description = $row['description'];
				$category = $row['category'];
				$salary = $row['salary'];
				$eID = $row['employer_eID'];
			}
		
			$sql = "INSERT IGNORE INTO job(jID, name, description, category, salary, employer_eID, user_uID, accept, date) VALUES(?, ?, ?, ?, ?, ?, ?, 0, CURDATE())";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: index.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "isssdii", $jID, $name, $description, $category, $salary, $eID, $_SESSION['userID']);
				mysqli_stmt_execute($stmt);
				header("Location: userProfile.php?applyjob=success");
				exit();
			}
		}	
	}
	else{
		header("Location: userProfile.php?applyjob=denied");
		exit();
	}
	
	
	
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($conn);
		


