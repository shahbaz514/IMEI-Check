<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}

if ($_SESSION['role'] == 'Author')
{
    echo "<script>window.open('index.php','_self')</script>";
}

if (isset($_GET['del']))
{
    $sqlProDel = mysqli_query($db, "DELETE FROM `accounts` WHERE id = '".$_GET['del']."'");
    if ($sqlProDel)
    {
        echo "<script>window.open('accounts.php','_self')</script>";
    }
    else
    {
        echo "<script>alert('Take An Erro! Try Again.')</script>";
        echo "<script>window.open('accounts.php','_self')</script>";
    }
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Bank Account Management</title>";
?>


    <style>
        h3 .fa-search{
            padding: 60px;
            border-radius: 50%;
            border: 2px solid #0dcaf0;
            color: #0dcaf0;
        }
        h3 .fa-copy{
            padding: 60px;
            border-radius: 50%;
            border: 2px solid #0dcaf0;
            color: #0dcaf0;
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


    <!-- Sign Up Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <center>
                    <h2>Add Admin</h2>
                </center>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingText" placeholder="jhondoe" required>
                            <label for="floatingText">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control" id="floatingText" placeholder="jhondoe" required>
                            <label for="floatingText">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <button type="submit" name="signup" class="btn btn-primary py-3 w-100 mb-4">Add User</button>
                        <a href="javascript:history.go(-1)" class="btn btn-danger">
                                    <i class="fa fa-arrow-left"></i> Go Back
                                </a>
                    </div>
                </form>

                <?php
                if (isset($_POST['signup']))
                {
                    $email = mysqli_real_escape_string($db, $_POST['email']);
                    $name = mysqli_real_escape_string($db, $_POST['name']);
                    $username = mysqli_real_escape_string($db, $_POST['username']);
                    $password = mysqli_real_escape_string($db, $_POST['password']);
                    $sqlCheck = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
                    $count = mysqli_num_rows($sqlCheck);
                    if ($count>0)
                    {
                        ?>
                        <strong>Hello! <?php echo $_POST['username']; ?> </strong> This Username Already Exist. Use Another One.
                        <?php
                    }
                    else
                    {
                        $sqlInsert = mysqli_query($db, "INSERT INTO `users`(`name`, `email`, `username`, `password`, `role`, `status`) VALUES ('$name', '$email', '$username', '$password', 'Admin', 'Active')");
                        if ($sqlInsert)
                        {
                            echo "<script>window.open('users.php', '_self')</script>";
                        }
                    }
                }
                ?>

            </div>
        </div>
    </div>

    <div class="clearfix"></div>

<?php

include "inc/footer.php";