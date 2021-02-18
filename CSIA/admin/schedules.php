<?php
session_start();
if ($_SESSION['logged_in'] != True) {
  header('location:index.php');
}
$pagetitle = "All Schedules";
include 'database_inc.php';
include 'navbar.php';
$schedule_to_download_name = $_GET['name'];
?>
<!doctype html>
<html lang="en">
<a id="download_tag" href="<?php echo($schedule_to_download_name);?>" download></a>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Schedule Personilizer</title>
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
.btn-blue-outline {
    background-color: transparent;
    border-color: #58c4ef;
    color: #58c4ef;
}
.btn-blue:hover {
    background-color: transparent;
    border-color: #58c4ef;
    color: #58c4ef;
}
.btn-blue-outline:hover {
    background-color: #58c4ef;
    color: white;
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
                  <h1 id="cardHeader">All Schedules</h3>
                </div>
                  <?php
        $schedule_added = $_SESSION['schedule_added'];
        if ($schedule_added == true) {
        echo '
            <div class="row my-3">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                     Schedule has been created.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>            
            ';
    }; 
    unset($_SESSION['schedule_added']);

    $entryDeleted = $_SESSION['entryDeleted'];
        if ($entryDeleted == true) {
        echo '
            <div class="row my-3">
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Schedule has been removed.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>            
            ';
    }; 
    unset($_SESSION['entryDeleted']);
    ?>
                  <hr>
                  <?php
                    $result = mysqli_query($connect,
                        "SELECT * FROM schedules");
                    while ($row = mysqli_fetch_array($result))
                    { ?>
                      <div class="form-inline">
                      <div class="col-md-6">
                      <button type="submit" class="btn btn-blue btn-lg btn-block" onclick="window.location.href='downloadblank.php?id=<?php echo($row['id']) ?>'" style="height: 50px; font-size: 15px" id="buttonText"><b><?php echo($row['name'])?></b><br><tiny style="font-size: 10px">Last updated:<?php echo($row['updateddate'])?></tiny></button>
                      <!-- <button class="btn btn-red btn-lg btn-block">test</button> -->
                      </div>
                      <div class="col-md-2">
                        <button class="btn btn-secondary btn-lg btn-block" style="height: 50px; font-size: 15px" onclick="window.location.href='editschedule.php?id=<?php echo($row['id'])?>'">Edit</button>
                      </div>
                      <div class="col-md-2">
                        <button class="btn btn-secondary btn-lg btn-block" style="height: 50px; font-size: 15px" onclick="window.location.href='removeschedule.php?id=<?php echo($row['id'])?>'">Remove</button>
                      </div>
                      <div class="col-md-2">
                      <?php
                      if ($row['ready'] == 0) { ?>
                        <button class="btn btn-outline-danger btn-lg btn-block" style="height: 50px; font-size: 15px" onclick="window.location.href='changeready.php?id=<?php echo($row['id'])?>'" ><b>Not Live</b></button>
                      <?php }
                      else { ?>
                        <button class="btn btn-outline-success btn-lg btn-block" style="height: 50px; font-size: 15px" onclick="window.location.href='changeready.php?id=<?php echo($row['id'])?>'" ><b>Live</b></button>
                      <?php }; ?>
                      </div>
                    </div>
                      <br>
                    <? } if (mysqli_num_rows($result) == 0) { ?>
                      <div class="alert alert-danger" role="alert">
                        There are no created schedules
                      </div>
                 <?php } ?>
                 <div class="col-md-12">
                      <button type="submit" class="btn btn-blue btn-lg btn-block" onclick="window.location.href='createschedule.php'" style="height: 50px; font-size: 20px" id="buttonText">+ Create New Schedule</button>
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
    <script type="text/javascript">
      <?php if($schedule_to_download_name != "") {?>

      document.getElementById('download_tag').click();
      location.href="automaticremoveschedule.php?name=<?php echo($schedule_to_download_name) ?>";
      //location.href="personalizeschedule.php?id=<?php echo($scheduleid) ?>";

      <?php } ?>
    </script>
  </div>
  </div>
  </body>
</html>