<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
header("Cache-Control: no cache");
include "inc/head.php";
echo "<title>IMEICHECK.UK - Search IMEI</title>";

$sqlUs = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'"));

?>



    <div class="container-fluid pt-4 px-4 overlay">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div class="bg-light rounded col-sm-12 p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div style="display: none; background-color: darkorange!important; color: #FFFFFF!important; border-radius: 10px!important;" id="alertdiv" class="alert alert-warning alert-dismissible fade show" role="alert">
                        <div class="spinner-border text-light" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <h5 style="display: inline-block;" class="text-light">Processing order...</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">


                            <div id="shahbaz514-hidden" class="bg-light rounded h-100 p-4">
                                <h3 class="mb-4 text-uppercase">
                                    <div class="row">
                                        <div style="width: 50%; margin-top: 20px;">
                                            <a href="searchemei.php" class="btn btn-primary" style="width: 100%;">
                                                <i class="fa fa-file"></i> Single
                                            </a>
                                        </div>
                                        <div style="width: 50%; margin-top: 20px;">
                                            <a href="multiple2.php" class="btn btn-secondary" style="width: 100%;">
                                                <i class="fa fa-list"></i> Bulk
                                            </a>
                                        </div>
                                    </div>
                                </h3>


                                <div class="form-floating mb-3">
                                    <input type="text" name="imeino" class="form-control" id="floatingInput" placeholder="Enter IMEI / Serial">
                                    <label for="floatingInput">
                                        <i class="fas fa-mobile-alt" style="color: #0dcaf0"></i>
                                        Enter IMEI / Serial
                                    </label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="services" class="form-select" aria-label="Select a Service!">
                                        <option value="0" selected>
                                            Click to select a service!
                                        </option>
                                        <?php
$cat = mysqli_query($db, "SELECT * FROM categories ORDER BY position ASC");
while($rowCat = mysqli_fetch_array($cat))

{
    ?>
<option style="font-weight:bold;" value="0" disabled>
<?php
echo $rowCat['name'];
?>
</option>
<?php
$sqlServices = mysqli_query($db, "SELECT * FROM services WHERE category = '".$rowCat['id']."' ORDER BY position ASC");
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
                                    </div>
                                    <div class="togglebutton">
                                        <label>
                                            <input type="checkbox" id="duplicates-switch" name="sendemail">
                                            <span class="toggle"></span>
                                            Email
                                        </label>
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

                            </div>

                            <div class="col-sm-3"></div>
                        </div>
                </form>


                <?php

                if (isset($_POST['edit']))
                {
                $orderId = 0;
                $imeino = mysqli_real_escape_string($db, $_POST['imeino']);
                @$sendemail = mysqli_real_escape_string($db, $_POST['sendemail']);
                $services = mysqli_real_escape_string($db, $_POST['services']);
                @$duplicate = mysqli_real_escape_string($db, $_POST['duplicate']);
                $orderIdRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `orders` ORDER BY id DESC"));
                $orderId = $orderIdRow['orderid'] + 1;
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
                }
                if ($sqlUs['wallet'] <= 0 || $sqlUs['wallet'] < $cost)
                {
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
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-sm-12">
                                            <center>
                                                <h2>
                                                    <i style="color: #f0ad4e; padding: 30px; border-radius: 100px; border: 5px solid #f0ad4e;" class='fa fa-warning'></i>
                                                </h2>

                                                <h2 class="card-title">
                                                   Please Recharge your Wallet First!
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
                else {
                $imeino = mysqli_real_escape_string($db, $_POST['imeino']);
                @$sendemail = mysqli_real_escape_string($db, $_POST['sendemail']);
                $services = mysqli_real_escape_string($db, $_POST['services']);
                @$duplicate = mysqli_real_escape_string($db, $_POST['duplicate']);
                $getOrder = mysqli_num_rows(mysqli_query($db, "SELECT * FROM orders WHERE imei = '$imeino' AND username = '".$_SESSION['username']."'"));
                if ($imeino == null){
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
                        <div class="modal-dialog modal-dialog-centered" role="document">
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
                else if ($services == "0") {
                    ?>
                    <script>
                        window.onload = function () {
                            OpenBootstrapPopup();
                        };
                        function OpenBootstrapPopup() {
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
                        <div class="modal-dialog modal-dialog-centered" role="document">
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
                    if ($getOrder>=1)
                    {
                        $orderH = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM orders WHERE imei = '".$imeino."' ORDER BY id DESC"));

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
                        <div class="modal fade" id="Duplicates" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" aria-labelledby="exampleModalCenterTitle">
                            <div class="modal-dialog modal-dialog-centered" role="document">
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
                if ($link == 'https://si')
                {
                    $myResultHTML = curl_exec($ch);
                }
                else
                {
                    $myResult = json_decode(curl_exec($ch));
                }
                $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                if ($httpcode != 200) {
                    echo "Error: HTTP Code $httpcode";
                } else {
                if ($link == 'https://si')
                {
                    $result = mysqli_real_escape_string($db, $myResultHTML);
                }
                else
                {
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

                $insertOrder = mysqli_query($db, "INSERT INTO `orders`(`orderid`, `status`, `service`, `imei`, `result`, `notes`, `credits`, `username`) VALUES ('$orderId', 'Success', '$services', '$imeino', '$result', '', '$cost', '".$_SESSION['username']."')");
                if ($insertOrder) {
                $sqlGetOrder = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM orders WHERE orderid = '$orderId'"));

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
                    if ($mail)
                    {
                        ?>

                        <script>
                            window.onload = function () {
                                OpenBootstrapPopup();
                            };
                            function hideModal() {
                                $("#exampleModal").removeClass("in");
                                $(".modal-backdrop").remove();
                                $('body').removeClass('modal-open');
                                $('body').css('padding-right', '');
                                $("#exampleModal").hide();
                            }
                            function OpenBootstrapPopup() {
                                $('#exampleModal').modal('toggle');
                                $('#exampleModal').modal('show');
                                $('#exampleModal').modal('hide');
                            }
                        </script>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #61b865; color: #FFFFFF!important;">
                                        <h5 style="float: left!important; color: #FFFFFF!important;" class="modal-title text-start">
                                            <i class="fa fa-check"></i>
                                            Order Processed
                                        </h5>
                                    </div>
                                    <div class="modal-body">

                                        <?php

                                        if ($sqlGetOrder['result'] != null)
                                        {
                                            echo "<p class='text-center'>".$sqlGetOrder['result']."</p>";
                                        }
                                        else{
                                            echo "<h4 style='color: red;'>Result Not Found!</h4>";
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
                else
                {
                ?>

                <script>
                    window.onload = function () {
                        OpenBootstrapPopup();
                    };
                    function hideModal() {
                        $("#exampleModal").removeClass("in");
                        $(".modal-backdrop").remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');
                        $("#exampleModal").hide();
                    }
                    function OpenBootstrapPopup() {
                        $('#exampleModal').modal('toggle');
                        $('#exampleModal').modal('show');
                        $('#exampleModal').modal('hide');
                    }
                </script>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #61b865; color: #FFFFFF!important;">
                                <h5 style="float: left!important; color: #FFFFFF!important;" class="modal-title text-start">
                                    <i class="fa fa-check"></i>
                                    Order Processed
                                </h5>
                            </div>
                            <div class="modal-body">
                                <?php

                                if ($sqlGetOrder['result'] != null)
                                {
                                    echo "<p class='text-center'>".$sqlGetOrder['result']."</p c>";
                                }
                                else{
                                    echo "<h4 style='color: red;'>Result Not Found!</h4>";
                                }

                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" onclick="hideModal()" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            }
            }
            }
            }
            }
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