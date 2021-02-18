<?php
include 'database_inc.php';
session_start();

$schedule_id = $_GET['id'];

$result = mysqli_query($connect,
    "SELECT * FROM schedules WHERE id = '$schedule_id';");
while ($row = mysqli_fetch_array($result))
{
	if ($row['ready'] == 0) {

		$result2 = mysqli_query($connect,
		"UPDATE `schedules` 
		    SET `ready` = 1 WHERE `id` = '$schedule_id'"
		);
		
	} else {

		$result2 = mysqli_query($connect,
		"UPDATE `schedules` 
		    SET `ready` = 0 WHERE `id` = '$schedule_id'"
		);

	}
}
header('location:schedules.php');
?>