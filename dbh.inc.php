<?php

$dbServername = "mxc353.encs.concordia.ca";
$dbUsername = "mxc353_1";
$dbPassword = "uhSf4357";
$dbName = "mxc353_1";


$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);


if(!$conn){
	die("Connection failed: " .mysqli_connect_error);
}