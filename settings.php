<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Settings</title>";
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
    <div class="container-fluid pt-4 px-4">
        <div style="height: 480px" class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <div class="bg-light rounded h-100 p-4">
                                <h3 class="mb-4 text-uppercase">Settings</h3>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" value="<?php echo $userCredentials['email']; ?>" class="form-control" id="floatingInput" placeholder="name@example.com">
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" value="<?php echo $userCredentials['name']; ?>" class="form-control" id="floatingInput" placeholder="Name">
                                    <label for="floatingInput">Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" name="phone" value="<?php echo $userCredentials['phone']; ?>" class="form-control" id="floatingInput" placeholder="Number">
                                    <label for="floatingInput">Phone Number</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="file" name="img" title="Select Profile Image" class="form-control" accept="image/*">
                                    <label for="floatingInput">Profile Image</label>
                                </div>
                                <button type="submit" name="edit" class="btn btn-warning">
                                    <i class="fa fa-save"></i> SAVE
                                </button>
                                <a href="javascript:history.go(-1)" class="btn btn-danger">
                                                <i class="fa fa-arrow-left"></i> Go Back
                                            </a>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->



<?php
if (isset($_POST['edit']))
{
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $temp = explode(".", $_FILES["img"]["name"]);
    $newfilename = $_SESSION['username'] . '.' . end($temp);
    if (empty($_FILES["img"]["name"]))
    {
        $update = mysqli_query($db, "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE username = '".$_SESSION['username']."' ");
        if ($update)
        {
            echo "<script>window.open('profile.php', '_self')</script>";
        }
    }
    else
    {
        $update = mysqli_query($db, "UPDATE users SET name = '$name', img = '$newfilename', email = '$email', phone = '$phone' WHERE username = '".$_SESSION['username']."' ");
        if ($update)
        {

            $move = move_uploaded_file($_FILES["img"]["tmp_name"], "img/" . $newfilename);
            if ($move)
            {
                echo "<script>window.open('profile.php', '_self')</script>";
            }

        }
    }
}
include "inc/footer.php";
?>