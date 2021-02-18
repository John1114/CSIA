<?php
include 'database_inc.php';
session_start();
if ($_SESSION['logged_in'] != True) {
  header('location:index.php');
}

$scheduleid = $_GET['id'];
date_default_timezone_set("Europe/Berlin");
$current_date = date("mdhi");
$result = mysqli_query($connect,
    "SELECT * FROM schedules WHERE `id` = '$scheduleid';");
while ($row = mysqli_fetch_array($result)) { 
	$final_school_schedual = unserialize($row['serializedarray']);
} if (mysqli_num_rows($result) == 0) {
	header('location:schedules.php'); 
}

$file = fopen('blankschedule'.$scheduleid.$current_date.'.csv', 'w');
fputcsv($file, array('Subject', 'Start Date', 'Start Time', 'End Date', 'End Time', 'All Day Event', 'Description', 'Location'));
$events = array();
 
foreach($final_school_schedual as $day) {
	foreach($day[1] as $class) {
		//create an csv file with $day[0] as the date, $class[0] as the name, $class[1] as the time
		$date = date("m/d/Y", strtotime($day[0]));
		$start_time = explode("-",$class[1])[0];
		$end_time = explode("-",$class[1])[1];

 		$start_time = date("g:i A", strtotime($start_time));
 		$end_time = date("g:i A", strtotime($end_time));

		array_push($events, array($class[0], $date, $start_time, $date, $end_time, "FALSE", "", ""));
	}
}

foreach ($events as $row) {
fputcsv($file, $row);
}
fclose($file);
header('location:schedules.php?name=blankschedule'.$scheduleid.$current_date.'.csv'); 
?>