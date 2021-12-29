<?php

session_start();
$Notice = "";
include("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    //read from database
    $query = "SELECT * from user where Email = '$Email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);

            if (password_verify($Password, $user_data['Password'])) {
                $_SESSION['Email'] = $user_data['Email'];
                header("Location: ../admin/dashboard.php", true);
                die;
            } else {
                $Notice = "Bad Credentials!";
            }
        } else {
            $Notice = "Credentials doesn't exist";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <div class="wholecontainer">
        <form method="POST">
            <span style="color: red;float: left;position: absolute;"><?php echo $Notice ?></span>
            <div class="mb-3" style="padding-top: 20px;">
                <label for="InputEmail" class="form-label">Email address</label>
                <input type="email" name="Email" class="form-control" id="InputEmail" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" name="Password" class="form-control" id="InputPassword" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <p>Don't Have Account? Click here to <a href="../register/register.php">Register</a>.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>