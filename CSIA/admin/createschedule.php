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
                        <div class="col-9">
                          <div class="card">
                            <div class="card-body">
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
                              <ul class="nav nav-tabs">
                              <?php
                              $day_number = 0;
                              while($day_number < $days_in_rotation) {?>
                                <li class="nav-item">
                                  <button class="tablink nav-link active btn-blue" onclick="openPage('Home', this)"><?php echo("Day ".($day_number+1)) ?></button>
                               </li>
                               <?php 
                               $day_number += 1;
                                  } ?>
                              </ul>
                              <div id="Home" class="tabcontent">
                                <br>
                                <?php 
                                $block_number = 0;
                                while($block_number < $blocks_in_a_day) {?>
                                  <div class="input-group input-group-sm mb-3">
                                  <input type="text" class="form-control col-3" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Name">
                                  <input type="text" class="form-control col-9" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Time">
                                </div>
                                  <?
                                  $block_number += 1;
                                }
                                ?>
                              </div>

                              <div id="News" class="tabcontent">
                                <h3>News</h3>
                                <p>Some news this fine day!</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="card">
                            <div class="card-body">
                              <h1>help</h1>
                            </div>
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
function openPage(pageName, elmnt) {
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
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
    </script>
  </div>
  </div>
  </body>
</html>