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

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
                order: [[0, 'desc']],
            });
        });
    </script>
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

    <?php
    $sql = mysqli_query($db, "SELECT * FROM athentication WHERE id = '1'");
    $row = mysqli_fetch_array($sql);
    ?>


    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <center>
                    <h2>Bank Account Management</h2>
                </center>
                <div class="table-responsive">
                    <table class="table table-striped text-start table-bordered" style="width:100%">
                        <?php
                        if (isset($_GET['type']))
                        {
                            echo "<thead>
                        <tr>
                            <th></th>
                            <th>Bank Name</th>
                            <th>Account Title</th>
                            <th>Account Number</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>";

                            $sqlPro = mysqli_query($db, "SELECT * FROM `accounts` ORDER BY id ASC");
                            while ($rowPro = mysqli_fetch_array($sqlPro))
                            {
                                ?>
                                <tr>
                                    <td><img src="img/bank.png" style="width: 60px;"></td>
                                    <td><?php echo $rowPro['bank']; ?></td>
                                    <td><?php echo $rowPro['title']; ?></td>
                                    <td><?php echo $rowPro['ac_num']; ?></td>
                                    <td>
                                        <center>
                                            <a class="btn btn-primary" href="editaccounts.php?edit=<?php echo $rowPro['id']; ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a class="btn btn-secondary" href="accounts.php?del=<?php echo $rowPro['id']; ?>">
                                                <i class="fa fa-cut"></i>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                        ?>
                        <thead>
                        <tr>
                            <th></th>
                            <th>METHOD</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td><img src="img/bank.png" style="width: 60px;"></td>
                            <td>Bank Accounts</td>
                            <td>
                                <a href="accounts.php?type=bank" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/card-icon.png" style="width: 60px;"></td>
                            <td>Stripe</td>
                            <td>
                                <a href="editauth.php" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/paypal-icon.png" style="width: 60px;"></td>
                            <td>Paypal</td>
                            <td>
                                <a href="editauthPaypal.php" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="https://ifreeicloud.co.uk/client-area/assets/img/usdt-icon.png" style="width: 60px;"></td>
                            <td>USDT</td>
                            <td>
                                <a href="editauthUSDT.php" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <center>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-plus"></i> ADD
                    </button>
                    <a href="javascript:history.go(-1)" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i> Go Back
                                </a>
                </center>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="bank" class="form-control" id="floatingInput" placeholder="Bank Name" required>
                                        <label for="floatingInput">Bank Name:*</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="title" class="form-control" id="floatingInput" placeholder="Account Title" required>
                                        <label for="floatingInput">Account Title:*</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="ac_num" class="form-control" id="floatingInput" placeholder="Account Number" required>
                                        <label for="floatingInput">Account Number:*</label>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-secondary" name="addCategory">
                                        <i class="fa fa-save"></i> SAVE
                                    </button>
                                </form>
                                <?php
                                if (isset($_POST['addCategory']))
                                {
                                    $bank = mysqli_real_escape_string($db, $_POST['bank']);
                                    $title = mysqli_real_escape_string($db, $_POST['title']);
                                    $ac_num = mysqli_real_escape_string($db, $_POST['ac_num']);
                                    $sqlAdd = mysqli_query($db, "INSERT INTO `accounts`(`bank`, `title`, `ac_num`) VALUES ('$bank', '$title', '$ac_num')");
                                    if ($sqlAdd)
                                    {
                                        echo "<script>window.open('accounts.php', '_self')</script>";
                                    }
                                    else
                                    {
                                        echo '
                                    <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              Take An Error!
                                            </div>
`                                       </div>
                                        <div class="col-sm-4"></div>
                                    </div>
                                    ';
                                    }
                                }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->


<?php
include "inc/footer.php";
?>