<?php

function check_login($conn)
{

	if(isset($_SESSION['Email']))
	{

		$id = $_SESSION['Email'];
		$query = "SELECT * from user where Email = '$id'";

		$result = mysqli_query($conn,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: ../login/login.php");
	die;

}