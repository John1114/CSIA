<?php
session_start();
include 'database_inc.php';
include 'navbar.php';
$scheduleid = $_GET['id'];
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
.btn-red {
    background-color: #dc3c45;
    color: white;
}
.btn-red:hover {
    background-color: transparent;
    border-color: #dc3c45;
    color: #dc3c45;
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
                  <h1 id="cardHeader">Personlize Your Schedule </h3>
                </div>
                <br>
                    <div class="row">
                      <div class="col-9">
                        <form action="downloadpersonlizedschedule.php" method="POST">
                        <?php
                        $result = mysqli_query($connect,
                            "SELECT * FROM schedules WHERE `ready` = 1 AND `id` = '$scheduleid';");
                        while ($row = mysqli_fetch_array($result)) { 
                          $blocks = unserialize($row['blocks']);
                          foreach($blocks as $period) {
                          ?>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default"><?php echo($period) ?></span>
                          </div>
                          <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Name" name="<?php echo($period."_"."Name") ?>" id="<?php echo($period."_"."Name")?>" onkeyup='savevaluelocally("<?php echo($period."_"."Name") ?>");' value=''> </input>
                          <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Teacher" name="<?php echo($period."_"."Teacher") ?>" id="<?php echo($period."_"."Teacher")?>" onkeyup='savevaluelocally("<?php echo($period."_"."Teacher") ?>");'  value=''> </input>
                          <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Room" name="<?php echo($period."_"."Room") ?>" id="<?php echo($period."_"."Room")?>" onkeyup='savevaluelocally("<?php echo($period."_"."Room") ?>");'  value=''> </input>
                          <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Notes" name="<?php echo($period."_"."Notes") ?>" id="<?php echo($period."_"."Notes")?>" onkeyup='savevaluelocally("<?php echo($period."_"."Notes") ?>");'  value=''> </input>
                          <input type="hidden" name="scheduleid" value="<?php echo($scheduleid) ?>">
                        </div>
                          <script type="text/javascript"> 
                          document.getElementById('<?php echo($period."_"."Name") ?>').value = localStorage.getItem('<?php echo($period."_"."Name") ?>') || "";
                          document.getElementById('<?php echo($period."_"."Teacher") ?>').value = localStorage.getItem('<?php echo($period."_"."Teacher") ?>') || "";
                          document.getElementById('<?php echo($period."_"."Room") ?>').value = localStorage.getItem('<?php echo($period."_"."Room") ?>') || "";
                          document.getElementById('<?php echo($period."_"."Notes") ?>').value = localStorage.getItem('<?php echo($period."_"."Notes") ?>') || "";
                          </script>
                      <?php }?>
                      </div>
                    <div class="col-3">
                      <button type="submit" class="btn btn-red btn-lg btn-block" style="font-size: 15px; height: 64%">Download your personlized schedule in .csv format</button>
                    </form>
                      <button type="button" class="btn btn-red btn-lg btn-block" style="font-size: 15px; height: 36%" onclick="window.location.href='downloadblank.php?id=<?php echo($scheduleid) ?>'">Download a blank schedule in .csv format</button>
                    </div>
                  <?php } if (mysqli_num_rows($result) == 0) { ?>
                      <div class="alert alert-danger" role="alert">
                        The chosen schedule is not avaiable
                      </div>
                 <?php } ?>
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
      function savevaluelocally(period) {
        localStorage.setItem(period, document.getElementById(period).value);
      };
      <?php if($schedule_to_download_name != "") {?>

      document.getElementById('download_tag').click();
      location.href="automaticremoveschedule.php?name=<?php echo($schedule_to_download_name) ?>&id=<?php echo($scheduleid) ?>";
      //location.href="personalizeschedule.php?id=<?php echo($scheduleid) ?>";

      <?php } ?>
    </script> 
  </div>
  </div>
  </body>
</html>