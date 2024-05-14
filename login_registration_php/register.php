<?php

    session_start();
    if(isset($_SESSION["users"])){
        header("location: index.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- custom css -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Register here</title>
  </head>
  <body>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-5 custom_form">
            <?php
              if(isset($_POST["register"])){
                $name = $_POST["name"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $repeatPassword = $_POST["repeat_password"];

                //hasing password
                $passwordHashing = password_hash($password, PASSWORD_DEFAULT);

                //declare error var using arrary function
                $error = array();

                //check emply field
                if(empty($name) || empty($email) || empty($password) || empty($repeatPassword)){
                    array_push($error, "Emtpty required all fields");
                }
                //check valid email address
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($error, "Email is not valid");
                }
                //check password length
                if(strlen($password)<8){
                    array_push($error, "Password must be at least 8 characters");
                }
                //check repeated password
                if($password !== $repeatPassword){
                    array_push($error, "Password did not match");
                }
                //check email exists 
                require_once "database.php";
                $query = "SELECT * FROM users WHERE user_email = '$email'"; //reday sql query
                $result = mysqli_query($conn, $query);//send query into database
                $rowCount = mysqli_num_rows($result); //retune number of rows
                    if($rowCount > 0){
                        array_push($error, "Email already exists");
                    }
                //print all error message 
                if(count($error)>0){
                    foreach($error as $printAllError){
                        echo "<div class='alert alert-danger'>$printAllError</div>";
                    }
                }
                //insert data into database if no error
                else{
                    $sql = "INSERT INTO users(user_name, user_email, user_password) values(?, ?, ?)"; //ready sql query
                            // $result = mysqli_query($conn, $sql);
                            // if($result){
                            //     echo "<div class='alert alert-success'>Your are successfully registered</div>";
                            // }else{
                            //     die("something went wrong");
                            // };
                    // for GOOG practice
                    $stmt =  mysqli_stmt_init($conn); //Initialize a new prepared statement
                    $preparestmt = mysqli_stmt_prepare($stmt, $sql);// prepare statement
                    if($preparestmt){
                        mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $passwordHashing);//
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Your are successfully registered</div>";
                    }else{
                        die("something went wrong");
                    }

                }
              }

              
            ?>
            <!--Registration form starts here-->
            <form action="register.php" method="POST">
                <div class="form-grp">
                    <input type="text" name="name" class="form-control my-3" placeholder="Enter Your Name:">
                </div>
                <div class="form-grp">
                    <input type="email" name="email" class="form-control mb-3" placeholder="Enter Your Email:">
                </div>
                <div class="form-grp">
                    <input type="password" name="password" class="form-control mb-3" placeholder="Enter Your Password:">
                </div>
                <div class="form-grp">
                    <input type="password" name="repeat_password" class="form-control mb-3" placeholder="Enter Your Repeat Password:">
                </div>
                <div class="form-grp">
                    <input type="submit" name="register" value="Register" class="submit form-control btn btn-primary">
                </div>
            </form>
            <div>You have already Register <a href="login.php">Login Now</a></div>
            <!--Registration form starts here-->
        </div>
    </div>
</div>





    <!-- Prevent resubmission form-->        
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>

    <!-- Boostrap cdn link-->        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>