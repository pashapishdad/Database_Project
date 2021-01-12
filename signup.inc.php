<?php
if(isset($_POST['signup-submit'])){
	
	require 'dbh.inc.php';
	
	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
	$category = $_POST['category'];
	
	if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat) || empty($category)){
		
		header("Location: signup.php?error=emptyfields&uid=".$username."&mail=".$email);
		exit();
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
		
		header("Location: signup.php?error=invalidmailuid");
		exit();
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		
		header("Location: signup.php?error=invalidmail&mail=".$email);
		exit();
	}
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
		
		header("Location: signup.php?error=invaliduid&uid=".$username);
		exit();
	}
	else if($password !== $passwordRepeat){
		
		header("Location: signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
		exit();
	}
	else{
		
		$sql = "SELECT username FROM user WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: signup.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck > 0){
				
				header("Location: signup.php?error=usertaken&mail=".$email);
				exit();
			}
			else{
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
				
				$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
				
				$sql = "INSERT INTO user (email, username, password, activated) VALUES (?, ?, ?, 1)";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: signup.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashedPwd);
					mysqli_stmt_execute($stmt);
					
					
					$sql = "SELECT * FROM user WHERE username=?";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: index.php?error=sqlerror");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt, "s", $username);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						
						if($row = mysqli_fetch_assoc($result)){
				
							$userID = $row['uID'];
						}
						else{
							header("Location: index.php?error=sqlerror");
							exit();
						}
					}
					
					$sql = "INSERT INTO userCategory (uID, category, charge, numberOfApp) VALUES (?, ?, ?, ?)";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: signup.php?error=sqlerror");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt, "isii", $userID, $category, $charge, $numberOfApp);
						mysqli_stmt_execute($stmt);
						
						
						
						$sql = "INSERT INTO account (aID, user_uID, balance, withdrawal_method) VALUES (?, ?, 100, ?)";
						$stmt = mysqli_stmt_init($conn);
						if(!mysqli_stmt_prepare($stmt, $sql)){
							header("Location: signup.php?error=sqlerror");
							exit();
						}
						else{
							
							$accountID = $userID;
							$wd_method = 'automatic';
							
							mysqli_stmt_bind_param($stmt, "iis", $accountID, $userID, $wd_method);
							mysqli_stmt_execute($stmt);
							
						}
						
						$sql = "UPDATE user SET account_aID=? WHERE uID=?";
						$stmt = mysqli_stmt_init($conn);
						if(!mysqli_stmt_prepare($stmt, $sql)){
							header("Location: signup.php?error=sqlerror");
							exit();
						}
						else{
							
							$accountID = $userID;
							$wd_method = 'automatic';
							
							mysqli_stmt_bind_param($stmt, "ii", $accountID, $userID);
							mysqli_stmt_execute($stmt);
							header("Location: signup.php?signup=success");
							exit();
						}
					}
				}
			}
		}
		
	}
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($conn);
}
else{
	header("Location: signup.php");
	exit();
}
