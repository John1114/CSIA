<?php
include('database_inc.php');
$id = $_GET['id'];
if($_SESSION['loggedin'] == False) {
    //header('location:index.php');
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

    <title>Review Applicants</title>
    <link rel="icon" href="https://i.imgur.com/M3Tvgrs.png">
    <?php
    $testvar = 0;
        $result = mysqli_query($connect,
        "SELECT * FROM applicants WHERE `id` = '$id';");
        while ($row = mysqli_fetch_array($result))
        { 
              $pageTitle = $row['first_name'] . " ". $row['last_name']. "'s Profile";
              $nationalexamname = $row['national_exam_file'];
              $nationalexamdisable = "";
              $testvar = 1;
              if ($nationalexamname == "") {
                $nationalexamdisable = "disabled";
                $testvar = 2;
              }
              $examgradename = $row['final_grades_file'];
              $examgradedisable = "";
                            if ($examgradename == "") {
                $examgradedisable = "disabled";
              }
              $transcriptsname = $row['transcripts_file'];
              $transcriptsdisable = "";
                            if ($transcriptsname == "") {
                $transcriptsdisable = "disabled";
              }
              $idname = $row['identity_file'];
              $iddisable = "";
                            if ($idname == "") {
                $iddisable = "disabled";
              }
              $lettername = $row['letter_file'];
              $letterdisable = "";
                            if ($lettername == "") {
                $letterdisable = "disabled";
              }
              $scholarshipname = $row['scholarship_file'];
              $scholarshipdisable = "";
                            if ($scholarshipname == "") {
                $scholarshipdisable = "disabled";
              }
              $essay_answer = $row['essay_answer'];

        } if (mysqli_fetch_array($result) == 0) {
            $nationalexamdisable = "disabled";
            $testvar = 3;
            $examgradedisable = "disabled";
            $transcriptsdisable = "disabled";
            $iddisable = "disabled";
            $letterdisable = "disabled";
            $scholarshipdisable = "disabled";
        }
    include 'navbarAdmin.php';
    ?>
    <style type="text/css">
    body, html {
  height: 100%;
}

body {  background-image: url(https://i.imgur.com/TeCMWmk.jpg?1);
        height: 100%; 
        /*width: 100%;*/
        /*background-attachment:fixed;*/
        background-position: top;
        background-repeat: repeat;
        background-size: cover;  
      } 
.btn-brown {
    background-color: #98141e;
    color: white;
}
.btn-brown:hover {
    background-color: #a85d58;
    color: white;
}
.card-columns {
    column-count: 2;
  padding: 1%;
}
.bottom-card {
  margin: 1%;
}
</style>
  </head>

  <body>
    <div style="font-family: Verdana">
    <br>
    <div class="card-columns">
<div class="card">
                <div class="card-body">
                  <div class="btn-group float-right" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-brown" onclick=" entries() ">Entries</button>
  <button type="button" class="btn btn-brown" onclick=" allapplicants() ">Applicants</button>
  </div>
  <div class="float-left">
  <h4 class="card-title" id="headerOne">Personal Information</h4>
</div>
  <br>
  <br>
                  <?php 
        if ($_SESSION['reviewSubmitted'] == True) {
    ?>
                    <div class="alert alert-warning" role="alert">
                      Your Review has been saved, this is the next applicant!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

    <?php 
        $_SESSION['reviewSubmitted'] = False;
        }?>
                 
<div class="row my-2">
    <div class="col-12">
    <?php 
        $sortby = $_GET['sortby'];
    if ($sortby != "grades") {
      $sortby = "date";
      $order = "DESC";
    } elseif ($sortby == "grades") {
      $sortby = "finalGrade";
      $order = "DESC";
    }
        $result2 = mysqli_query($connect,
        "SELECT * FROM applicants WHERE `id` = '$id';");
        while ($row = mysqli_fetch_array($result2))
        { 
          $applicant_name = $row['first_name'] . " " . $row['last_name'];
          ?>
                              <div class="form-group">
                                <label for="id" id="firstNameField">Id:</label>
                                <input value="<?php echo $id; ?>" type="text" class="form-control" name="id" id="id" aria-describedby="emailHelp" disabled>
                              </div>
                              <div class="row form-group">
                                <div class="form-group col">
                                <label for="first_name" id="firstNameField">First Name</label>
                                <input value="<?php echo $row['first_name']; ?>" type="text" class="form-control" name="first_name" id="first_name" aria-describedby="emailHelp" placeholder="Enter your First Name"disabled>
                              </div>
                              <div class="form-group col">
                                <label for="last_name" id="lastNameField">Last Name</label>
                                <input value="<?php echo $row['last_name']; ?>"type="text" class="form-control" name="last_name" id="last_name" aria-describedby="emailHelp" placeholder="Enter your Last Name"disabled>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="form-group col">
                                <label for="emailField" id="emailField" name="emailField">Email Address</label>
                                <input value="<?php echo $row['email']; ?>" type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" disabled>
                              </div>
                              <div class="form-group col">
                                <label for="password" id="passwordField">Password</label>
                                <input value="<?php echo $row['password'] ?>" type="text" class="form-control" id="password" name="password"  disabled>
                                <span id='message'></span>
                              </div>
                            </div>
                          <div class="form-group">
                                <label for="citizenship" id="passwordField">Citizenship</label>
                                <input value="<?php echo $row['citizenship'] ?>" type="text" class="form-control" id="citizenship" name="citizenship"  disabled>
                              </div>
                          <div class="form-group">
                            <label for="contact_number" id="contactNumberField">Contact Number, Phone or Whatsapp(include country code)</label>
                            <input type="text" name="contact_number" class="form-control" id="contact_number" value="<?php echo $row['contact_number']; ?>" disabled>
                          </div>
                          <div class="row form-group">
                          <div class="form-group col">
                            <label for="date_of_birth" id="DateOfBirthField">Date of Birth</label>
                            <input type="text" name="date_of_birth" class="form-control" id="date_of_birth" value="<?php echo $row['date_of_birth']; ?>" disabled>
                          </div>
                            <div class="form-group col">
                            <label for="gender" id="DateOfBirthField">Gender</label>
                            <input type="text" name="gender" class="form-control" id="gender" value="<?php echo $row['gender']; ?>" disabled>
                          </div>
                        </div>
                            <div class="form-group">
                            <label for="marrital_status" id="">Marrital Status</label>
                            <input type="text" name="marrital_status" class="form-control" id="marrital_status" value="<?php echo $row['marrital_status']; ?>" disabled>
                          </div>
                          <div class="row form-group">
                           <div class="form-group col">
                            <label for="country" id="">Country of Residence</label>
                            <input type="text" name="country" class="form-control" id="country" value="<?php echo $row['country']; ?>" disabled>
                          </div>
                          <div class="form-group col">
                            <label for="city" id="cityOfResidenceField">City of Residence*</label>
                            <input type="text" name="city" class="form-control" id="city" value="<?php echo $row['city']; ?>" disabled>
                          </div>
                        </div>
                          <br>
                          <h4 class="card-title" id="academicBackgroundField">Academic Background</h4>
                          <div class="row form-group">
                          <div class="form-group col">
                            <label for="type_of_diploma" id="cityOfResidenceField">Type of Diploma</label>
                            <input type="text" name="type_of_diploma" class="form-control" id="type_of_diploma" value="<?php echo $row['type_of_diploma']; ?>" disabled>
                          </div>
                          <div class="form-group col">
                            <label for="diploma_date" id="cityOfResidenceField">Year Diploma Recieved</label>
                            <input type="text" name="diploma_date" class="form-control" id="diploma_date" value="<?php echo $row['diploma_date']; ?>" disabled>
                          </div>
                          <div class="form-group col">
                            <label for="final_Grade" id="cityOfResidenceField">Final Remark</label>
                            <input type="text" name="final_Grade" class="form-control" id="final_Grade" value="<?php echo $row['final_Grade']; ?>" disabled>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="desired_major" id="cityOfResidenceField">Desired Major</label>
                            <input type="text" name="desired_major" class="form-control" id="desired_major" value="<?php echo $row['desired_major']; ?>" disabled>
                          </div>
                          <div class="form-group">
                            <label for="first_time_applicant" id="cityOfResidenceField">Have you applied to A.D.U. before?</label>
                            <input type="text" name="first_time_applicant" class="form-control" id="first_time_applicant" value="<?php echo $row['first_time_applicant']; ?>" disabled>
                          </div>
                          <div class="form-group">
                            <label for="learning_disability" id="cityOfResidenceField">Do you have a disability or learning difficulty that may affect your learning while at A.D.U.?</label>
                            <input type="text" name="learning_disability" class="form-control" id="learning_disability" value="<?php echo $row['learning_disability']; ?>" disabled>
                          </div>
                            <div class="form-group">
                            <label for="career_aspirations" id="cityOfResidenceField">What career do you hope to pursue?</label>
                            <input type="text" name="career_aspirations" class="form-control" id="career_aspirations" value="<?php echo $row['career_aspirations']; ?>" disabled>
                          </div>
                          <br>
                          <h4 class="card-title" id="familyInformationHeader">Family Information</h4>
                          <div class="row form-group">
                              <div class="col">
                                <input type="text" readonly class="form-control-plaintext" id="guardianOneField" value="Guardian One">
                              </div>
                              <div class="col">
                                <input type="text" readonly class="form-control-plaintext" id="guardianTwoField" value="Guardian Two">
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_one_name" id="guardian_one_name"  value="<?php echo $row['guardian_one_name']; ?>"placeholder="Full name*" disabled >
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_two_name" id="guardian_two_name" value="<?php echo $row['guardian_two_name']; ?>"placeholder="Full name" disabled>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_one_life" id="guardian_one_life" value="<?php echo $row['guardian_one_life']; ?>"placeholder="Is he/she/ alive?*" disabled >
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_two_life" id="guardian_two_life" value="<?php echo $row['guardian_two_life']; ?>"placeholder="Is he/she/ alive?" disabled>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_one_relationship" id="guardian_one_relationship" value="<?php echo $row['guardian_one_relationship']; ?>"placeholder="Relationship to you*" disabled >
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_two_relationship" id="guardian_two_relationship" value="<?php echo $row['guardian_two_relationship']; ?>"placeholder="Relationship to you" disabled>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_one_phone_number" id="guardian_one_phone_number" value="<?php echo $row['guardian_one_phone_number']; ?>"placeholder="Phone Number*" disabled >
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_two_phone_number" id="guardian_two_phone_number" value="<?php echo $row['guardian_two_phone_number']; ?>"placeholder="Phone Number" disabled>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_one_email" id="guardian_one_email" value="<?php echo $row['guardian_one_email']; ?>"placeholder="Email" disabled>
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_two_email" id="guardian_two_email" value="<?php echo $row['guardian_two_email']; ?>"placeholder="Email" disabled>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_one_education" id="guardian_one_education" value="<?php echo $row['guardian_one_education']; ?>"placeholder="Education*" disabled >
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_two_education" id="guardian_two_education" value="<?php echo $row['guardian_two_education']; ?>"placeholder="Education" disabled>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_one_employer" id="guardian_one_employer" value="<?php echo $row['guardian_one_employer']; ?>"placeholder="Employer" disabled>
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_two_employer" id="guardian_two_employer" value="<?php echo $row['guardian_two_employer']; ?>"placeholder="Employer" disabled>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_one_job_title" id="guardian_one_job_title" value="<?php echo $row['guardian_one_job_title']; ?>"placeholder="Job Title" disabled>
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" name="guardian_two_job_title" id="guardian_two_job_title" value="<?php echo $row['guardian_two_job_title']; ?>"placeholder="Job Title" disabled>
                              </div>
                            </div>
                          <br>
                      
</div>
</div>

                </div>
  </div>
  <div class="card" style="margin-right:1%">
   <div class="card-body">
<form action="profileProcess.php" method="POST">
                          <div class="form-group">
                            <label for="reviewer_name">Reviewers Name</label>
                            <input type="text" name="reviewer_name" class="form-control" id="reviewer_name" aria-describedby="nameHelp" placeholder="Enter your name" required="">
                            <!-- <small id="nameHelp" class="form-text text-muted">We'll never share your name with anyone else.</small> -->
                          </div>
                          <div class="form-group">
                            <label for="applicant_name">Applicant Name</label>
                            <select name="applicant_name" class="form-control" id="applicant_name" required="">

                                    <option ><?php echo $applicant_name; ?></option>

                            </select>
                          </div>
                          <hr>
                          <div class="form-group">
                          <h5>Intellectual Capacity</h5>
                          <p>This evaluates the students academic background with their final grade/ final report from the Bac exam.</p>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_capacity" id="review_capacity" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                              1: Passable 
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_capacity" id="review_capacity" value="2">
                            <label class="form-check-label" for="exampleRadios2">
                              2: Assez bien 
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_capacity" id="review_capacity" value="3">
                            <label class="form-check-label" for="exampleRadios2">
                              3: Bien 
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_capacity" id="review_capacity" value="4">
                            <label class="form-check-label" for="exampleRadios2">
                              4: Tres Bien 
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_capacity" id="review_capacity" value="5">
                            <label class="form-check-label" for="exampleRadios2">
                              5: Tres bien with a fantastic track record from  the previous years. Ideally 16+/20
                            </label>
                          </div>
                          </div>
                          <hr>
                          <div class="form-group">
                          <h5>Commitment to development of Niger/Africa </h5>
                          <p>Reading the student's essay you can define if the student is committed and really took their application seriously and you can define by their attitude and by the content of the student is committed to the developmnet of Niger or Afria at large </p>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_commitment" id="review_commitment" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                              1: No mention of Niger or Africa in the essay
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_commitment" id="review_commitment" value="2">
                            <label class="form-check-label" for="exampleRadios2">
                              2: Little to no mention of Niger of Africa
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_commitment" id="review_commitment" value="3">
                            <label class="form-check-label" for="exampleRadios2">
                              3: Applicant has been thinking of making changes in his/her community but has not initiated anything yet
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_commitment" id="review_commitment" value="4">
                            <label class="form-check-label" for="exampleRadios2">
                              4: Applicant took the initiative and started something in their community but no impact yet or they have been highly involved in activities to develop their community
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_commitment" id="review_commitment" value="5">
                            <label class="form-check-label" for="exampleRadios2">
                              5: Applicant took an initiative, demonstrated impact and has been recognised on a regional or international level
                            </label>
                          </div>
                          </div>
                          <hr>
                          <div class="form-group">
                          <h5>Overall quality of application </h5>
                          <p>The more elaborate the student is in filling out the aplication form defines their commitment and eagerness to intergrate the school, the students who opt to use the online application form also might be more innovtive and open to adopting technology than other</p>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_quality" id="review_quality" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                              1: No attention to details, very short and brief answers, used manual form
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_quality" id="review_quality" value="2">
                            <label class="form-check-label" for="exampleRadios2">
                              2: little to no attention to details, brief aanswers but straight to the point, used manual form
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_quality" id="review_quality" value="3">
                            <label class="form-check-label" for="exampleRadios2">
                              3: Attention to details, forms well filled and elaborate answers but does not address the prompt, used manual form
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_quality" id="review_quality" value="4">
                            <label class="form-check-label" for="exampleRadios2">
                              4: Consize and precise elaborate answers, responding to the prompt, used manual form or online form
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="review_quality" id="review_quality" value="5">
                            <label class="form-check-label" for="exampleRadios2">
                              5: Consize and precise elaborate answers, responds to the prompt, submitted an online form
                            </label>
                          </div>
                          </div>
                          <hr>
                          <div class="form-group">
                          <h5>Applied for scholarship </h5>
                          <p></p>
                            <select id="review_scholarship" name="review_scholarship" class="form-control">
                              <option selected value="Yes">Yes</option>
                              <option value="No">No</option>
                            </select>
                          </div>
                          <hr>
                          <button type="submit" class="wpcf7-form-control wpcf7-submit laborator-btn btn btn-index-1 btn-type-st andard btn-secondary btn-large hc-cta-send" style="width:100%; height:50px; background-color: #98141e"> Submit Review</button>
                        </form>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      
   <div class="form-group">
                            <label for="scholarship" id="cityOfResidenceField">Do you intend to apply for financial assistance from A.D.U.?</label>
                            <input type="text" name="scholarship" class="form-control" id="scholarship" value="<?php echo $row['scholarship']; ?>" disabled>
                          </div>
                          <div class="form-group">
                            <label for="family_at_adu" id="cityOfResidenceField">Are any of your family members enrolled at A.D.U. at the moment, or have been in the past?</label>
                            <input type="text" name="family_at_adu" class="form-control" id="family_at_adu" value="<?php echo $row['family_at_adu']; ?>" disabled>
                          </div>
                            <div class="form-group">
                            <label for="other_applications" id="cityOfResidenceField">Have you applied or are you planning to apply anywhere else?</label>
                            <input type="text" name="other_applications" class="form-control" id="other_applications" value="<?php echo $row['other_applications']; ?>" disabled>
                          </div>
                          <div class="form-group">
                            <label for="source" id="cityOfResidenceField">How did you hear about us?</label>
                            <input type="text" name="source" class="form-control" id="source" value="<?php echo $row['source']; ?>" disabled>
                          </div>
                          <div class="form-group">
                            <label for="status" id="cityOfResidenceField">What is the status of their application (If completed 'Completed' will be displayed)</label>
                            <input type="text" name="status" class="form-control" id="status" value="<?php echo $row['status']; ?>" disabled>
                          </div>

    </div>
  </div>
</div>
<?php  }  ?>
<div class="bottom-card card">
<div class="card-body">
                            <h4 class="card-title" id="essayHeader">Essay</h4>
                            <div class="form-group">
                              <textarea class="form-control" id="essay_answer" name="essay_answer" rows="10" placeholder="Essay" disabled><?php echo $essay_answer; ?></textarea>
                            </div>
                            <br>
                            <br>
                              <h4>Files</h4>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn-brown btn <?php echo $nationalexamdisable ?>" <?php echo $nationalexamdisable ?> onclick="nationalexam()" >High School National Exit Exam</button>
                                <button type="button" class="btn-brown btn <?php echo $examgradedisable ?>" <?php echo $examgradedisable ?> onclick="examgrade()" >High School Final Exam Grade</button>
                                <button type="button" class="btn-brown btn <?php echo $transcriptsdisable ?>" <?php echo $transcriptsdisable ?> onclick="transcripts()" >Transcripts from your last year of High School</button>
                                <button type="button" class="btn-brown btn <?php echo $iddisable ?>" <?php echo $iddisable ?> onclick="idocument()" >Scan of your birth certificate or identity document</button>
                                <button type="button" class="btn-brown btn <?php echo $letterdisable ?>" <?php echo $letterdisable ?> onclick="letter()" >Letter of Recommandation</button>
                                <button type="button" class="btn-brown btn <?php echo $scholarshipdisable ?>" <?php echo $scholarshipdisable ?> onclick="scholarship()" >Scholarship Form</button>
                              </div>
                              <br>
                              <br>
                            <br>
  <h4>Reviews</h4>
                <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">id</th>
                <th scope="col">Reviewer</th>
                <th scope="col">Criteria 1</th>
                <th scope="col">Criteria 2</th>
                <th scope="col">Criteria 3</th>
                <th scope="col">Final Grade</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $result3 = mysqli_query($connect,
        "SELECT * FROM reviews WHERE `applicant_name` = '$applicant_name';");
        while ($row = mysqli_fetch_array($result3))
        { ?>
              <tr>
                <th><?php echo $row['id']; ?> </th>
                <td><?php echo $row['reviewer_name']; ?> </td>
                <td><?php echo $row['review_capacity']; ?> </td>
                <td><?php echo $row['review_commitment']; ?> </td>
                <td><?php echo $row['review_quality']; ?> </td>
                <td><?php echo $row['final_grade']; ?> </td>
                <td><?php echo $row['date']; ?> </td>
                <td><?php echo "<a href=\"editEntry.php?id=" . $row['id']. "\">Edit</a>" . "| " . "<a href=\"removeEntry.php?id=" . $row['id']. "\">Delete</a>"; ?> 
              </td>
            </tr>
            <?php 
                }?>
                </tbody>
            </table>
            <?php
                if (mysqli_num_rows($result3) == 0) { ?>
                  
                  <div class="alert alert-danger" role="alert">
                                        No Reviews yet
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                  <?php
            }
            ?>
            
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
function nationalexam() {
window.open("http://ilimi1420597.webdb67.lwspanel.com/applications/uploads/<?php echo $nationalexamname ?>", "_blank");
}
function examgrade() {
window.open("http://ilimi1420597.webdb67.lwspanel.com/applications/uploads/<?php echo $examgradename ?>", "_blank");
}
function transcripts() {
window.open("http://ilimi1420597.webdb67.lwspanel.com/applications/uploads/<?php echo $transcriptsname ?>", "_blank");
}
function idocument() {
window.open("http://ilimi1420597.webdb67.lwspanel.com/applications/uploads/<?php echo $idname ?>", "_blank");
}
function letter() {
window.open("http://ilimi1420597.webdb67.lwspanel.com/applications/uploads/<?php echo $lettername ?>", "_blank");
}
function scholarship() {
window.open("http://ilimi1420597.webdb67.lwspanel.com/applications/uploads/<?php echo $scholarshipname ?>", "_blank");
}
      function allapplicants() {
        location.href = "applicants.php";
      }
      function entries() {
        location.href = "admin.php";
      }
      </script>
  </body>