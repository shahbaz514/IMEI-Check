<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="../index.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">
                    <img src="img/logo.png" style="width: 100%;">
                </h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <?php
                    $userCredentials = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
                    if ($userCredentials['img'] == "")
                    {
                        echo '<img class="rounded-circle" src="img/user.jpg" style="width: 40px; height: 40px;">';
                    }
                    else
                    {
                        echo '<img class="rounded-circle" src="img/'.$userCredentials['img'].'" style="width: 40px; height: 40px;">';
                    }
                    ?>

                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0"><?php echo ucfirst($_SESSION['username']); ?></h6>
                    <span><?php echo ucfirst($_SESSION['role']); ?></span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <?php
                $activePage = basename($_SERVER['PHP_SELF'], ".php");
                ?>
                <a href="../index.php" class="nav-item nav-link <?= ($activePage == 'index') ? 'active':''; ?>"><i class="fa fa-tachometer-alt me-2"></i> Dashboard</a>
                <a href="../addFunds.php" class="nav-item nav-link <?= ($activePage == 'addFunds') ? 'active':''; ?>"><i class="fa fa-money-check"></i> Add Funds </a>
                <a href="../searchemei.php" class="nav-item nav-link <?= ($activePage == 'searchemei') ? 'active':''; ?>"><i class="fa fa-search"></i> IMEI Check</a>
                <a href="../orderHistory.php" class="nav-item nav-link <?= ($activePage == 'orderHistory') ? 'active':''; ?>"><i class="fa fa-history"></i> Result History</a>
                <a href="../allTopUp.php" class="nav-item nav-link <?= ($activePage == 'allTopUp') ? 'active':''; ?>"><i class="fa fa-credit-card me-2"></i> Payments</a>
                <?php
                if($_SESSION['role'] == 'Admin')
                {
                    ?>
                    <a href="../accounts.php" class="nav-item nav-link <?= ($activePage == 'accounts') ? 'active':''; ?>"><i class="fa fa-list me-2"></i> Bank Accounts</a>
                    <a href="../services.php" class="nav-item nav-link <?= ($activePage == 'services') ? 'active':''; ?>"><i class="fa fa-users me-2"></i> Services</a>
                    <a href="../users.php" class="nav-item nav-link <?= ($activePage == 'users') ? 'active':''; ?>"><i class="fa fa-users me-2"></i> Users</a>
                    <?php
                }
                ?>


                <!--<div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="signin.php" class="dropdown-item">Sign In</a>
                        <a href="signup.php" class="dropdown-item">Sign Up</a>
                        <a href="404.html" class="dropdown-item">404 Error</a>
                        <a href="blank.html" class="dropdown-item">Blank Page</a>
                    </div>
                </div>-->
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="../index.php" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0">
                    <img src="img/logo.png" style="width: 100%;">
                </h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <?php
                        if ($userCredentials['img'] == "")
                        {
                            echo '<img class="rounded-circle" src="img/user.jpg" style="width: 40px; height: 40px;">';
                        }
                        else
                        {
                            echo '<img class="rounded-circle" src="img/'.$userCredentials['img'].'" style="width: 40px; height: 40px;">';
                        }
                        ?>
                        <span class="d-none d-lg-inline-flex">
                            <?php echo ucfirst($_SESSION['username']); ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="../profile.php" class="dropdown-item <?= ($activePage == 'profile') ? 'active':''; ?>">My Profile</a>
                        <a href="../settings.php" class="dropdown-item <?= ($activePage == 'settings') ? 'active':''; ?>">Settings</a>
                        <a href="../changePassword.php" class="dropdown-item <?= ($activePage == 'changePassword') ? 'active':''; ?>">Change Password</a>
                        <a href="../logout.php" class="dropdown-item <?= ($activePage == 'logout') ? 'active':''; ?>">Log Out</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->



        <style>
            h3 .fa-search{
                padding: 60px;
                border-radius: 50%;
                border: 2px solid #0dcaf0;
                color: #0dcaf0;
                margin-top: 10px;
            }
            h3 .fa-copy{
                padding: 60px;
                border-radius: 50%;
                border: 2px solid #0dcaf0;
                color: #0dcaf0;
                margin-top: 10px;
            }
            .fa-eye{
                padding: 20px;
                border-radius: 50%;
                color: #FFFFFF;
            }
            .btn-info{
                background-color: #0dcaf0;
                color: white;
                padding: 10px;
                width: 120px;
            }
            .btn-warning{
                background-color: #ffc107;
                color: black;
                padding: 10px;
                width: 120px;
            }
            .btn-info:hover{
                color: white;
                padding: 10px;
                width: 120px;
            }
            .btn-success{
                color: #0c4128;
                color: #FFFFFF;
                padding: 10px;
                width: 120px;
            }
            .btn-danger{
                color: red;
                color: #FFFFFF;
                padding: 10px;
                width: 120px;
            }

            .btn-warning{
                background-color: #efc23c;
                color: white;
                padding: 10px;
                width: 120px;
            }
            .btn-warning:hover{
                background-color: #efc23c;
                color: white;
                padding: 10px;
                width: 120px;
            }
        </style>
