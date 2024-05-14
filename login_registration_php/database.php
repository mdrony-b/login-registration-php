<?php

    //database connection information
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "login_register";

    //connection query function
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if(!$conn){
        die("database connection error: ");
    }
?>