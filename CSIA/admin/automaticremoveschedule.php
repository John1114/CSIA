<?php
session_start();

if ($_SESSION['logged_in'] != True) {
  header('location:index.php');
}

include('database_inc.php');
$email = $_SESSION['email'];
$fileToDelete = $_GET['name'];

$uploaddir  = "/Users/21rytel_j/Sites/CSIA/admin/";
$fileToDelete = $uploaddir . $fileToDelete;
unlink($fileToDelete);


// echo "$reviewerName";
// echo "$applicantName";
// echo "$comments";
// echo "$finalGrade";
header('location:schedules.php');
?>