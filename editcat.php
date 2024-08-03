
<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Edit Services Category</title>";

$sql = mysqli_query($db, "SELECT * FROM categories WHERE id = '".$_GET['status']."'");
$user = mysqli_fetch_array($sql);
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
        .form-control
        {
            border-radius: 20px!important;
        }
        .form-control:focus
        {
            border: 1px solid #efc23c!important;
            box-shadow: #efc23c!important;
        }
        .form-control:active
        {
            border: 1px solid #efc23c!important;
            box-shadow: #efc23c!important;
        }
    </style>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6" style="border: 2px solid #efc23c; border-radius: 20px;">
                            <div class="bg-light rounded h-100 p-4">
                                <h3 class="mb-4 text-uppercase">Edit Service Category</h3>
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" id="floatingInput" placeholder="Cost">
                                    <label for="floatingInput">Category Name</label>
                                </div>
                                <button type="submit" name="edit" class="btn btn-secondary">
                                    <i class="fa fa-save"></i> SAVE
                                </button>
                                <a href="javascript:history.go(-1)" class="btn btn-primary">
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
    
    

    $update = mysqli_query($db, "UPDATE categories SET name = '$name' WHERE id = '".$_GET['status']."' ");
    

    if ($update)
    {
        echo "<script>window.open('category.php', '_self')</script>";
    }
    else
    {
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Take An Error! Try Again.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
}
include "inc/footer.php";
?>