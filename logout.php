<?php

session_start();

if(isset($_SESSION['Email']))
{
	unset($_SESSION['Email']);

}

header("Location: login/login.php",true);
die;