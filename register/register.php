<?php

session_start();
include('../connection.php');
$Notice = "";
$PNotice = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Updating data to the server
    $Name = $_POST['FullName'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Password = $_POST['Password'];
    $Cpassword = $_POST['Cpassword'];

    //Check Password and Confirm Password
    if ($Cpassword == $Password) {
        //read from database
        $query = mysqli_query($conn, "SELECT Email from user where Email = '$Email'");
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $Notice = "Already Exist";
        } else {
            //Encrpyt the password and insert into `user`
            $hash = password_hash($Password, PASSWORD_DEFAULT);
            settype($Phone, "integer");
            $query = "INSERT INTO user (FullName,Email,Phone,Password) VALUES ('$Name','$Email','$Phone','$hash')";

            mysqli_query($conn, $query);

            header("Location: ../login/login.php");
            die;
        }
    } else {
        $PNotice = "Password and Confirm Password are not same";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Register</title>
</head>

<body>
    <div class="wholecontainer">
        <form method="POST">
            <div class="mb-3">
                <label for="FormControlName" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="FullName" id="FormControlName" required>
            </div>
            <div class="mb-3">
                <label for="FormControlEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" name="Email" id="ormControlEmail" placeholder="name@example.com" required>
                <?php if (!$Notice) { ?>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                <?php } else { ?>
                    <div id="emailHelp" class="form-text" style="color: red;"><?php echo $Notice ?></div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="FormControlPhone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="Phone" id="FormControlPhone" maxlength="10" required>
            </div>
            <div class="mb-3">
                <label for="FormControlPassword" class="form-label">Password</label>
                <input type="password" class="form-control" name="Password" id="FormControlPassword" required>
            </div>
            <div class="mb-3">
                <label for="FormControlCpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="Cpassword" id="FormControlCpassword">
                <div id="emailHelp" class="form-text" style="color: red;"><?php echo $PNotice ?></div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" style="width: fit-content;">Submit</button>
            </div>
        </form>
        <p>Already exist? <a href="../login/login.php">Login</a>.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>