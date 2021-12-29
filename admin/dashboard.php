<?php

session_start();
include('../connection.php');
include("../check.php");

$user_data = check_login($conn);
$Notice = "";
$PNotice = "";
$Company = mysqli_query($conn, "select * from job");
$Candidates = mysqli_query($conn, "select * from candidates");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  //Updating data to the server
  $CompanyName = $_POST['CompanyName'];
  $Position = $_POST['Position'];
  $Jobdes = $_POST['Jobdescription'];
  $Skills = $_POST['Skills_Required'];
  $CTC = $_POST['CTC'];

  //Check Password and Confirm Password
  $query = "INSERT INTO job (CompanyName,Position,Job_description,Skills_Required,CTC) VALUES ('$CompanyName','$Position','$Jobdes','$Skills','$CTC')";

  mysqli_query($conn, $query);

  header("Refresh:0");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="dashboard.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <title>Dashboard</title>
</head>

<body>
  <div class="head">
    <a href="../logout.php">
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16" style="float: right; margin-right: 25px">
        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
      </svg>
    </a>
    <h2 style="width: fit-content;">Admin Dashboard</h2>
  </div>
  <div class="postjob" id="postjob">
    <div class="area">
      <button type="button" class="btn-close" id="closepostjob" aria-label="Close" style="float: right"></button>
      <form method="POST">
        <div class="mb-3">
          <label for="FormControlCompany" class="form-label">Company Name</label>
          <input type="text" class="form-control" name="CompanyName" id="FormControlCompany" required />
        </div>
        <div class="mb-3">
          <label for="FormControlPosition" class="form-label">Position</label>
          <input type="text" class="form-control" name="Position" id="FormControlPosition" required />
        </div>
        <div class="mb-3">
          <label for="FormControlDescription" class="form-label">Job Description</label>
          <textarea class="form-control" id="FormControlDescription" name="Jobdescription" rows="5" style="min-height: 100px"></textarea>
        </div>
        <div class="mb-3">
          <label for="FormControlSkills" class="form-label">Skills Required</label>
          <input type="text" class="form-control" name="Skills_Required" id="FormControlSkills" required />
        </div>
        <div class="mb-3">
          <label for="FormControlCTC" class="form-label">CTC</label>
          <input type="text" class="form-control" name="CTC" id="FormControlCTC" />
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary" style="width: fit-content">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
  <div class="sidebar">
    <a onclick="change(0)">Jobs</a>
    <a onclick="change(1)">Candidates Applied</a>
    <a onclick="change(2)">Contact</a>
    <a onclick="change(3)">About</a>
  </div>
  <div class="content">
    <div class="jobs" id="0">
      <button type="button" class="btn btn-primary" id="openpostjob">
        Post Job
      </button>
      <table class="table" style="margin-top: 20px">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Company Name</th>
            <th scope="col">Position</th>
            <th scope="col">CTC</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          while ($list = mysqli_fetch_array($Company)) { ?>
            <tr>
              <th scope="row"><?php echo $i++ ?></th>
              <td><?php echo $list['CompanyName'] ?></td>
              <td><?php echo $list['Position'] ?></td>
              <td><?php echo $list['CTC'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="candidates" id="1" style="display: none">
      <table class="table" style="margin-top: 20px">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Candidate Name</th>
            <th scope="col">Position</th>
            <th scope="col">Year Passout</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          while ($list = mysqli_fetch_array($Candidates)) { ?>
            <tr>
              <th scope="row"><?php echo $i++ ?></th>
              <td><?php echo $list['Name'] ?></td>
              <td><?php echo $list['Position'] ?></td>
              <td><?php echo $list['Year_Passout'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="contact" id="2" style="display: none">
      <h1>Contact</h1>
      <p style="font-size: large;">
        <b>Address:</b> 190, Sundaram Pillai Nagar, 1st Main Street, Tondiarpet, Chennai - 600 081.<br>
        <b>Email:</b> <a href="mailto: krishnakrrish736@gmail.com">krishnakrrish736@gmail.com</a><br>
        <b>Phone:</b> 7358562560
      </p>
    </div>
    <div class="about" id="3" style="display: none">
      <h1>About</h1>
      <p>
        My name is <b>Sanjay R. Krishna</b>. Born and grown in <b>Chennai</b>. Currently studying at National Institute of Technology, Tiruchirappalli.
      <h5>Hobbies: </h5>
      <ul>
        <li>Coding</li>
        <li>Listening to music</li>
        <li>Watching movies and series</li>
        <li>Reading Novels</li>
      </ul>
      <h5>Stack known:</h5>
      <ul>
        <ul>
          <li>C/C++</li>
          <li>Python</li>
        </ul>
        <li>
          <h6>Frontend stack</h6>
          <ul>
            <li>HTML</li>
            <li>CSS</li>
            <li>Javascript</li>
            <li>React JS</li>
          </ul>
        </li>
        <li>
          <h6>Backend stack</h6>
          <ul>
            <li>PHP</li>
            <li>GraphQL</li>
            <li>Express</li>
            <li>Node JS</li>
            <li>MySQL</li>
            <li>Rust</li>
          </ul>
        </li>
      </ul>
      </p>
    </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    var openpostjob = document.getElementById("openpostjob");
    var closepostjob = document.getElementById("closepostjob");
    openpostjob.addEventListener("click", function() {
      document.getElementById("postjob").style.display = "flex";
      openpostjob.disabled = "true";
    });
    closepostjob.addEventListener("click", function() {
      document.getElementById("postjob").style.display = "none";
      openpostjob.removeAttribute("disabled");
    });

    function change(t) {
      for (let i = 0; i <= 3; i++) {
        if (i == t) {
          document.getElementById(i).style.display = "";
        } else {
          document.getElementById(i).style.display = "none";
        }
      }
    }
  </script>
</body>

</html>