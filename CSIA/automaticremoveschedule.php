<?php
session_start();
include('database_inc.php');
$email = $_SESSION['email'];
$scheduleid = $_GET['id'];
$fileToDelete = $_GET['name'];

$uploaddir  = "/Users/21rytel_j/Sites/CSIA/";
$fileToDelete = $uploaddir . $fileToDelete;
unlink($fileToDelete);


// echo "$reviewerName";
// echo "$applicantName";
// echo "$comments";
// echo "$finalGrade";
header('location:personalizeschedule.php?id='.$scheduleid);
?>