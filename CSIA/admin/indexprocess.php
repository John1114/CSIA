<?php
session_start();
$password = $_POST['password'];

if ($password == "123") {
	$_SESSION['logged_in'] = True;
	header('location:schedules.php');
} else{
	$_SESSION['wrong_password'] = True;
	header('location:index.php');
}

?>