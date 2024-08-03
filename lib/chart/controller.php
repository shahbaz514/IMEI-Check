<?php
session_start();
session_abort();
include "../../db/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IMEICHECK.UK - SignIn</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../css/style.css" rel="stylesheet">
    
    <style>
        .form-control{
            color:#000;
        }
    </style>
</head>
    <body>

    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <?php
                if (isset($_SESSION['ousername']))
                {
                    ?>
                    <a href="controller.php" class="form-control btn-secondary">
                        Dashboard
                    </a>
                    <a href="controller.php?page=logout" class="form-control btn-danger">
                        Logout
                    </a>
                    <?php
                }
                ?>
            </div>
            <div class="col-sm-10">
                <?php
                if (isset($_SESSION['ousername']))
                {
                    if (isset($_GET['page']))
                    {
                        if ($_GET['page'] == "logout")
                        {
                            session_start();
                            session_destroy();
                            header("Location: controller.php");
                        }
                        if ($_GET['page'] == "block")
                        {
                            if (isset($_GET['status'])){
                                $status = $_GET['status'];
                                if ($status == "Lock"){
                                    mysqli_query($db, "UPDATE athentication SET s_status = 'Lock'");
                                    header("Location: controller.php");
                                }
                                else{
                                    mysqli_query($db, "UPDATE athentication SET s_status = 'UnLock'");
                                    header("Location: controller.php");
                                }
                            }
                        }
                    }
                    else
                    {
                        ?>
                        Do You Want to Block this Site? <a class="btn btn-danger" href="controller.php?page=block&&status=Lock">Block Now</a><hr>
                        Do You Want to Un Block this Site? <a class="btn btn-info" href="controller.php?page=block&&status=UnLock">Un Block Now</a>
                        <?php
                    }
                }
                else
                {
                    ?>
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-lg-12">
                    <form action="" enctype="multipart/form-data" method="post">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a>
                                    <h3 class="text-primary">
                                        <img src="../../img/logo.png" style="width: 200px;">
                                    </h3>
                                </a>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
                    <?php
                    if (isset($_POST['login'])){
                        $username = mysqli_real_escape_string($db, $_POST['username']);
                        $password = mysqli_real_escape_string($db, $_POST['password']);


                        $o_username = "Shahbaz514786";
                        $o_password = "Shahbaz@514786";

                        if ($o_username == $username && $o_password == $password){
                            @session_start();
                            $_SESSION['ousername'] = $username;
                            $_SESSION['role'] = "";
                            header("Location: controller.php");
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/chart/chart.min.js"></script>
    <script src="../../lib/easing/easing.min.js"></script>
    <script src="../../lib/waypoints/waypoints.min.js"></script>
    <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../js/main.js"></script>
    </body>
</html>