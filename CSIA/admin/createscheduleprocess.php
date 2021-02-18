<?php
include 'database_inc.php';
session_start();
if ($_SESSION['logged_in'] != True) {
  header('location:index.php');
}
// echo("Name: " . $_POST['schedule_name_input'] . "<br>");
// echo("First day: " . $_POST['first_day_raw'] . "<br>");
// echo("last day: " . $_POST['last_day_raw'] . "<br>");
// echo("Days in rotation: " . $_POST['days_in_rotation_input'] . "<br>");
// echo("Blocks in days: " . $_POST['blocks_in_a_day_input'] . "<br>");
// echo("no school dates: " . $_POST['no_school_dates_raw'] . "<br>");
// echo("special_school_days_inclusive: " . $_POST['special_school_days_inclusive_raw'] . "<br>");
// echo("special_school_days_exclusive: " . $_POST['special_school_days_exclusive_raw'] . "<br>");
// echo("wednesday_rotation_schedual: " . $_POST['wednesday_rotation_schedual_raw'] . "<br>");
// echo("rotation_schedual: " . $_POST['rotation_schedual_raw'] . "<br>");
// echo("special_schedual_inclusive: " . $_POST['special_schedual_inclusive_raw'] . "<br>");
// echo("special_schedual_exclusive: " . $_POST['special_schedual_exclusive_raw'] . "<br>");

$outline = array(array(), array(array(), array(), array(), array()));
$name = $_POST['schedule_name_input'];
$first_day_raw = $_POST['first_day_raw'];
$last_day_raw = $_POST['last_day_raw'];
$days_in_rotation = $_POST['days_in_rotation_input'];
$no_school_dates = $_POST['no_school_dates_raw'];
$no_school_dates = explode(',', $no_school_dates);

$counter = 0;
$temp_array = array();
$special_school_days_inclusive = $_POST['special_school_days_inclusive_raw'];
$special_school_days_inclusive = explode(',', $special_school_days_inclusive);
while ($counter < count($special_school_days_inclusive)){
	$special_school_days_inclusive[$counter] = [$special_school_days_inclusive[$counter], $counter];
	$counter += 1;
}

$temp_array = array();
$counter = 0;
$special_school_days_exclusive = $_POST['special_school_days_exclusive_raw'];
$special_school_days_exclusive = explode(',', $special_school_days_exclusive);
while ($counter < count($special_school_days_exclusive)){
	$special_school_days_exclusive[$counter] = [$special_school_days_exclusive[$counter], $counter];
	$counter += 1;
}

$wednesday_rotation_schedual = json_decode($_POST['wednesday_rotation_schedual_raw']);
$rotation_schedual = json_decode($_POST['rotation_schedual_raw']);
$special_schedual_inclusive = json_decode($_POST['special_schedual_inclusive_raw']);
$special_schedual_exclusive = json_decode($_POST['special_schedual_exclusive_raw']);
$outline[1][0] = $wednesday_rotation_schedual;
$outline[1][1] = $rotation_schedual;
$outline[1][2] = $special_schedual_inclusive;
$outline[1][3] = $special_schedual_exclusive;

array_push($outline[0], $name);
array_push($outline[0], $first_day_raw);
array_push($outline[0], $last_day_raw);
array_push($outline[0], $_POST['no_school_dates_raw']);
array_push($outline[0], $days_in_rotation);
array_push($outline[0], $_POST['blocks_in_a_day_input']);
array_push($outline[0], $_POST['special_school_days_inclusive_raw']);
array_push($outline[0], $_POST['special_school_days_exclusive_raw']);

function get_in_school_dates($day_one_raw, $day_two_raw, $school_off_days) { // function returns list of all dates that there is school (no weekends, no holidays)
	$day_one = strtotime($day_one_raw); // Sets first day of school in UNIX format
	$day_two = strtotime($day_two_raw);  // Sets last day of school in UNIX format

	$days_in_schoolyear_array = array(); 
	for ($i = $day_one; $i <= $day_two; $i += 86400) {
		array_push($days_in_schoolyear_array, date("Y-m-d", $i)); // Creates array with all dates in the school year
	}
	$days_off_in_schoolyear_array = array();

	$period = new DatePeriod(
	    new DateTime($day_one_raw),
	    new DateInterval('P1D'),
	    new DateTime($day_two_raw)
	);
	foreach ($period as $key => $value) {
	    if ($value->format('N') >= 6) {
	        array_push($days_off_in_schoolyear_array, $value->format('Y-m-d')); // Creates array with all days in school year with no school
	    }  
	}
	$wednesday_dates_array = array();
	foreach ($period as $key => $value) {
	    if ($value->format('N') == 3) {
	        array_push($wednesday_dates_array, $value->format('Y-m-d')); // Creates array with all days in school year with no school
	    }  
	}

	$schooldays_dates_array = array();
	foreach($days_in_schoolyear_array as $date) {
		if (in_array($date, $days_off_in_schoolyear_array) == False && in_array($date, $school_off_days) == False) {
			array_push($schooldays_dates_array, $date);
		}
	}
	return(array($schooldays_dates_array, $wednesday_dates_array));
}

$schooldays_dates_array = get_in_school_dates($first_day_raw, $last_day_raw, $no_school_dates)[0];
$wednesday_dates_array = get_in_school_dates($first_day_raw, $last_day_raw, $no_school_dates)[1];

$final_school_schedual = array();
$blocks = array();

$day_counter = 0;
foreach($schooldays_dates_array as $date) {
	foreach($special_school_days_inclusive as $special_day_inclusive) {
		if (in_array($date, $special_day_inclusive)){
			// schedual for a day with special schedual (halfdays, conferences), but rotation continues
			array_push($final_school_schedual, array($date, $special_schedual_inclusive[$special_day_inclusive[1]]));
			foreach($special_schedual_inclusive[$special_day_inclusive[1]] as $block) {
				array_push($blocks, $block[0]);
			}
			$day_counter += 1;
			continue 2;
		}
	} 
	foreach($special_school_days_exclusive as $special_day_exclusive) {
		if (in_array($date, $special_day_exclusive)){
			// schedual for a day with special schedual (field day, trips) rotation pauses
			array_push($final_school_schedual, array($date, $special_schedual_exclusive[$special_day_exclusive[1]]));
			foreach($special_schedual_exclusive[$special_day_exclusive[1]] as $block) {
				array_push($blocks, $block[0]);
			}
			continue 2;
		}
	} 
	if (in_array($date, $wednesday_dates_array)) {
		array_push($final_school_schedual, array($date, $wednesday_rotation_schedual[($day_counter%$days_in_rotation)]));
		foreach($wednesday_rotation_schedual[($day_counter%$days_in_rotation)] as $block) {
			array_push($blocks, $block[0]);
		}
	} else {
		array_push($final_school_schedual, array($date, $rotation_schedual[($day_counter%$days_in_rotation)]));
		foreach($rotation_schedual[($day_counter%$days_in_rotation)] as $block) {
			array_push($blocks, $block[0]);
		}
	}
	$day_counter += 1;
}

// $i = 0;
// foreach($final_school_schedual as $day) {
// 	$n = 0;
// 	echo($day[0] . ":\t");
// 	foreach($day[1] as $class) {
// 		echo($class[0] . " - " . $class[1] . "		|		");
// 		$n += 1;
// 	}
// 	echo("<br>");
// 	$i += 1;
// }

$serializedarray = serialize($final_school_schedual);

date_default_timezone_set("Europe/Berlin");
$current_time_stamp = date("Y-m-d h:i:sa");
$blocks = array_unique($blocks);
$serializedarray_blocks = serialize($blocks);
$outline = serialize($outline);

date_default_timezone_set("Europe/Berlin");
$current_time_stamp = date("Y-m-d h:i:sa");

$result = mysqli_query($connect,
    "INSERT INTO `schedules` (`id`, `name`, `serializedarray`, `ready`, `createddate`, `updateddate`, `blocks`, `outline`) VALUES (NULL, '$name', '$serializedarray', '0', '$current_time_stamp', '$current_time_stamp', '$serializedarray_blocks', '$outline');"
);

$_SESSION['schedule_added'] = True;
header('location:schedules.php');

?>