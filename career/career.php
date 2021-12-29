<?php

session_start();
include("../connection.php");
include("../check.php");

$Company = mysqli_query($conn, "select * from job");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Updating data to the server
    $Name = $_POST['Name'];
    $Position = $_POST['Position'];
    $Qualification = $_POST['Qualification'];
    $year = $_POST['year'];

    //Check Password and Confirm Password
    $query = "INSERT INTO candidates (Name,Position,Qualification,Year_Passout) VALUES ('$Name','$Position','$Qualification','$year')";

    mysqli_query($conn, $query);

    header("Refresh:0");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="career.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .applyjob {
            width: 100%;
            height: 100%;
            display: none;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.6);
            position: fixed;
            z-index: 1;
        }

        .applyjob .area {
            height: fit-content;
            margin-top: 7%;
            width: 650px;
            outline: 0.5px solid;
            border-radius: 5px;
            padding: 20px;
            background-color: white;
        }
    </style>
    <title>Career</title>
</head>

<body>
<div class="applyjob" id="postjob">
            <div class="area">
                <button type="button" class="btn-close" id="closepostjob" aria-label="Close" style="float: right"></button>
                <form method="POST">
                    <div class="mb-3">
                        <label for="FormControlName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="Name" id="FormControlName" required />
                    </div>
                    <div class="mb-3">
                        <label for="FormControlPosition" class="form-label">Applying for</label>
                        <input type="text" class="form-control" name="Position" id="FormControlPosition" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="FormControlQualification" class="form-label">Qualification</label>
                        <input type="text" class="form-control" id="FormControlQualification" name="Qualification" required />
                    </div>
                    <div class="mb-3">
                        <label for="FormControlyearpassout" class="form-label">Year Passout</label>
                        <input type="text" class="form-control" name="year" id="FormControlyearpassout" />
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" style="width: fit-content">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <div class="wholecontainer">
        <div class="head">
            <div>
                <h1>Job Portal</h1>
                <p>Best Jobs available matching your skills</p>
            </div>
        </div>
        <div class="body">
            <?php while ($list = mysqli_fetch_array($Company)) { ?>
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $list['Position'] ?></h2>
                        <h4 class="card-title"><?php echo $list['CompanyName'] ?></h4>
                        <p class="card-text"><?php echo $list['Job_description'] ?></p>
                        <p class="card-text"><b>Skills Required: </b><?php echo $list['Skills_Required'] ?></p>
                        <p class="card-text"><b>CTC: </b><?php echo $list['CTC'] ?></p>
                        <button class="btn btn-primary" onclick="openapplyjob('<?php echo $list['CompanyName'] ?> - <?php echo $list['Position'] ?>')">Apply Now</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        var closepostjob = document.getElementById("closepostjob");

        function openapplyjob(t) {
            document.getElementById("postjob").style.display = "flex";
            document.getElementById("FormControlPosition").value = t;
        }
        closepostjob.addEventListener("click", function() {
            document.getElementById("postjob").style.display = "none";
            openpostjob.removeAttribute("disabled");
        });
    </script>
</body>

</html>