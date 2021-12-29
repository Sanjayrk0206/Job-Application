<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobapplication";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    if (mysqli_connect_error() === "Unknown database '$dbname'"){
        $conn = mysqli_connect($servername, $username, $password);
        $sql = "CREATE DATABASE IF NOT EXISTS jobapplication";
        if (mysqli_query($conn, $sql)) {
            $con = mysqli_connect($servername, $username, $password, "jobapplication");
            $table = "CREATE TABLE IF NOT EXISTS user (
                FullName VARCHAR(255) NOT NULL,
                Email varchar(255) NOT NULL PRIMARY KEY,
                Phone BIGINT NOT NULL,
                Password VARCHAR(255) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            mysqli_query($con, $table);
            $table = "CREATE TABLE IF NOT EXISTS job (
                CompanyName VARCHAR(255) NOT NULL PRIMARY KEY,
                Position varchar(255) NOT NULL,
                Job_description varchar(255) NOT NULL,
                Skills_Required varchar(255) NOT NULL,
                CTC varchar(255) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            mysqli_query($con, $table);
            $table = "CREATE TABLE IF NOT EXISTS candidates (
                Name VARCHAR(255) NOT NULL PRIMARY KEY,
                Position varchar(255) NOT NULL,
                Qualification varchar(255) NOT NULL,
                Year_Passout Year NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            mysqli_query($con, $table);
            mysqli_close($con);
        }
        mysqli_close($conn);
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
}