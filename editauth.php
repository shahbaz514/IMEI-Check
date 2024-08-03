
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

$sql = mysqli_query($db, "SELECT * FROM athentication WHERE id = '1'");
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
    </style>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6" style="border: 2px solid #0dcaf0;">
                            <div class="bg-light rounded h-100 p-4">
                                <h3 class="mb-4 text-uppercase">Edit Stripe</h3>
                                <div class="form-floating mb-3">
                                    <input type="text" value="<?php echo $row['stripe_secret_key']; ?>" name="stripe_secret_key" class="form-control" id="floatingInput" placeholder="Stripe Secret Key">
                                    <label for="floatingInput">Stripe Secret Key</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="stripe_publishable_key" class="form-control"  value="<?php echo $row['stripe_publishable_key']; ?>" id="floatingInput" placeholder="Stripe Publishable Key">
                                    <label for="floatingInput">Stripe Publishable Key</label>
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
    $stripe_secret_key = mysqli_real_escape_string($db, $_POST['stripe_secret_key']);
    $stripe_publishable_key = mysqli_real_escape_string($db, $_POST['stripe_publishable_key']);

    $update = mysqli_query($db, "UPDATE `athentication` SET `stripe_secret_key`='$stripe_secret_key',`stripe_publishable_key`='$stripe_publishable_key' WHERE id = '1'");
    if ($update)
    {
        echo "<script>window.open('accounts.php', '_self')</script>";
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