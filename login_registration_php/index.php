<?php 

    session_start();

    if(!isset($_SESSION["users"])){
        header("Location:login.php");
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
    <title>User Dashboard</title>
  </head>
  <body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-7 col-md-5">
                <div class="dashbord">
                    <h1>User dashboard</h1> 
                    <p><a href="logout.php" class="btn btn-warning btn-sml mt-2">LogOut</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Boostrap cdn link-->        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>