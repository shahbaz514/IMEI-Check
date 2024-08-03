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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div style="display: none; background-color: darkorange!important; color: #FFFFFF!important; border-radius: 10px!important;" id="alertdiv" class="alert alert-warning alert-dismissible fade show" role="alert">
                            <div class="spinner-border text-light" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <h5 style="display: inline-block;" class="text-light">Processing order...</h5>
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">

                            <div id="shahbaz514-hidden" class="bg-light rounded h-100 p-4">
                                <h3 class="mb-4 text-uppercase">
                                    <div class="row">
                                        <div style="width: 50%; margin-top: 20px;">
                                            <a href="multiple2.php" class="btn btn-primary" style="width: 100%;">
                                                <i class="fa fa-list"></i> Bulk
                                            </a>
                                        </div>
                                        <div style="width: 50%; margin-top: 20px;">
                                            <a href="searchemei.php" class="btn btn-secondary" style="width: 100%;">
                                                <i class="fa fa-file"></i> Single
                                            </a>
                                        </div>
                                    </div>
                                </h3>
                                <div class="form-floating mb-3">
                                    <textarea style="height: 200px; resize: none;" name="imeino" rows="5" class="form-control" placeholder="Enter IMEI / Serial"></textarea>
                                    <label>
                                        <i class="fas fa-mobile-alt" style="color: #0dcaf0"></i>
                                        Enter IMEI / Serial
                                    </label>
                                </div>
                                <span style="color: red;">
                                    Note: Please separate IMEI's By New Line.
                                </span>
                                <div class="form-floating mb-3" style="margin-top: 20px;">
                                    <select name="services" class="form-select" aria-label="Select a Service!">
                                        <option value="0" selected>
                                            Click to select a service!
                                        </option>
                                        <?php
                                        $sqlServices = mysqli_query($db, "SELECT * FROM services WHERE status = ''");
                                        while ($rowServices = mysqli_fetch_array($sqlServices)) {
                                            $sqlU = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));
                                            $g = $sqlU['group'];
                                            ?>
                                            <option value="<?php echo $rowServices['id'] ?>">
                                                <?php
                                                echo $rowServices['name']. " - $ ";
                                                if ($g == '1')
                                                {
                                                    echo $rowServices['cost1'];
                                                }
                                                if ($g == '2')
                                                {
                                                    echo $rowServices['cost2'];
                                                }
                                                if ($g == '3')
                                                {
                                                    echo $rowServices['cost3'];
                                                }
                                                ?>
                                            </option>
                                            <?php
                                        }

                                        ?>
                                    </select>
                                    <label for="floatingSelect"><i class="fas fa-hand-point-right" style="color: #0dcaf0"></i></label>
                                </div>
                                <div class="form-floating mb-3">
                                    <div class="togglebutton">
                                        <label>
                                            <input type="checkbox" id="duplicates-switch" name="duplicate">
                                            <span class="toggle"></span>
                                            Duplicates
                                        </label>

                                        <div class="togglebutton">
                                            <label>
                                                <input type="checkbox" id="duplicates-switch" name="sendemail" checked>
                                                <span class="toggle"></span>
                                                Email
                                            </label>
                                        </div>
                                    </div>
                                    <button style="float: right" id="checkresult" type="submit" name="edit" class="btn btn-warning">
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="form-floating text-center">
                                    <p><i class="fas fa-play-circle" aria-hidden="true"></i> Select a service to get started.</p>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                </form>

                <script>

                    const targetDiv = document.getElementById("alertdiv");
                    const btn = document.getElementById("checkresult");
                    btn.onclick = function () {
                        if (targetDiv.style.display !== "none") {
                            targetDiv.style.display = "none";
                        } else {
                            targetDiv.style.display = "block";
                        }
                    };
                </script>
                <?php

                if (isset($_POST['edit']))
                {

                    $orderId = 0;
                    $err = 0;
                    $orderIdRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `orders` ORDER BY id DESC"));
                    $orderId = $orderIdRow['orderid'] + 1;
                    $imeino = $_POST['imeino'];
                    $imeino_ar = preg_split('/\n|\r\n?/', $imeino);
                    $orderId = 0;
                    @$sendemail = mysqli_real_escape_string($db, $_POST['sendemail']);
                    $services = mysqli_real_escape_string($db, $_POST['services']);
                    @$duplicate = mysqli_real_escape_string($db, $_POST['duplicate']);
                    $totalcost = 0;
                    foreach ($imeino_ar as $value) {
                        $orderIdRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `orders` ORDER BY id DESC"));
                        $orderId = $orderIdRow['orderid'] + 1;
                        $sqlGetServiceRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM services WHERE id = '$services'"));
                        if ($sqlGetServiceRow) {
                            $sqlGetUser = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'"));
                            $wallet = $sqlGetUser['wallet'];
                            $cost = 0;
                            if ($sqlGetUser['group'] == '1') {
                                $cost = $sqlGetServiceRow['cost1'];
                                $totalcost = $totalcost + $cost;
                            }
                            if ($sqlGetUser['group'] == '2') {
                                $cost = $sqlGetServiceRow['cost2'];
                                $totalcost = $totalcost + $cost;
                            }
                            if ($sqlGetUser['group'] == '3') {
                                $cost = $sqlGetServiceRow['cost3'];
                                $totalcost = $totalcost + $cost;
                            }
                        }
                    }
                    if ($sqlUs['wallet'] <= 0 || $sqlUs['wallet'] < $totalcost) {
                        $err = 1;
                        echo '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>' . $_SESSION["username"] . '</strong> Pleae Recharge your Wallet First!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
                    }
                    else
                    {
                    foreach ($imeino_ar as $value) {
                        if ($imeino == null){
                            $err = 1;
                            ?>
                            <script>
                                window.onload = function () {
                                    OpenBootstrapPopup();
                                };
                                function OpenBootstrapPopup() {
                                    $('#imeino').modal('toggle');
                                    $('#imeino').modal('show');
                                    $('#imeino').modal('hide');
                                }


                                function hideModal() {
                                    $("#imeino").removeClass("in");
                                    $(".modal-backdrop").remove();
                                    $('body').removeClass('modal-open');
                                    $('body').css('padding-right', '');
                                    $("#imeino").hide();
                                }
                            </script>
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

                            <div class="modal fade" id="imeino" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row" style="margin-top: 20px;">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <h2>
                                                            <i style="color: #f0ad4e; padding: 30px; border-radius: 100px; border: 5px solid #f0ad4e;" class='fa fa-warning'></i>
                                                        </h2>

                                                        <h2 class="card-title">
                                                            Enter Your IMEI Number.
                                                        </h2>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" onclick="hideModal()" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        else if ($services == 0) {
                        $err = 1;
                        ?>
                            <script>
                                window.onload = function () {
                                    SelectBootstrapPopup();
                                };
                                function SelectBootstrapPopup() {
                                    $('#selectService').modal('toggle');
                                    $('#selectService').modal('show');
                                    $('#selectService').modal('hide');
                                }


                                function hideModal() {
                                    $("#selectService").removeClass("in");
                                    $(".modal-backdrop").remove();
                                    $('body').removeClass('modal-open');
                                    $('body').css('padding-right', '');
                                    $("#selectService").hide();
                                }
                            </script>
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

                            <div class="modal fade" id="selectService" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row" style="margin-top: 20px;">
                                                <div class="col-sm-12">
                                                    <center>
                                                        <h2>
                                                            <i style="color: #f0ad4e; padding: 30px; border-radius: 100px; border: 5px solid #f0ad4e;" class='fa fa-warning'></i>
                                                        </h2>

                                                        <h2 class="card-title">
                                                            Select a service!
                                                        </h2>
                                                        <p><br> You forgot to choose a service. Please select a service from the dropdown list (indicated by the  icon).
                                                        </p>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" onclick="hideModal()" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        else if ($duplicate == true)
                        {
                            $getOrder = mysqli_num_rows(mysqli_query($db, "SELECT * FROM orders WHERE imei = '$imeino' AND username = '" . $_SESSION['username'] . "'"));
                            if ($getOrder>=1)
                            {
                            $orderH = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM orders WHERE imei = '".$imeino."' ORDER BY id DESC"));
                            $err = 1;
                            ?>
                                <script>
                                    window.onload = function () {
                                        OpenBootstrapPopup();
                                    };
                                    function OpenBootstrapPopup() {
                                        $('#Duplicates').modal('toggle');
                                        $('#Duplicates').modal('show');
                                        $('#Duplicates').modal('hide');
                                    }
                                    function hideModal() {
                                        $("#Duplicates").removeClass("in");
                                        $(".modal-backdrop").remove();
                                        $('body').removeClass('modal-open');
                                        $('body').css('padding-right', '');
                                        $("#Duplicates").hide();
                                    }
                                </script>
                            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                                <!-- Modal -->
                                <div class="modal fade" id="Duplicates" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row" style="margin-top: 20px;">
                                                    <div class="col-sm-12">
                                                        <center>
                                                            <h2>
                                                                <i style="color: #f0ad4e; padding: 30px; border-radius: 100px; border: 5px solid #f0ad4e;" class='fa fa-warning'></i>
                                                            </h2>

                                                            <h2 class="card-title">
                                                                Duplicate Order
                                                            </h2>
                                                            <p><br> You have already processed this order <?php echo $orderH['date']; ?>.</p>
                                                            We can show you the old result (from your order history) or we can process this order again (which will be charged).
                                                        </center>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <br>
                                                                <center>
                                                                    <a class="btn btn-secondary text-center" href="showResult.php?orderId=<?php echo $orderH['orderid']; ?>"><i class="fa fa-eye"></i> Show Old Result</a>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" onclick="hideModal()" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        else {
                            $sqlGETSERVISE = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM services WHERE id = '" . $services . "'"));
                            $myCheck["imei"] = $imeino;
                            $ch = curl_init($sqlGETSERVISE['link'] . $imeino);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
                            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                            $link = substr($sqlGETSERVISE['link'], 0, 10);
                            if ($link == 'https://si') {
                                $myResultHTML = curl_exec($ch);
                            } else {
                                $myResult = json_decode(curl_exec($ch));
                            }
                            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            curl_close($ch);
                            if ($httpcode != 200) {
                                echo "Error: HTTP Code $httpcode";
                            } else {
                                if ($link == 'https://si') {
                                    $result = mysqli_real_escape_string($db, $myResultHTML);
                                } else {
                                    @$result = mysqli_real_escape_string($db, $myResult->response);
                                }
                                $sqlGetServiceRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM services WHERE id = '$services'"));
                                if ($sqlGetServiceRow) {
                                    $sqlGetUser = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'"));
                                    $wallet = $sqlGetUser['wallet'];
                                    $cost = 0;
                                    if ($sqlGetUser['group'] == '1') {
                                        $cost = $sqlGetServiceRow['cost1'];
                                    }
                                    if ($sqlGetUser['group'] == '2') {
                                        $cost = $sqlGetServiceRow['cost2'];
                                    }
                                    if ($sqlGetUser['group'] == '3') {
                                        $cost = $sqlGetServiceRow['cost3'];
                                    }
                                    $wallet = $wallet - $cost;
                                    $updateUserWallet = mysqli_query($db, "UPDATE users SET wallet = '$wallet' WHERE username = '" . $_SESSION['username'] . "'");
                                    $insertOrder = mysqli_query($db, "INSERT INTO `orders`(`orderid`,`status`, `service`, `imei`, `result`, `notes`, `credits`, `username`) VALUES ('$orderId', 'Success', '$services', '$imeino', '$result', '', '$cost', '" . $_SESSION['username'] . "')");
                                    if ($sendemail == true)
                                    {
                                        $msg = $result;
                                        $ema = $sqlGetUser['email'];
                                        $sub = "Result of IMEI FROM IMEICHECK.UK";

                                        $headers = [
                                            'From' => $ema,
                                            'X-Mailer' => 'PHP/' . phpversion(),
                                            'X-Priority' => '1',
                                            'Return-Path' => 'info@imeicheck.uk',
                                            'MIME-Version' => '1.0',
                                            'Content-Type' => 'text/html; charset=iso-8859-1'
                                        ];

                                        if ($msg == null)
                                        {
                                            $msg = "No IMEI Found.";
                                        }
                                        $mail = mail($ema,$sub,$msg, $headers);
                                    }
                                }
                            }
                        }
                    }
                    if ($err == 0){
                    ?>

                        <script>
                            window.onload = function () {
                                OpenBootstrapPopup();
                            };
                            function OpenBootstrapPopup() {
                                $('#exampleModal').modal('toggle');
                                $('#exampleModal').modal('show');
                                $('#exampleModal').modal('hide');
                            }
                            function hideModal() {
                                $("#exampleModal").removeClass("in");
                                $(".modal-backdrop").remove();
                                $('body').removeClass('modal-open');
                                $('body').css('padding-right', '');
                                $("#exampleModal").hide();
                            }
                        </script>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #61b865; color: #FFFFFF!important;">
                                        <h5 style="float: left!important; color: #FFFFFF!important;" class="modal-title text-start">
                                            <i class="fa fa-check"></i>
                                            Order Processed
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $sql = mysqli_query($db, "SELECT * FROM orders WHERE orderid = '$orderId'");
                                        while ($sqlGetOrder = mysqli_fetch_array($sql)) {

                                            if ($sqlGetOrder['result'] != null)
                                            {
                                                echo "<p class='text-center'>".$sqlGetOrder['result']."</p c>";
                                            }
                                            else{
                                                echo "<h4 style='color: red;'>Result Not Found!</h4>";
                                            }
                                            echo '<hr>';
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" onclick="hideModal()" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    }
                ?>
                    <?php
                }
                ?>
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