<?php
include 'database_inc.php';

$first_day_raw = "2020-08-18"; // INPUT: first day of school
$last_day_raw = "2021-06-18"; // INPUT: last day of school
$no_school_dates = array("2020-12-20", "2020-12-21", "2020-12-22", "2020-12-23", "2020-12-24", "2020-12-25", "2020-12-26", "2020-12-27", "2020-12-28", "2020-12-29", "2020-12-30", "2020-12-31", "2021-01-01", "2021-01-02", "2021-01-03", "2021-01-04", "2021-01-05", "2021-01-06", "2021-01-07", "2021-01-08"); // INPUT: array of dates of all holidays and days off
$special_school_days_inclusive = array(array("2020-09-11", 0), array("2020-11-03", 1), array("2020-12-03", 0), array("2021-02-05", 0), array("2021-03-15", 2), array("2021-04-09", 1), array("2021-05-11", 0), array("2021-06-03", 2)); // INPUT: array of school days with special schedual, where rotation continues
$special_school_days_exclusive = array(array("2020-09-01", 0), array("2020-09-02", 1), array("2020-09-03", 1), array("2020-09-04", 1), array("2020-09-05", 0)); // INPUT: array of school days with special schedual, where rotation pauses

$wednesday_rotation_schedual = array(array(array("Block 1", "9:30-10:30"), array("Block 2", "10:40-11:40"), array("Block 3", "12:30-13:30"), array("Block 4", "13:50-14:50")), array(array("Block 5", "9:30-10:30"), array("Block 6", "10:40-11:40"), array("Block 7", "12:30-13:30"), array("Block 8", "13:50-14:50")), array(array("Block 4", "9:30-10:30"), array("Block 2", "10:40-11:40"), array("Block 3", "12:30-13:30"), array("Block 1", "13:50-14:50")), array(array("Block 8", "9:30-10:30"), array("Block 6", "10:40-11:40"), array("Block 7", "12:30-13:30"), array("Block 5", "13:50-14:50")));

$rotation_schedual = array(array(array("Block 1", "8:20-8:40"), array("Block 2", "9:00-10:10"), array("Block 3", "10:30-11:40"), array("Block 4", "12:00-13:10")), array(array("Block 5", "8:20-8:40"), array("Block 6", "9:00-10:10"), array("Block 7", "10:30-11:40"), array("Block 8", "12:00-13:10")), array(array("Block 4", "8:20-8:40"), array("Block 2", "9:00-10:10"), array("Block 3", "10:30-11:40"), array("Block 1", "12:00-13:10")), array(array("Block 8", "8:20-8:40"), array("Block 6", "9:00-10:10"), array("Block 7", "10:30-11:40"), array("Block 5", "12:00-13:10")));

$special_schedual_inclusive = array(array(array("Classes", "8:30-13:00"), array("Conferences", "13:20-15:30")), array(array("Classes", "8:30-12:00"), array("UN Day", "12:15-14:15"), array("Classes", "14:30-15:30")), array(array("Classes", "8:30-11:00"), array("Field Day", "11:20-15:30")));

$special_schedual_exclusive = array(array(array("Bus Leave ASW", "8:30-9:00"), array("Forest Activities", "9:15-14:45"), array("Bus Return ASW", "15:00-15:30")), array(array("PP Activities", "8:30-12:00"), array("Lunch", "12:15-13:00"), array("Fun Activities", "13:15-15:30")));

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
		array_push($final_school_schedual, array($date, $wednesday_rotation_schedual[($day_counter%4)]));
		foreach($wednesday_rotation_schedual[($day_counter%4)] as $block) {
			array_push($blocks, $block[0]);
		}
	} else {
		array_push($final_school_schedual, array($date, $rotation_schedual[($day_counter%4)]));
		foreach($rotation_schedual[($day_counter%4)] as $block) {
			array_push($blocks, $block[0]);
		}
	}
	$day_counter += 1;
}

$i = 0;
foreach($final_school_schedual as $day) {
	$n = 0;
	echo($day[0] . ":\t");
	foreach($day[1] as $class) {
		echo($class[0] . " - " . $class[1] . "		|		");
		$n += 1;
	}
	echo("<br>");
	$i += 1;
}

$name = "Sample Schedual 1";
$serializedarray = serialize($final_school_schedual);

date_default_timezone_set("Europe/Berlin");
$current_time_stamp = date("Y-m-d h:i:sa");
$blocks = array_unique($blocks);
print_r($blocks);
$serializedarray_blocks = serialize($blocks);

$result = mysqli_query($connect,
    "INSERT INTO `schedules` (`id`, `name`, `serializedarray`, `ready`, `createddate`, `updateddate`, `blocks`) VALUES (NULL, '$name', '$serializedarray', '0', '$current_time_stamp', '$current_time_stamp', '$serializedarray_blocks');"
);

?>