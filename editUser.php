<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Change Setting</title>";
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
                        <div class="col-sm-6" >
                            
                            <div class="bg-light rounded h-100 p-4">
                                <h3 class="mb-4 text-uppercase">Change Setting</h3>
                                <?php
                                $us = mysqli_query($db, "SELECT * FROM users WHERE id = '".$_GET['id']."' ");
                                $us_row = mysqli_fetch_array($us);
                                ?>
                                <p class="mb-4 text-uppercase">Name: <u><b><?php echo $us_row['name']; ?></b></u></p>
                                <p class="mb-4 text-uppercase">User Name: <u><b><?php echo $us_row['username']; ?></b></u></p>
                                
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="floatingInput" placeholder="Password">
                                    <label for="floatingInput">Password</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <select class="form-select form-select-sm mb-3" name="group" required>
                                        <?php
                                        $sqlG = mysqli_query($db, "SELECT * FROM groups");
                                        while ($rowG = mysqli_fetch_array($sqlG))
                                        {
                                        ?>
                                        <option value="<?php echo $rowG['id']; ?>"><?php echo $rowG['name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-floating mb-4">
                                    <select class="form-select form-select-sm mb-3" name="role" required>
                                        <option>Admin</option>
                                        <option value="Author" selected>Client</option>
                                    </select>
                                </div>
                                <button type="submit" name="edit" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> SAVE
                                </button>

                                <a href="javascript:history.go(-1)" class="btn btn-danger">
                                    <i class="fa fa-arrow-left"></i> Go Back
                                </a>
                                
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </form>
                <br><br>
                                <p style="Color:red;">If you update only one setting, other setting will not affected. It will remain same as already saved.</p>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->



<?php
if (isset($_POST['edit']))
{
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $group = mysqli_real_escape_string($db, $_POST['group']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

    $update = mysqli_query($db, "UPDATE `users` SET `password`='$password',`role`='$role',`group`='$group' WHERE id = '".$_GET['id']."' ");
    if ($update)
    {
        if ($role == 'Admin')
        {
            echo "<script>window.open('users.php', '_self')</script>";
        }
        else
        {
            echo "<script>window.open('clients.php', '_self')</script>";
        }
    }
    else
    {
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hello! <?php echo $_SESSION['username']; ?> </strong> Take An Error! Try Again.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}
include "inc/footer.php";
?>