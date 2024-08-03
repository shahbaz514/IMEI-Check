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
    <div class="container-fluid pt-4 px-4">
<?php
$sqlPro = mysqli_query($db, "SELECT * FROM `accounts` WHERE id = '".$_GET['edit']."'");
$rowPro = mysqli_fetch_array($sqlPro);
    ?>

    <tr>
        <div style="height: 480px" class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <center>
                    <h2>Bank Account Management</h2>
                </center>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" name="bank" class="form-control" id="floatingInput" placeholder="Bank Name" value="<?php echo $rowPro['bank']; ?>" required>
                        <label for="floatingInput">Bank Name:*</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="title" class="form-control" id="floatingInput" placeholder="Account Title" value="<?php echo $rowPro['title']; ?>" required>
                        <label for="floatingInput">Account Title:*</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="ac_num" class="form-control" id="floatingInput" placeholder="Account Number" value="<?php echo $rowPro['ac_num']; ?>" required>
                        <label for="floatingInput">Account Number:*</label>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-secondary" name="addCategory">
                        <i class="fa fa-save"></i> SAVE
                    </button>
                    <a href="javascript:history.go(-1)" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Go Back
                    </a>
                </form>
                <?php
                if (isset($_POST['addCategory']))
                {
                    $bank = mysqli_real_escape_string($db, $_POST['bank']);
                    $title = mysqli_real_escape_string($db, $_POST['title']);
                    $ac_num = mysqli_real_escape_string($db, $_POST['ac_num']);
                    $sqlAdd = mysqli_query($db, "UPDATE `accounts` set `bank` = '$bank', `title` = '$title', `ac_num` = '$ac_num' WHERE id = '".$_GET['edit']."'");
                    if ($sqlAdd)
                    {
                        echo "<script>window.open('accounts.php', '_self')</script>";
                    }
                    else
                    {
                        echo 'Take An Error!';
                    }
                }
                ?>
            </div>
            
        </div>
    </div>


<?php
include "inc/footer.php";
?>