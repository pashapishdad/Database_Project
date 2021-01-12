<?php
session_start();
if(isset($_POST['activation-submit'])){
	
	require 'dbh.inc.php';
	$uID = $_POST['uID'];
	
	$sql = "SELECT * FROM user WHERE uID=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: adminProfile.php?error=sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "i", $uID);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if($row = mysqli_fetch_assoc($result)){
			
			if($row['activated'] == 0){
				$activate = 1;
			}
			else{
				$activate = 0;
			}
		}
		
		$sql = "UPDATE user SET activated=? WHERE uID=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: adminProfile.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "ii", $activate, $uID);
			mysqli_stmt_execute($stmt);
			header("Location: adminProfile.php?postjob=success");
			exit();
		}
	}
	
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($conn);
}
else{
	header("Location: adminProfile.php");
	exit();
}
