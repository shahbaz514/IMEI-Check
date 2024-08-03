<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Home</title>";
?>

<style>
    .btn{
        line-height: 0.5!important;
    }
   
/*responsive*/
@media(max-width: 1024px){


}
/*responsive*/
@media(max-width: 550px){
	.table thead{
		display: none;
	}

	.table, .table tbody, .table tr, .table td{
		display: block;
		width: 100%;
	}
	.table tr{
		margin-bottom:15px;
	}
	.table td{
		text-align: right;
		padding-left: 50%;
		text-align: right;
		position: relative;
	}
	.table td::before{
		content: attr(data-label);
		position: absolute;
		left:0;
		width: 50%;
		padding-left:15px;
		font-size:15px;
		font-weight: bold;
		text-align: left;
	}
}

</style>
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
<?php
if ($_SESSION['role'] == 'Admin')
{
?>

    <div class="col-sm-6">
        <div class="bg-light rounded d-flex justify-content-between p-4">
            <i class="fa fa-search fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2" style="text-align: right!important;">Total IMEI Check</p>
                <h6 class="mb-0" style="text-align: right!important;">
                    <?php
                    echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM orders"));
                    ?>
                </h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="bg-light rounded d-flex justify-content-between p-4">
            <i class="fa fa-list fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2" style="text-align: right!important;">Total Top Up</p>
                <h6 class="mb-0" style="text-align: right!important;">
                    <?php
                    echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM credits"));
                    ?>
                </h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="bg-light rounded d-flex justify-content-between p-4">
            <i class="fa fa-credit-card fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2" style="text-align: right!important;">Total Amount Credit</p>
                <h6 class="mb-0" style="text-align: right!important;">$
                    <?php
                    $total = 0;
                    $sqlBalance = mysqli_query($db, "SELECT * FROM credits WHERE status = 'Paid'");
                    while ($rowBala = mysqli_fetch_array($sqlBalance))
                    {
                        $total = $total + $rowBala['total_amount'];
                    }
                    echo $total;
                    ?>
                </h6>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="bg-light rounded d-flex justify-content-between p-4">
            <i class="fa fa-users fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2" style="text-align: right!important;">Total Clients</p>
                <h6 class="mb-0" style="text-align: right!important;">
                    <?php
                    echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE role = 'Author'"));
                    ?>
                </h6>
            </div>
        </div>
    </div>
<?php
}
else
{
    ?>
            <div class="col-sm-4">
                <div class="bg-light rounded d-flex justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2" style="text-align: right!important;">IMEI CHECK</p>
                        <h6 class="mb-0" style="text-align: right!important;">

                            <?php
                            if ($_SESSION['role'] == 'Admin')
                            {
                                echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM orders"));
                            }
                            else
                            {
                                echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM orders WHERE username = '".$_SESSION['username']."'"));
                            }
                            ?>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="bg-light rounded d-flex justify-content-between p-4">
                    <i class="fa fa-credit-card fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2" style="text-align: right!important;">Credits</p>
                        <h6 class="mb-0" style="text-align: right!important;">$ <?php echo $userCredentials['wallet']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="bg-light rounded d-flex justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2" style="text-align: right!important;">FraudEye Status</p>
                        <h6 class="mb-0" style="text-align: right!important;">

                            <?php
                            if ($userCredentials['fraud'] == "")
                            {
                                echo "Clear";
                            }
                            else
                            {
                                echo "Un Clear";
                            }
                            ?>
                        </h6>
                    </div>
                </div>
            </div>
    <?php
}
    ?>
        </div>
    </div>
    <!-- Sale & Revenue End -->


    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div style="padding-top: 20px; padding-left: 2px;" class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="row">
                        <div class="col-sm-6">
                            <?php
                            if ($_SESSION['role'] == 'Admin')
                            {
                                ?>
                                    <div class="row bg-light rounded align-items-center justify-content-center">
                                        <div style="padding-left: 0px; padding-right: 5px;" class="bg-light text-center rounded col-sm-12">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6>Top Users</h6>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Status</th>
                                                        <th>Amount</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $sql = mysqli_query($db, "SELECT * FROM users ORDER BY wallet DESC LIMIT 0,5");

                                                    while ($row = mysqli_fetch_array($sql))
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td data-label="Username"><?php echo substr($row['username'], 0, 15); ?></td>
                                                            <td data-label="Status"><?php echo substr($row['status'], 0, 15); ?></td>
                                                            <td data-label="Amount">$<?php echo $row['wallet']; ?></td>
                                                            <td data-label="Edit"><a class="btn btn-secondary" href="editUser.php?id=<?php echo $row['id']; ?>">
                                        <i class="fa fa-eye"></i>
                                    </a></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                            else
                            {
                            ?>
                            <div class="align-items-center justify-content-between col-sm-12">
                            <center>
                                <h3>
                                    <i class="fa fa-search"></i>
                                </h3>
                                <br>
                                <h5>Check IMEI</h5>
                                <p>The new IMEI Check is here!</p>
                                <a class="btn btn-warning" href="searchemei.php" style="line-height: 1.5!important;border-radius: 30px; margin-top: 10px;">Check IMEI</a>
                            </center>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="row bg-light rounded align-items-center justify-content-center">
                                <div style="padding-left: 5px; padding-right: 0px;" class="bg-light text-center rounded col-sm-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6>Latest Results</h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Service</th>
                                        <th>IMEI</th>
                                        <th>Result</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($_SESSION['role'] == 'Admin')
                                    {
                                        $sql = mysqli_query($db, "SELECT * FROM orders ORDER BY id DESC LIMIT 0,5");
                                    }
                                    else
                                    {
                                        $sql = mysqli_query($db, "SELECT * FROM orders WHERE username = '".$_SESSION['username']."' ORDER BY id DESC LIMIT 0,5");
                                    }
                                    while ($row = mysqli_fetch_array($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td data-label="Status">
                                                <?php
                                                if ($row['status'] == 'Success')
                                                {
                                                    echo '<a class="link-success">Success</a>';
                                                }
                                                else
                                                {
                                                    echo '<a class="link-danger">Failed</a>';
                                                }
                                                ?>
                                            </td>
                                            <td data-label="Service">
                                                <?php
                                                echo $row['service'];
                                                ?>
                                            </td>
                                            <td data-label="IMEI"><?php echo $row['imei']; ?></td>
                                            <td data-label="Result">
                                                <a type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id']; ?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Result</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                if ($row['result'] != null)
                                                                {
                                                                    echo $row['result'];
                                                                }
                                                                else
                                                                {
                                                                    echo "<h3 style='color: red;'>Result Not Found!</h3>";
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                    </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div style="padding-left: 0px; padding-right: 0px;" class="bg-light text-center rounded col-sm-12 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Recent Top Up</h6>
                    <a href="allTopUp.php" class="link-secondary">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Item</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($_SESSION['role'] == 'Admin')
                        {
                            $sql = mysqli_query($db, "SELECT * FROM credits ORDER BY id DESC  LIMIT 0,10");
                        }
                        else
                        {
                            $sql = mysqli_query($db, "SELECT * FROM credits WHERE username = '".$_SESSION['username']."' ORDER BY id DESC  LIMIT 0,10");
                        }
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr>
                                <td data-label="Invoice No.">INV-<?php echo $row['invoice_no']; ?></td>
                                <td data-label="Customer"><?php echo $row['username']; ?></td>
                                <td data-label="Amount">$<?php echo $row['total_amount']; ?></td>
                                <td data-label="Payment Mode"><?php echo $row['payment_method']; ?></td>
                                <td data-label="Status">
                                    <?php
                                    if ($row['status'] == 'Paid')
                                    {
                                        echo '<a class="link-success">Paid</a>';
                                    }
                                    else if ($row['status'] == 'Rejected')
                                    {
                                        echo '<a class="link-danger">Rejected</a>';
                                    }
                                    else if ($row['status'] == 'Cancel')
                                    {
                                        echo '<a class="link-warning">Failed</a>';
                                    }
                                    else
                                    {
                                        echo '<a class="link-info">UnPaid</a>';
                                    }
                                    ?>
                                </td>
                                <td data-label="Item"><?php echo $row['item']; ?></td>
                                <td data-label="Date"><?php echo $row['date']; ?></td>
                                <td data-label="Action">
                                    <a class="btn btn-secondary" href="invoiceDetails.php?invoice=<?php echo $row['invoice_no']; ?>">
                                        <i class="fa fa-eye"></i>
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