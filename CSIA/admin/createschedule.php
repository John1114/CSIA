<?php
session_start();
$pagetitle = "chooseschedual.php";
include 'database_inc.php';
include 'navbar.php';
$days_in_rotation = $_GET['days'];
$blocks_in_a_day = $_GET['blocks'];
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
  <body onload="changeLanguageOnLoad()">
    <div style="font-family: Verdana">
    <br>
    <div class="bg-image">
      <div id="intro" class="row">
          <!-- <div class="col-md-6"> -->
            <div class="col-md-8 offset-md-2">
              <div class="card">
                <div class="card-body">
                  <div class="row justify-content-md-center">
                  <h1 id="cardHeader">Create a new Schedule</h3>
                </div>
                  <br>
                      <div class="input-group date form-group" id="schedule_name">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter name of Schedule</span>
                      </div>
                      <input type="text" class="form-control" id="schedule_name" name="schedule_name" placeholder="Enter Name" required />
                      </div>
                      <div class="input-group date form-group" id="datepicker1">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter first day of school</span>
                      </div>
                      <input type="text" class="form-control" id="Dates" name="Dates" placeholder="Select day" required />
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                      </div>

                      <div class="input-group date form-group" id="datepicker2">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter last day of school</span>
                      </div>
                      <input type="text" class="form-control" id="Dates" name="Dates" placeholder="Select day" required />
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                      </div>

                      <div class="input-group date form-group" id="datepicker3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Enter all days with no school</span>
                      </div>
                      <input type="text" class="form-control" id="Dates" name="Dates" placeholder="Select days" required />
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-body">
                            <div class="row justify-content-md-center">
                            <h4 id="cardHeader">Rotation Schedule</h4>
                            <br><br>
                            </div>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="">Number of days in 1 rotation</span>
                                </div>
                                <input type="number" class="form-control" id="days_in_rotation" value="<?php echo($days_in_rotation) ?>">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="">Number of blocks in 1 day</span>
                                </div>
                                <input type="number" class="form-control" id="blocks_in_a_day" value="<?php echo($blocks_in_a_day) ?>">
                              </div>
                              <p></p>
                              <button type="button" class="btn btn-blue btn-block btn-sm" onclick="show_outline();">Create Outline</button>
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
                                    <input type="text" class="form-control" placeholder="Name">
                                    <input type="text" class="form-control" placeholder="Time">
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
                                    <input type="text" class="form-control" placeholder="Name">
                                    <input type="text" class="form-control" placeholder="Time">
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
                          <br>
                        <div class="card">
                        <div class="card-body">
                          <div class="row justify-content-md-center">
                          <h4 id="cardHeader">Special Days</h4>
                          </div>
                          <br>
                      
                          </div>
                          </div>
                          <br>
                          <button class="btn btn-blue btn-block btn-lg">Save Schedule</button>
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

function show_outline() {
location.href="createschedule.php?blocks=".concat(document.getElementById("blocks_in_a_day").value, "&days=", document.getElementById("days_in_rotation").value);
}

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

    </script>
  </div>
  </div>
  </body>
</html>
