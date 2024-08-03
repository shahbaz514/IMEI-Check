<?php
include "db/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IMEICHECK.UK - SignUp</title>
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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a>
                                    <img src="img/logo.png" style="width: 180px;">
                                </a>
                                <h5>Sign Up</h5>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="floatingText" placeholder="jhondoe">
                                <label for="floatingText">Username</label>
                            </div>
                                                        <div class="form-floating mb-4">
                                <input type="text" name="phone" class="form-control" id="floatingPassword" placeholder="Phone Number">
                                <label for="floatingText">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" REQUIRED>
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="forgot-password.php">Forgot Password</a>
                            </div>
                            <button type="submit" name="signup" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                            <p class="text-center mb-0">Already have an Account? <a href="signin.php">Sign In</a></p>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['signup']))
                    {
                        $email = mysqli_real_escape_string($db, $_POST['email']);
                        $username = mysqli_real_escape_string($db, $_POST['username']);
                        $password = mysqli_real_escape_string($db, $_POST['password']);
                        $phone = mysqli_real_escape_string($db, $_POST['phone']);

                        $sqlCheck = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
                        $sqlCheckEmail = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");
                        $count = mysqli_num_rows($sqlCheck);
                        $countEmail = mysqli_num_rows($sqlCheckEmail);
                        if ($count>0)
                        {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Hello! <?php echo $_POST['username']; ?> </strong> This Username Already Exist. Use Another One.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        }
                        else if ($countEmail>0)
                        {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Hello! <?php echo $_POST['username']; ?> </strong> This Email Already Exist. Use Another One.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        }
                        else
                        {

                            $sqlInsert = mysqli_query($db, "INSERT INTO `users`(`email`, `username`, `password`, `phone`, `role`, `group`, `status`) VALUES ('$email', '$username', '$password', '$phone', 'Author', '1', 'Active')");
                            if ($sqlInsert)
                            {
                                echo "<script>window.alert('You are successfully registered, Please Login!')</script>";
                                echo "<script>window.open('signin.php', '_self')</script>";
                            }
                            else
                            {
                                ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Hello! <?php echo $_POST['username']; ?> </strong> Take An Error! Try Again.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>