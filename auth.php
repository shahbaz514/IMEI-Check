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

include "inc/head.php";
echo "<title>IMEICHECK.UK - All Users</title>";
?>

    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light text-center rounded col-sm-12 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Authentication</h6>

                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <tbody>
                        <?php
                        $sql = mysqli_query($db, "SELECT * FROM athentication WHERE id = '1'");
                        $row = mysqli_fetch_array($sql);
                            ?>
                            <tr>
                                <th>Stripe Secret Key</th>
                                <td><?php echo $row['stripe_secret_key']; ?></td>
                            </tr>
                            <tr>
                                <th>Stripe Publishable Key</th>
                                <td><?php echo $row['stripe_publishable_key']; ?></td>
                            </tr>
                            <tr>
                                <th>Paypal Client ID</th>
                                <td><?php echo $row['paypal_CLIENT_ID']; ?></td>
                            </tr>
                            <tr>
                                <th>Paypal Client Secret</th>
                                <td><?php echo $row['paypal_CLIENT_SECRET']; ?></td>
                            </tr>
                            <tr>
                                <th>USDT Payment Address</th>
                                <td><?php echo $row['usdt_address']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <center style="margin-top: 20px;">
                    <a href="editauth.php" class="btn btn-secondary">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </center>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->


<?php
include "inc/footer.php";
?>