<?php
session_start();
$pagetitle = "Create New Schedule";
include 'database_inc.php';
include 'navbar.php';
$days_in_rotation = $_GET['days'];
$blocks_in_a_day = $_GET['blocks'];
$inclusive_days = $_GET['inclusivedays'];
$exclusive_days = $_GET['exclusivedays'];
$inclusive_dates = $_GET['inclusivedates'];
$inclusive_dates_array = explode(",", $inclusive_dates);
$exclusive_dates = $_GET['exclusivedates'];
$exclusive_dates_array = explode(",", $exclusive_dates);
$first_day = $_GET['first_day'];
$last_day = $_GET['last_day'];
$name = $_GET['name'];
$no_school_dates = $_GET['no_school_dates'];
if ($_SESSION['logged_in'] != True) {
  header('location:index.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css">

    <title>Create Schedule</title>
    <link rel="icon" href="http://1lo.lubin.pl/images/logo600.png">

    <style type="text/css">
    body, html {
  height: 100%;
}

body {  /*background-image: url(https://i.imgur.com/TeCMWmk.jpg?1); */
        background-color: #efefef;
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover; 
      } 
.btn-blue {
    background-color: #58c4ef;
    color: white;
}
.btn-blue:hover {
    background-color: transparent;
    border-color: #58c4ef;
    color: #58c4ef;
}
  .btn-grey {
    background-color: #bfc3c6;
    color: white;
}
.btn-grey:hover {
    background-color: transparent;
    border-color: #bfc3c6;
    color: #bfc3c6;
}
}

</style>
  </head>
  <body>
    <div style="font-family: Verdana">
    <br>
    <div class="bg-image">
      <div id="intro" class="row">
          <!-- <div class="col-md-6"> -->
            <div class="col-md-8 offset-md-2">
              <div class="card">
                <div class="card-body">
                  <div class="row justify-content-md-center">
                  <h1 id="cardHeader">Create a new Schedule</h1>
                </div>
                  <br>
                      <div class="input-group date form-group" id="name_input">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter name of Schedule</span>
                      </div>
                      <input type="text" class="form-control" id="schedule_name" name="schedule_name" placeholder="Enter Name" value="<?php echo $name; ?>" />
                      </div>
                      <div class="input-group date form-group" id="datepicker1">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter first day of school</span>
                      </div>
                      <input type="text" class="form-control" id="first_day" name="first_day" placeholder="Select day" value="<?php echo $first_day; ?>"/>
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                      </div>

                      <div class="input-group date form-group" id="datepicker2">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter last day of school</span>
                      </div>
                      <input type="text" class="form-control" id="last_day" name="last_day" placeholder="Select day" value="<?php echo $last_day; ?>"/>
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                      </div>

                      <div class="input-group date form-group" id="datepicker3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter all days with no school</span>
                      </div>
                      <input type="text" class="form-control" id="no_school_dates" name="no_school_dates" placeholder="Select days" value="<?php echo $no_school_dates;?>"/>
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                      </div>

                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="">Number of days in 1 rotation</span>
                        </div>
                        <input type="number" class="form-control" id="days_in_rotation" value="<?php echo($days_in_rotation) ?>">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="">Number of blocks in 1 day</span>
                        </div>
                        <input type="number" class="form-control" id="blocks_in_a_day" value="<?php echo($blocks_in_a_day) ?>">
                      </div>

                      <div class="input-group date form-group" id="datepicker4">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter all days with a inclusive special schedule</span>
                      </div>
                      <input type="text" class="form-control" id="inclusivedatesinput" name="inclusivedatesinput" placeholder="Select days" value="<?php echo($inclusive_dates) ?>" />
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                      </div>

                      <div class="input-group date form-group" id="datepicker5">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter all days with a exclusive special schedule</span>
                      </div>
                      <input type="text" class="form-control" id="exclusivedatesinput" name="exclusivedatesinput" placeholder="Select days" value="<?php echo($exclusive_dates) ?>" />
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                      </div>

                      <button type="button" class="btn btn-blue btn-block btn-sm" onclick="show_outline();">Create Outline</button>
                      <br>
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-body">
                            <div class="row justify-content-md-center">
                            <h4 id="cardHeader">Rotation Schedule</h4>
                            </div>
                              <hr>
                              <div class="row">
                              <div class="col-6">
                                <h5>Normal Days</h5>
                              <ul class="nav nav-tabs">
                                <?php
                                $day_counter = 1;
                                while($day_counter <= $days_in_rotation) {
                                ?>
                                <li class="nav-item">
                                  <button class="tablink btn btn-light" onclick="openPage('<?php echo("Day".$day_counter) ?>', this, '#58c4ef')" id='<?php echo("Day ".$day_counter) ?>'><?php echo("Day ".$day_counter) ?></button>
                                </li>
                                <?php
                                $day_counter += 1;
                                }
                                ?>
                              </ul>
                                <?php
                                $day_counter = 1;
                                while($day_counter <= $days_in_rotation) {
                                ?>
                                <div id='<?php echo("Day".$day_counter) ?>' class="tabcontent">
                                  <br>
                                  <?php
                                  $block_counter = 1;
                                  while($block_counter <= $blocks_in_a_day){
                                  ?>
                                  <div class="input-group mb-1">
                                    <input type="text" class="form-control" placeholder="Name" id="<?php echo("Day".$day_counter."Block".$block_counter."Name") ?>">
                                    <input type="text" class="form-control" placeholder="Time (HH:MM-HH:MM)" id="<?php echo("Day".$day_counter."Block".$block_counter."Time") ?>">
                                  </div>
                                  <?php
                                  $block_counter += 1;
                                  }
                                  ?>
                                </div>
                                <?php
                                $day_counter += 1;
                                }
                                ?>

                            </div>
                            <div class="col-6">
                              <h5>Wednesdays</h5>
                              <ul class="nav nav-tabs">
                                <?php
                                $day_counter = 1;
                                while($day_counter <= $days_in_rotation) {
                                ?>
                                <li class="nav-item">
                                  <button class="Wtablink btn btn-light" onclick="WopenPage('<?php echo("WDay".$day_counter) ?>', this, '#58c4ef')" id='<?php echo("WDay ".$day_counter) ?>'><?php echo("Day ".$day_counter) ?></button>
                                </li>
                                <?php
                                $day_counter += 1;
                                }
                                ?>
                              </ul>
                                <?php
                                $day_counter = 1;
                                while($day_counter <= $days_in_rotation) {
                                ?>
                                <div id='<?php echo("WDay".$day_counter) ?>' class="Wtabcontent">
                                  <br>
                                  <?php
                                  $block_counter = 1;
                                  while($block_counter <= $blocks_in_a_day){
                                  ?>
                                  <div class="input-group mb-1">
                                    <input type="text" class="form-control" placeholder="Name" id="<?php echo("WDay".$day_counter."Block".$block_counter."Name") ?>">
                                    <input type="text" class="form-control" placeholder="Time (HH:MM-HH:MM)" id="<?php echo("WDay".$day_counter."Block".$block_counter."Time") ?>">
                                  </div>
                                  <?php
                                  $block_counter += 1;
                                  }
                                  ?>
                                </div>
                                <?php
                                $day_counter += 1;
                                }
                                ?>

                            </div>
                          </div>
                          </div>
                          </div>
                          <hr>
                        <div class="card">
                        <div class="card-body">
                          <div class="row justify-content-md-center">
                          <h4 id="cardHeader">Special Days</h4>
                          </div>
                            <hr>
                            <div class="row">
                            <div class="col-6">
                              <h5>Inclusive Days</h5>
                            <ul class="nav nav-tabs">
                              <?php
                              $day_counter = 1;
                              while($day_counter <= $inclusive_days) {
                              ?>
                              <li class="nav-item">
                                <button class="SItablink btn btn-light" onclick="SIopenPage('<?php echo("SIDay".$day_counter) ?>', this, '#58c4ef')" id='<?php echo("SIDay ".$day_counter) ?>'><?php echo(substr($inclusive_dates_array[($day_counter-1)], -5)) ?></button>
                              </li>
                              <?php
                              $day_counter += 1;
                              }
                              ?>
                            </ul>
                              <?php
                              $day_counter = 1;
                              while($day_counter <= $inclusive_days) {
                              ?>
                              <div id='<?php echo("SIDay".$day_counter) ?>' class="SItabcontent">
                                <br>
                                <?php
                                $block_counter = 1;
                                while($block_counter <= $blocks_in_a_day){
                                ?>
                                <div class="input-group mb-1">
                                  <input type="text" class="form-control" placeholder="Name" id="<?php echo("SIDay".$day_counter."Block".$block_counter."Name") ?>">
                                  <input type="text" class="form-control" placeholder="Time (HH:MM-HH:MM)" id="<?php echo("SIDay".$day_counter."Block".$block_counter."Time") ?>">
                                </div>
                                <?php
                                $block_counter += 1;
                                }
                                ?>
                              </div>
                              <?php
                              $day_counter += 1;
                              }
                              ?>

                          </div>
                          <div class="col-6">
                            <h5>Exclusive Days</h5>
                            <ul class="nav nav-tabs">
                              <?php
                              $day_counter = 1;
                              while($day_counter <= $exclusive_days) {
                              ?>
                              <li class="nav-item">
                                <button class="SEtablink btn btn-light" onclick="SEopenPage('<?php echo("SEDay".$day_counter) ?>', this, '#58c4ef')" id='<?php echo("SEDay ".$day_counter) ?>'><?php echo(substr($exclusive_dates_array[($day_counter-1)], -5)) ?></button>
                              </li>
                              <?php
                              $day_counter += 1;
                              }
                              ?>
                            </ul>
                              <?php
                              $day_counter = 1;
                              while($day_counter <= $exclusive_days) {
                              ?>
                              <div id='<?php echo("SEDay".$day_counter) ?>' class="SEtabcontent">
                                <br>
                                <?php
                                $block_counter = 1;
                                while($block_counter <= $blocks_in_a_day){
                                ?>
                                <div class="input-group mb-1">
                                  <input type="text" class="form-control" placeholder="Name" id="<?php echo("SEDay".$day_counter."Block".$block_counter."Name") ?>">
                                  <input type="text" class="form-control" placeholder="Time (HH:MM-HH:MM)" id="<?php echo("SEDay".$day_counter."Block".$block_counter."Time") ?>">
                                </div>
                                <?php
                                $block_counter += 1;
                                }
                                ?>
                              </div>
                              <?php
                              $day_counter += 1;
                              }
                              ?>

                          </div>
                        </div>
                        <!--    -->
                      </div>
                          </div>
                          <br>
                          <form action="createscheduleprocess.php" method="POST" id="formtosubmit">

                          <input type="hidden" name="schedule_name_input" id="schedule_name_input"></input>
                          <input type="hidden" name="first_day_raw" id="first_day_raw"></input>
                          <input type="hidden" name="last_day_raw" id="last_day_raw"></input>
                          <input type="hidden" name="days_in_rotation_input" id="days_in_rotation_input"></input>
                          <input type="hidden" name="blocks_in_a_day_input" id="blocks_in_a_day_input"></input>
                          <input type="hidden" name="no_school_dates_raw" id="no_school_dates_raw"></input>
                          <input type="hidden" name="special_school_days_inclusive_raw" id="special_school_days_inclusive_raw"></input>
                          <input type="hidden" name="special_school_days_exclusive_raw" id="special_school_days_exclusive_raw"></input>
                          <input type="hidden" name="wednesday_rotation_schedual_raw" id="wednesday_rotation_schedual_raw"></input>
                          <input type="hidden" name="rotation_schedual_raw" id="rotation_schedual_raw"></input>
                          <input type="hidden" name="special_schedual_inclusive_raw" id="special_schedual_inclusive_raw"></input>
                          <input type="hidden" name="special_schedual_exclusive_raw" id="special_schedual_exclusive_raw"></input>

                          <button class="btn btn-blue btn-block btn-lg" onclick="submit_form();">Save Schedule</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- </div> -->
              </div>
            </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
function show_outline() {
if (document.getElementById("inclusivedatesinput").value == "") {
  inclusivedayscounter = 0;
} else {
inclusivedayscounter = (document.getElementById("inclusivedatesinput").value).split(',').length;
} if (document.getElementById("exclusivedatesinput").value == "") {
  exclusivedayscounter = 0;
} else {
  exclusivedayscounter = (document.getElementById("exclusivedatesinput").value).split(',').length;
}
var inclusivedates = document.getElementById("inclusivedatesinput").value;
var exclusivedates = document.getElementById("exclusivedatesinput").value;
location.href="createschedule.php?blocks=".concat(document.getElementById("blocks_in_a_day").value, "&days=", document.getElementById("days_in_rotation").value, "&inclusivedays=", inclusivedayscounter, "&exclusivedays=", exclusivedayscounter, "&inclusivedates=", inclusivedates, "&exclusivedates=", exclusivedates, "&name=",document.getElementById("schedule_name").value, "&first_day=", document.getElementById("first_day").value, "&last_day=", document.getElementById("last_day").value, "&no_school_dates=", document.getElementById("no_school_dates").value);
}

$(document).ready(function() {
    $('#datepicker1').datepicker({
        startDate: new Date(),
        multidate: false,
        format: "yyyy-mm-dd",
        daysOfWeekHighlighted: "5,6",
        datesDisabled: ['31/08/2017'],
        language: 'en'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        //$(this).find('.input-group-addon .count').text(' ' + e.dates.length);
    });
});
$(document).ready(function() {
    $('#datepicker2').datepicker({
        startDate: new Date(),
        multidate: false,
        format: "yyyy-mm-dd",
        daysOfWeekHighlighted: "5,6",
        datesDisabled: ['31/08/2017'],
        language: 'en'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        //$(this).find('.input-group-addon .count').text(' ' + e.dates.length);
    });
});
$(document).ready(function() {
    $('#datepicker3').datepicker({
        startDate: new Date(),
        multidate: true,
        format: "yyyy-mm-dd",
        daysOfWeekHighlighted: "5,6",
        datesDisabled: ['31/08/2017'],
        language: 'en'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        //$(this).find('.input-group-addon .count').text(' ' + e.dates.length);
    });
});
$(document).ready(function() {
    $('#datepicker4').datepicker({
        startDate: new Date(),
        multidate: true,
        format: "yyyy-mm-dd",
        daysOfWeekHighlighted: "5,6",
        datesDisabled: ['31/08/2017'],
        language: 'en'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        //$(this).find('.input-group-addon .count').text(' ' + e.dates.length);
    });
});
$(document).ready(function() {
    $('#datepicker5').datepicker({
        startDate: new Date(),
        multidate: true,
        format: "yyyy-mm-dd",
        daysOfWeekHighlighted: "5,6",
        datesDisabled: ['31/08/2017'],
        language: 'en'
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
        //$(this).find('.input-group-addon .count').text(' ' + e.dates.length);
    });
});
<?php 
if (isset($_GET['days'])) {
?>
function openPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
    tablinks[i].style.color = "";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
  elmnt.style.color = "white";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("Day 1").click();

function WopenPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("Wtabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("Wtablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
    tablinks[i].style.color = "";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
  elmnt.style.color = "white";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("WDay 1").click();

function SIopenPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("SItabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("SItablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
    tablinks[i].style.color = "";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
  elmnt.style.color = "white";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("SIDay 1").click();

function SEopenPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("SEtabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("SEtablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
    tablinks[i].style.color = "";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
  elmnt.style.color = "white";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("SEDay 1").click();
<?php } ?>

function submit_form() {
  document.getElementById("schedule_name_input").value = document.getElementById("schedule_name").value;
  document.getElementById("first_day_raw").value = document.getElementById("first_day").value;
  document.getElementById("last_day_raw").value = document.getElementById("last_day").value;
  document.getElementById("no_school_dates_raw").value = document.getElementById("no_school_dates").value;
  document.getElementById("special_school_days_inclusive_raw").value = document.getElementById("inclusivedatesinput").value;
  document.getElementById("special_school_days_exclusive_raw").value = document.getElementById("exclusivedatesinput").value;
  document.getElementById("blocks_in_a_day_input").value = document.getElementById("blocks_in_a_day").value;
  document.getElementById("days_in_rotation_input").value = document.getElementById("days_in_rotation").value;

  var wednesday_rotation_schedual_array = [];
  var rotation_schedual_array = [];
  var block_counter = 0;
  var day_counter = 0;
  <?php if($days_in_rotation != "" && $blocks_in_a_day != "") { ?>
  days_in_rotation = <?php echo $days_in_rotation; ?>;
  blocks_in_a_day = <?php echo $blocks_in_a_day; ?>; 
  <?php } ?>
  for (day_counter = 1; day_counter <= days_in_rotation; day_counter++) {
    var normal_classes = [];
    var wedneday_classes = [];
    for (block_counter = 1; block_counter <= blocks_in_a_day; block_counter++) {
      normal_classes.push([document.getElementById("Day"+day_counter+"Block"+block_counter+"Name").value, document.getElementById("Day"+day_counter+"Block"+block_counter+"Time").value]);
      wedneday_classes.push([document.getElementById("WDay"+day_counter+"Block"+block_counter+"Name").value, document.getElementById("WDay"+day_counter+"Block"+block_counter+"Time").value]);
    }
    rotation_schedual_array.push(normal_classes);
    wednesday_rotation_schedual_array.push(wedneday_classes);
  }
  var inclusive_schedual_array = [];
<?php if ($inclusive_days != "") { ?>
  var inclusivedays = <?php echo $inclusive_days; ?>;
<? } ?>
  for (day_counter = 1; day_counter <= inclusivedays; day_counter++){
    var inclusive_classes = [];
    for (block_counter = 1; block_counter <= blocks_in_a_day; block_counter++) {
      inclusive_classes.push([document.getElementById("SIDay"+day_counter+"Block"+block_counter+"Name").value, document.getElementById("SIDay"+day_counter+"Block"+block_counter+"Time").value]);
    }
    inclusive_schedual_array.push(inclusive_classes);
  }

  var exclusive_schedual_array = [];
  <?php if ($exclusive_days != "") { ?>
  var exclusivedays = <?php echo $exclusive_days; ?>;
<? } ?>
  for (day_counter = 1; day_counter <= exclusivedays; day_counter++){
    var exclusive_classes = [];
    for (block_counter = 1; block_counter <= blocks_in_a_day; block_counter++) {
      exclusive_classes.push([document.getElementById("SEDay"+day_counter+"Block"+block_counter+"Name").value, document.getElementById("SEDay"+day_counter+"Block"+block_counter+"Time").value]);
    }
    exclusive_schedual_array.push(exclusive_classes);
  }

  document.getElementById("wednesday_rotation_schedual_raw").value = JSON.stringify(wednesday_rotation_schedual_array);
  document.getElementById("rotation_schedual_raw").value = JSON.stringify(rotation_schedual_array);
  document.getElementById("special_schedual_inclusive_raw").value = JSON.stringify(inclusive_schedual_array);
  document.getElementById("special_schedual_exclusive_raw").value = JSON.stringify(exclusive_schedual_array);  

  //document.getElementById("formtosubmit").submit();
}

    </script>
  </div>
  </div>
  </body>
</html>