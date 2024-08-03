<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
if ($_SESSION['role'] != 'Admin')
{
    header('Location: index.php');
}

if (isset($_GET['status']))
{
    if ($_SESSION['role'] == 'Admin')
    {
        $sqlStatus = mysqli_query($db, "SELECT * FROM users WHERE id = '".$_GET['status']."'");
        $rowStatus = mysqli_fetch_array($sqlStatus);

        if ($rowStatus['status'] == 'Active')
        {
            if (mysqli_query($db, "UPDATE users SET status = 'Block' WHERE id = '".$_GET['status']."'"))
            {
                header("Location: clients.php");
            }
        }
        else
        {

            if (mysqli_query($db, "UPDATE users SET status = 'Active' WHERE id = '".$_GET['status']."'"))
            {
                header("Location: clients.php");
            }
        }
    }
    else
    {
        echo "<script>alert('You are not Authorized Person! Please Contact to Admin.')</script>";
        echo "<script>window.open('clients.php', '_self')</script>";
    }
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - All Clients</title>";
?>

<script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable({
        order: [[0, 'desc']],
    });
});
</script>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">All Clients</h6>
                    <a href="addUser.php" class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>username</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Wallet</th>
                            <th>Group</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = mysqli_query($db, "SELECT * FROM users WHERE role = 'Author' ORDER BY id DESC");
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php if ($row['role'] == 'Author'){
                                    echo 'Client';
                                    }?></td>
                                <td>
                                    <?php
                                    if ($row['status'] == 'Active')
                                    {
                                        ?>
                                        <a class="btn btn-secondary" href="clients.php?status=<?php echo $row['id']; ?>">
                                            <?php echo $row['status'] ; ?>
                                        </a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="btn btn-secondary" href="clients.php?status=<?php echo $row['id']; ?>">
                                            <?php echo $row['status'] ; ?>
                                        </a>
                                        <?php
                                    }
                                    ?>

                                </td>
                                <td>$<?php echo $row['wallet']; ?></td>
                                <td>
                                    <?php
                                    $rowG = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `groups` WHERE id = '".$row['group']."'"));
                                    ?>
                                    <a class="btn btn-secondary" href="editUser.php?id=<?php echo $row['id']; ?>">
                                        <?php echo $rowG['name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id']; ?>">
                                        Top Up
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Direct Bank Transfer</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="" enctype="multipart/form-data" method="post">
                                                        <input type="number" name="amountBankTransfer<?php echo $row['id']; ?>" placeholder="Enter Amount" min="2" max="1000" class="form-control" required>
                                                        <center style="margin-top: 10px;">
                                                            <input type="submit" name="placeOrderBankTransfer<?php echo $row['id']; ?>" value="Place Order" class="btn btn-info">
                                                        </center>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                    if (isset($_POST['placeOrderBankTransfer'.$row['id']]))
                                    {
                                        $amountBankTransfer = mysqli_real_escape_string($db, $_POST['amountBankTransfer'.$row['id']]);
                                        $inv_date = date("j F Y");
                                        $due_date = date("j F Y");
                                        $suply_date = date("j F Y");
                                        $paymentMethod = "Direct Transfer";
                                        $item = "IMEI Check Credits";
                                        $qty = 1;
                                        $rowlast = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM credits ORDER BY id DESC LIMIT 1"));
                                        $invoice = $rowlast['invoice_no'] + 1;

                                        $sqlInsert = mysqli_query($db, "INSERT INTO `credits`(`username`, `invoice_no`, `item`, `qty`, `total_amount`, `inv_date`, `due_date`, `suply_date`, `payment_method`, `status`) 
                                                VALUES ('".$row['username']."', '$invoice', '$item','$qty','$amountBankTransfer', '$inv_date', '$due_date', '$suply_date', '$paymentMethod', 'Paid')");
                                        if($sqlInsert)
                                        {
                                            $total = $row['wallet'] + $amountBankTransfer;
                                            $upWallet = mysqli_query($db, "UPDATE users SET wallet = '$total' WHERE username = '".$row['username']."'");
                                            if ($upWallet)
                                            {
                                                header('Location: clients.php');
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-secondary" href="editUser.php?id=<?php echo $row['id']; ?>">
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
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->


<?php
include "inc/footer.php";
?>