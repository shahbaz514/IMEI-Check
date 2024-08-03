<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Edit Group</title>";
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
                        <div class="col-sm-6" style="border: 2px solid #efc23c; border-radius: 20px;">
                            <div class="bg-light rounded h-100 p-4">
                                <h3 class="mb-4 text-uppercase">Edit Group</h3>
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Name">
                                    <label for="floatingInput">Name</label>
                                </div>
                                <button type="submit" name="edit" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> SAVE
                                </button>
                                <a href="javascript:history.go(-1)" class="btn btn-info">
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

    $update = mysqli_query($db, "UPDATE `groups` SET `name`='$name' WHERE id = '".$_GET['id']."' ");
    if ($update)
    {
        echo "<script>window.open('groups.php', '_self')</script>";
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