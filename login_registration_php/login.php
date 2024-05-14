<?php
    session_start();
    if(isset($_SESSION["users"])){
        header("Location:index.php");
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
    <title>Login here</title>
  </head>
  <body>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-5 custom_form">
            <?php 
            if(isset($_POST["login"])){
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE user_email = '$email'"; // ready SQL query
                $result = mysqli_query($conn, $sql); //send connection
                $users = mysqli_fetch_array($result, MYSQLI_ASSOC); // return sql object to arry
                if($users){
                    if(password_verify($password, $users["user_password"])){
                        session_start();
                        $_SESSION["users"] = "Yes";
                        header("location:index.php"); // send user after successful login
                        die();
                    }else{
                        echo "<div class='alert alert-danger'>Password doesn't match</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>Email doesn't exist</div>";
                }
            }
            ?>
            <!--login form starts here-->
            <form action="login.php" method="POST">
                <div class="form-grp">
                    <input type="email" name="email" class="form-control mb-3" placeholder="Enter Your Email:">
                </div>
                <div class="form-grp">
                    <input type="password" name="password" class="form-control mb-3" placeholder="Enter Your Password:">
                </div>
                <div class="form-grp">
                    <input type="submit" name="login" value="Login" class="submit form-control btn btn-primary">
                </div>
            </form>
            <div>Did not Register yet <a href="register.php">Register Now</a></div>
            <!--login form starts here-->
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