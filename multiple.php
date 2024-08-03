<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Search IMEI</title>";

$sqlUs = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));

?>


    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light rounded col-sm-12 p-4">
                <form action="multiple2.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6" style="border: 2px solid #0dcaf0;">
                            <div class="bg-light rounded h-100 p-4">
                                <h3 class="mb-4 text-uppercase">
                                    Search IMEI
                                    <a href="searchemei.php" style="float: right" class="btn btn-secondary">
                                        <i class="fa fa-file"></i> Single
                                    </a>
                                </h3>


                                <div class="form-floating mb-3">
                                    <input type="number" name="numberofimei" required class="form-control" id="floatingInput" placeholder="Enter IMEI / Serial">
                                    <label for="floatingInput">
                                        <i class="fas fa-mobile-alt" style="color: #0dcaf0"></i>
                                        Enter Number of IMEI's Want to Check
                                    </label>
                                </div>
                                <div class="form-floating mb-3">
                                    <button style="float: right" type="submit" name="s" class="btn btn-warning">
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                </form>

                <center>
                    <a href="searchemei.php" class="btn btn-info " style="margin-top: 20px;">
                        <i class="fa fa-home"></i>
                    </a>
                </center>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->




<?php
include "inc/footer.php";
?>