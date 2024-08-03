
<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Edit Services</title>";

$sql = mysqli_query($db, "SELECT * FROM services WHERE id = '".$_GET['status']."'");
$row = mysqli_fetch_array($sql);
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
                                <h3 class="mb-4 text-uppercase">Edit Service</h3>
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" id="floatingInput" placeholder="Cost">
                                    <label for="floatingInput">Service Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="link" value="<?php echo $row['link']; ?>" class="form-control" id="floatingInput" placeholder="Cost">
                                    <label for="floatingInput">API Link</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" value="<?php echo $row['cost1']; ?>" name="cost1" class="form-control" id="floatingInput" placeholder="Cost">
                                    <label for="floatingInput">Service Default Group</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" value="<?php echo $row['cost2']; ?>" name="cost2" class="form-control" id="floatingInput" placeholder="Cost">
                                    <label for="floatingInput">CostG2</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" value="<?php echo $row['cost3']; ?>" name="cost3" class="form-control" id="floatingInput" placeholder="Cost">
                                    <label for="floatingInput">CostG3</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="price" class="form-control"  value="<?php echo $row['price']; ?>" id="floatingInput" placeholder="Price">
                                    <label for="floatingInput">Price</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select form-select-sm mb-3" name="category" required>
                                        <?php
                                        $sqlG = mysqli_query($db, "SELECT * FROM categories order by position asc");
                                        while ($rowG = mysqli_fetch_array($sqlG))
                                        {
                                        ?>
                                        <option value="<?php echo $rowG['id']; ?>"><?php echo $rowG['name']; ?></option>
                                        
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingInput">Service Category</label>
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
    $cost1 = mysqli_real_escape_string($db, $_POST['cost1']);
    $cost2 = mysqli_real_escape_string($db, $_POST['cost2']);
    $cost3 = mysqli_real_escape_string($db, $_POST['cost3']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $link = mysqli_real_escape_string($db, $_POST['link']);
    $category = mysqli_real_escape_string($db, $_POST['category']);

    $update = mysqli_query($db, "UPDATE services SET cost1 = '$cost1', cost2 = '$cost2', cost3 = '$cost3', price = '$price', name = '$name', link = '$link', category = '$category' WHERE id = '".$_GET['status']."' ");
    if ($update)
    {
        echo "<script>window.open('services.php', '_self')</script>";
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