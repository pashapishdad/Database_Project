<?php
if(isset($_POST['forgotPassword-submit'])){
	
	require 'dbh.inc.php';
	
	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
    
    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
        
        header("Location: forgotPassword.php?error=emptyfields");
        exit();
    }
    else{
        
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
                
                if($row['email'] != $email){
                    header("Location: forgotPassword.php?error=wrongemail");
                    exit();
                }
                else if($password !== $passwordRepeat){
                    header("Location: forgotPassword.php?error=passwordcheck&uid=".$username."&mail=".$email);
                    exit();
                }
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE user SET password=? WHERE uID=?";
                $stmt = mysqli_stmt_init($conn);
                //mysqli_stmt_prepare($stmt, $sql);
                if(mysqli_stmt_prepare($stmt, $sql)){
                    //mysqli_query($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "si", $hashedPwd, $row['uID']);
                    mysqli_stmt_execute($stmt);
                    header("Location: forgotPassword.php?change=done");
                    exit();
                }
            }
            else{
                header("Location: forgotPassword.php?error=nouser");
                exit();
            }
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($conn);
        }
    }
}
