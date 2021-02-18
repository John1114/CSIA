<?php
session_start();
include('database_inc.php');

$id = $_GET['id'];

$result = mysqli_query($connect,
            "DELETE FROM `schedules` WHERE `id` = '$id';");
// send user back to users.php
$_SESSION['entryDeleted'] = True;
        header('location:schedules.php');
