<?php
session_start();
if(isset($_POST['withdraw-submit'])){
	
	require 'dbh.inc.php';
	$jID = $_POST['jID'];
	
	$sql = "DELETE FROM job WHERE jID=? AND user_uID=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: userApplications.php?error=sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "ii", $jID, $_SESSION['userID']);
		mysqli_stmt_execute($stmt);
		header("Location: userApplications.php?withdraw=success");
		exit();
	}
	
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($conn);
}
else{
	header("Location: userApplications.php");
	exit();
}
