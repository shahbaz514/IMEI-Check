<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Order History</title>";

if (!isset($_GET['orderId']))
{
    header("Location: orderHistory.php");
}

?>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Current Results</h6>
                    <a href="javascript:history.go(-1)" class="btn btn-warning">
                                    <i class="fa fa-arrow-left"></i> Go Back
                                </a>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped text-start table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Service</th>
                            <th>IMEI</th>
                            <th>Submitted</th>
                            <th>Credits</th>
                            <th>Result</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = mysqli_query($db, "SELECT * FROM orders WHERE username = '".$_SESSION['username']."' AND orderid = '".$_GET['orderId']."'");
                        while ($row = mysqli_fetch_array($sql))
                        {
                            ?>
                            <tr>
                                <td>
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
                                <td>
                                    <?php
                                    $sqlServiceRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM services WHERE id = '".$row['service']."'"));
                                    echo $sqlServiceRow['name'];
                                    ?>
                                </td>
                                <td><?php echo $row['imei']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['credits']; ?></td>
                                <td>
                                    <?php
                                    if ($row['result'] == null)
                                    {
                                        echo "<span style='color: red;'>Result Not Found</span>";
                                    }
                                    echo $row['result']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <?php
                        if (isset($_GET['email']))
                        {
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>An Email is Sent Please Check it.</strong> Thanks for Choosing our service!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->



<?php
include "inc/footer.php";
?>