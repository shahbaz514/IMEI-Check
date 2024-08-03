<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
if ($_GET['invoice'] == "" AND $_GET['approve'] == "")
{
    header('Location: index.php');
}
$getOrder = mysqli_query($db, "SELECT * FROM credits WHERE invoice_no = '".$_GET['invoice']."'");
$orderRow = mysqli_fetch_array($getOrder);
$getUser = mysqli_query($db, "SELECT * FROM users WHERE username = '".$orderRow['username']."'");
$userRow = mysqli_fetch_array($getUser);
if (isset($_GET['approve'])) {
    $inv_no = $_GET['approve'];
    if ($_SESSION['role']) {
        $sqlUpdate = mysqli_query($db, "UPDATE `credits` SET `status` = 'Paid' WHERE invoice_no = '".$inv_no."'");
        if ($sqlUpdate) {
            $wallet = $orderRow['total_amount'] + $userRow['wallet'];
            $sqlUpdateUser = mysqli_query($db, "UPDATE users SET wallet = '$wallet' WHERE username = '".$userRow['username']."'");

            if ($sqlUpdateUser) {
                echo "<script>window.open('invoiceDetails.php?invoice=".$_GET['invoice']."','_self')</script>";
            }
        }
    }
}
if (isset($_GET['Cancel'])) {
    $inv_no = $_GET['Cancel'];
    if ($_SESSION['role']) {
        $sqlUpdate = mysqli_query($db, "UPDATE `credits` SET `status` = 'Rejected' WHERE invoice_no = '".$inv_no."'");
        if ($sqlUpdate) {
            echo "<script>window.open('invoiceDetails.php?invoice=".$_GET['invoice']."','_self')</script>";

        }
    }
}

echo "<title>IMEICHECK.UK - INV - ".$_GET["invoice"]."</title>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#1397f2">
    <meta name="msapplication-TileColor" content="#4694f8">
    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <script src="https://kit.fontawesome.com/928e926eb6.js" crossorigin="anonymous" type="d870110e28d687ab4c5200b2-text/javascript"></script>

    <link href="https://ifreeicloud.co.uk/client-area/assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <link href="https://ifreeicloud.co.uk/client-area/assets/css/flag-icon.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">


</head>
<div id="print">
    <div class="container">
        <div class="card">
            <div id="invoice-template" class="card-body">
                <div id="invoice-company-details" class="row">
                    <div class="col-md-6 col-sm-12 text-right text-md-left">
                        <div class="media">
                            <script pagespeed_no_defer="">//<![CDATA[
                                (function(){var g=this,h=function(b,d){var a=b.split("."),c=g;a[0]in c||!c.execScript||c.execScript("var "+a[0]);for(var e;a.length&&(e=a.shift());)a.length||void 0===d?c[e]?c=c[e]:c=c[e]={}:c[e]=d};var l=function(b){var d=b.length;if(0<d){for(var a=Array(d),c=0;c<d;c++)a[c]=b[c];return a}return[]};var m=function(b){var d=window;if(d.addEventListener)d.addEventListener("load",b,!1);else if(d.attachEvent)d.attachEvent("onload",b);else{var a=d.onload;d.onload=function(){b.call(this);a&&a.call(this)}}};var n,p=function(b,d,a,c,e){this.f=b;this.h=d;this.i=a;this.c=e;this.e={height:window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight,width:window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth};this.g=c;this.b={};this.a=[];this.d={}},q=function(b,d){var a,c,e=d.getAttribute("pagespeed_url_hash");if(a=e&&!(e in b.d))if(0>=d.offsetWidth&&0>=d.offsetHeight)a=!1;else{c=d.getBoundingClientRect();var f=document.body;a=c.top+("pageYOffset"in window?window.pageYOffset:(document.documentElement||f.parentNode||f).scrollTop);c=c.left+("pageXOffset"in window?window.pageXOffset:(document.documentElement||f.parentNode||f).scrollLeft);f=a.toString()+","+c;b.b.hasOwnProperty(f)?a=!1:(b.b[f]=!0,a=a<=b.e.height&&c<=b.e.width)}a&&(b.a.push(e),b.d[e]=!0)};p.prototype.checkImageForCriticality=function(b){b.getBoundingClientRect&&q(this,b)};h("pagespeed.CriticalImages.checkImageForCriticality",function(b){n.checkImageForCriticality(b)});h("pagespeed.CriticalImages.checkCriticalImages",function(){r(n)});var r=function(b){b.b={};for(var d=["IMG","INPUT"],a=[],c=0;c<d.length;++c)a=a.concat(l(document.getElementsByTagName(d[c])));if(0!=a.length&&a[0].getBoundingClientRect){for(c=0;d=a[c];++c)q(b,d);a="oh="+b.i;b.c&&(a+="&n="+b.c);if(d=0!=b.a.length)for(a+="&ci="+encodeURIComponent(b.a[0]),c=1;c<b.a.length;++c){var e=","+encodeURIComponent(b.a[c]);131072>=a.length+e.length&&(a+=e)}b.g&&(e="&rd="+encodeURIComponent(JSON.stringify(s())),131072>=a.length+e.length&&(a+=e),d=!0);t=a;if(d){c=b.f;b=b.h;var f;if(window.XMLHttpRequest)f=new XMLHttpRequest;else if(window.ActiveXObject)try{f=new ActiveXObject("Msxml2.XMLHTTP")}catch(k){try{f=new ActiveXObject("Microsoft.XMLHTTP")}catch(u){}}f&&(f.open("POST",c+(-1==c.indexOf("?")?"?":"&")+"url="+encodeURIComponent(b)),f.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),f.send(a))}}},s=function(){var b={},d=document.getElementsByTagName("IMG");if(0==d.length)return{};var a=d[0];if(!("naturalWidth"in a&&"naturalHeight"in a))return{};for(var c=0;a=d[c];++c){var e=a.getAttribute("pagespeed_url_hash");e&&(!(e in b)&&0<a.width&&0<a.height&&0<a.naturalWidth&&0<a.naturalHeight||e in b&&a.width>=b[e].k&&a.height>=b[e].j)&&(b[e]={rw:a.width,rh:a.height,ow:a.naturalWidth,oh:a.naturalHeight})}return b},t="";h("pagespeed.CriticalImages.getBeaconData",function(){return t});h("pagespeed.CriticalImages.Run",function(b,d,a,c,e,f){var k=new p(b,d,a,e,f);n=k;c&&m(function(){window.setTimeout(function(){r(k)},0)})});})();pagespeed.CriticalImages.Run('/mod_pagespeed_beacon','https://ifreeicloud.co.uk/client-area/ajax/showInvoice.php?id=949','YddRYU7ik1',true,false,'FSor0RpVVLk');
                                //]]></script>
                            <a href="index.php">
                                <img src="img/logoinv.png" class="mr-3" height="120px" pagespeed_url_hash="3756217883" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                            </a>
                            <div class="media-body">
                                <ul class="ml-2 px-0 list-unstyled">
                                    <h5>
                                        <li><strong>IMEICHECK.UK</strong></li>
                                        <li>Main Blauvard</li>
                                        <li>Lahore, Punjab</li>
                                        <li>Pakistan</li>
                                    </h5>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <style>

                        .btn-success{
                            color: #0c4128;
                            color: #FFFFFF!important;
                            padding: 10px;
                            width: 120px;
                        }

                        .btn-warning{
                            background-color: #ffc107;
                            color: #FFFFFF!important;
                            padding: 10px;
                            width: 120px;
                        }
                    </style>
                    <div class="col-md-6 col-sm-12 text-center text-md-right">
                        <h2>INVOICE</h2>
                        <h5 class="pb-1"># IMEI-<?php echo $_GET['invoice']; ?></h5>
                        <span class="card text-white ml-auto mt-0 mb-2" style="width:10rem">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <strong>
                                        <?php
                                        if ($orderRow['status'] == 'Paid')
                                        {
                                            echo '<a class="btn btn-success">Paid</a>';
                                        }
                                        else if ($orderRow['status'] == 'Cancel')
                                        {
                                            echo '<a class="btn btn-warning" style="color: #FFFFFF;">Failed</a>';
                                        }
                                        else if ($orderRow['status'] == 'Rejected')
                                        {
                                            echo '<a class="btn btn-danger" style="color: #FFFFFF;">Rejected</a>';
                                        }
                                        else
                                        {
                                            echo '<a class="btn btn-info">UnPaid</a>';
                                        }
                                        ?>
                                    </strong>
                                </h5>
                                <h5 class="card-title">
                                    <strong>$ <?php echo $orderRow['total_amount'] ?></strong>
                                </h5>
                            </div>
                        </span>
                    </div>
                </div>


                <div id="invoice-customer-details" class="row pt-2">
                    <div class="col-sm-12 text-center text-md-left">
                        <h5 class="text-muted">Bill To</h5>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center text-md-left">
                        <ul class="px-0 list-unstyled">
                            <h5>
                                <strong><?php echo ucfirst($userRow['username']); ?></strong>
                                <br>ATTN: <?php echo @$userRow['name']; ?>
                            </h5>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center text-md-right">
                        <h5><span class="text-muted">Invoice Date:</span> <?php echo $orderRow['inv_date']; ?></h5>
                        <h5><span class="text-muted">Due Date:</span> <?php echo $orderRow['due_date']; ?></h5>
                        
                    </div>
                </div>


                <div id="invoice-items-details" class="pt-2">
                    <div class="row pb-3">
                        <div class="table-responsive col-sm-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item &amp; Description</th>
                                    <th class="text-right">Cost</th>
                                    <th class="text-right">Qty</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <p><?php echo $orderRow['item']; ?></p>
                                    </td>
                                    <td class="text-right">$ <?php echo $orderRow['total_amount']; ?></td>
                                    <td class="text-right"><?php echo $orderRow['qty']; ?></td>
                                    <td class="text-right">$ <?php echo $orderRow['total_amount']; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-sm-12 text-center text-md-left">
                            <p class="lead">Transactions:</p>
                            <div class="row">
                                <div class="col-md-10">
                                    <table class="table table-borderless table-sm">
                                        <thead>
                                        <tr>
                                            <td><strong>Gateway</strong></td>
                                            <td><strong>Amount</strong></td>
                                            <td><strong>Date</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?php echo $orderRow['payment_method']; ?></td>
                                            <td>$<?php echo $orderRow['total_amount']; ?></td>
                                            <td><?php echo $orderRow['date']; ?></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <p class="lead">Total due</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text-bold-800">Total</td>
                                        <td class="text-bold-800 text-right">$ <?php echo $orderRow['total_amount']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Payment Made</td>
                                        <td class="pink text-right">(-) $ <?php echo $orderRow['total_amount']; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if ($orderRow['payment_method'] == "Direct Transfer")
                {
                ?>


                <div id="invoice-items-details" class="pt-2">
                    <div class="row pb-3">
                        <div class="table-responsive col-sm-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Bank Name</th>
                                    <th>Account Title</th>
                                    <th>Account Number</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sqlAccounts = mysqli_query($db, "SELECT * FROM `accounts`");
                                while ($rowAccounts = mysqli_fetch_array($sqlAccounts))
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $rowAccounts['bank']; ?></td>
                                        <td><?php echo $rowAccounts['title']; ?></td>
                                        <td><?php echo $rowAccounts['ac_num']; ?></td>
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
                else if ($orderRow['payment_method'] == "USDT")
                {
                ?>
                <hr><br><br><br>
                <center >
                <div id="invoice-items-details" >
                    <div class="row pb-3">
                        
                        <div >
                            <h5>Deposit USDT to Binance</h5>
                            <h6 class="text-primary">
                    <img src="img/usdtscan.jpg" style="width: 70%;">
                </h6>
                <div class="col-sm-6">
                    <h5>Pay ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 127965350</h5>
                </div>
                
                

                          
                        </div>
                    </div>
                </div></center>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div id="invoice-template" class="card-body">
        <center>
            <a href="javascript:history.go(-1)" class="btn btn-success">
                <i class="fa fa-arrow-left"></i> Go Back
            </a>
            <a href="index.php" class="btn btn-warning">
                <i class="fa fa-home"></i> Go Home
            </a>
            <button onclick="printPage('print')" class="btn btn-info">
                <i class="fa fa-print"></i> Print
            </button>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <!-- Button trigger modal -->

            <?php
            if ($orderRow['payment_method'] == "Direct Transfer" OR $orderRow['payment_method'] == "USDT")
            {
            ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                View/Upload Payment Proof
            </button>
            <?php
            }
            ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View / Upload Payment Proof</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <?php
                            if ($orderRow['payment_method'] == "Direct Transfer"OR $orderRow['payment_method'] == "USDT")
                            {
                                ?>


                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <center>
                                                <h2>Upload Proof</h2>
                                            </center>
                                            <input type="file" name="prof" title="Payment Prof" class="form-control" accept="image/*" required>
                                            <center>
                                                <input type="submit" name="upload" value="Upload" class="btn btn-danger">
                                            </center>
                                        </div>
                                        <div class="col-sm-12">
                                            <center>
                                                <h2>Payment Proof</h2>
                                            </center>
                                            <?php
                                            if ($orderRow['prof'] != "")
                                            {
                                                ?>
                                                <a href="img/<?php echo $orderRow['prof']; ?>" target="_blank">
                                                    <img src="img/<?php echo $orderRow['prof']; ?>" style="width: 100%;">
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                if (isset($_POST['upload']))
                                {
                                    $temp = explode(".", $_FILES["prof"]["name"]);
                                    $newfilename = $_GET['invoice'] . '.' . end($temp);
                                    $sqlU = mysqli_query($db, "UPDATE credits SET prof = '$newfilename' WHERE invoice_no = '".$_GET['invoice']."'");
                                    if ($sqlU)
                                    {
                                        $move = move_uploaded_file($_FILES["prof"]["tmp_name"], "img/" . $newfilename);
                                        if ($move)
                                        {
                                            echo "<script>window.open('invoiceDetails.php?invoice=".$_GET['invoice']."', '_self')</script>";
                                        }

                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($_SESSION['role'] == 'Admin' && $orderRow['status'] != 'Paid' && ($orderRow['payment_method'] == 'Direct Transfer' || $orderRow['payment_method'] == 'USDT'))
            {
                ?>
                <a href="invoiceDetails.php?approve=<?php echo $_GET['invoice']; ?>&&invoice=<?php echo $_GET['invoice']; ?>" class="btn btn-success">
                    <i class="fa fa-check"></i> Approve
                </a>
                <a href="invoiceDetails.php?Cancel=<?php echo $_GET['invoice']; ?>&&invoice=<?php echo $_GET['invoice']; ?>" class="btn btn-danger">
                    <i class="fa fa-cut"></i> Rejected
                </a>
                <?php
            }
            ?>
        </center>
        <script>

            function printPage(id)
            {
                var html="<html>";


                html+='<link href="https://ifreeicloud.co.uk/client-area/assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />';
                html+='<link href="https://ifreeicloud.co.uk/client-area/assets/css/flag-icon.min.css" rel="stylesheet" />';
                html+='<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">';
                html+= document.getElementById(id).innerHTML;

                html+="</html>";

                var printWin = window.open('','','left=0,top=0,width=1,height=1,toolbar=0,scrollbars=0,status  =0');
                printWin.document.write(html);
                printWin.print();
            }
        </script>

    </div>
</div>
</div>

<script src="https://js.stripe.com/v3/" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/core/jquery.min.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>
<script src="https://ifreeicloud.co.uk/client-area/assets/js/core/popper.min.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>
<script src="https://ifreeicloud.co.uk/client-area/assets/js/core/bootstrap-material-design.min.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>
<script src="https://ifreeicloud.co.uk/client-area/assets/js/plugins/perfect-scrollbar.jquery.min.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/plugins/moment.min.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/plugins/sweetalert2.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/plugins/jquery.validate.min.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/plugins/bootstrap-selectpicker.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/plugins/bootstrap-datetimepicker.min.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/plugins/jquery.dataTables.min.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/plugins/arrive.min.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/plugins/bootstrap-notify.js" type="d870110e28d687ab4c5200b2-text/javascript"></script>

<script src="https://ifreeicloud.co.uk/client-area/assets/js/material-dashboard.js?v=2.1.0" type="d870110e28d687ab4c5200b2-text/javascript"></script>
<script type="d870110e28d687ab4c5200b2-text/javascript">$(document).ready(function(){$().ready(function(){$sidebar=$('.sidebar');$sidebar_img_container=$sidebar.find('.sidebar-background');$full_page=$('.full-page');$sidebar_responsive=$('body > .navbar-collapse');window_width=$(window).width();fixed_plugin_open=$('.sidebar .sidebar-wrapper .nav li.active a p').html();if(window_width>767&&fixed_plugin_open=='Dashboard'){if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){$('.fixed-plugin .dropdown').addClass('open');}}
$('.fixed-plugin a').click(function(event){if($(this).hasClass('switch-trigger')){if(event.stopPropagation){event.stopPropagation();}else if(window.event){window.event.cancelBubble=true;}}});$('.fixed-plugin .active-color span').click(function(){$full_page_background=$('.full-page-background');$(this).siblings().removeClass('active');$(this).addClass('active');var new_color=$(this).data('color');if($sidebar.length!=0){$sidebar.attr('data-color',new_color);}
if($full_page.length!=0){$full_page.attr('filter-color',new_color);}
if($sidebar_responsive.length!=0){$sidebar_responsive.attr('data-color',new_color);}});$('.fixed-plugin .background-color .badge').click(function(){$(this).siblings().removeClass('active');$(this).addClass('active');var new_color=$(this).data('background-color');if($sidebar.length!=0){$sidebar.attr('data-background-color',new_color);}});$('.fixed-plugin .img-holder').click(function(){$full_page_background=$('.full-page-background');$(this).parent('li').siblings().removeClass('active');$(this).parent('li').addClass('active');var new_image=$(this).find("img").attr('src');if($sidebar_img_container.length!=0&&$('.switch-sidebar-image input:checked').length!=0){$sidebar_img_container.fadeOut('fast',function(){$sidebar_img_container.css('background-image','url("'+new_image+'")');$sidebar_img_container.fadeIn('fast');});}
if($full_page_background.length!=0&&$('.switch-sidebar-image input:checked').length!=0){var new_image_full_page=$('.fixed-plugin li.active .img-holder').find('img').data('src');$full_page_background.fadeOut('fast',function(){$full_page_background.css('background-image','url("'+new_image_full_page+'")');$full_page_background.fadeIn('fast');});}
if($('.switch-sidebar-image input:checked').length==0){var new_image=$('.fixed-plugin li.active .img-holder').find("img").attr('src');var new_image_full_page=$('.fixed-plugin li.active .img-holder').find('img').data('src');$sidebar_img_container.css('background-image','url("'+new_image+'")');$full_page_background.css('background-image','url("'+new_image_full_page+'")');}
if($sidebar_responsive.length!=0){$sidebar_responsive.css('background-image','url("'+new_image+'")');}});$('.switch-sidebar-image input').change(function(){$full_page_background=$('.full-page-background');$input=$(this);if($input.is(':checked')){if($sidebar_img_container.length!=0){$sidebar_img_container.fadeIn('fast');$sidebar.attr('data-image','#');}
if($full_page_background.length!=0){$full_page_background.fadeIn('fast');$full_page.attr('data-image','#');}
background_image=true;}else{if($sidebar_img_container.length!=0){$sidebar.removeAttr('data-image');$sidebar_img_container.fadeOut('fast');}
if($full_page_background.length!=0){$full_page.removeAttr('data-image','#');$full_page_background.fadeOut('fast');}
background_image=false;}});$('.switch-sidebar-mini input').change(function(){$body=$('body');$input=$(this);if(md.misc.sidebar_mini_active==true){$('body').removeClass('sidebar-mini');md.misc.sidebar_mini_active=false;$('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();}else{$('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');setTimeout(function(){$('body').addClass('sidebar-mini');md.misc.sidebar_mini_active=true;},300);}
var simulateWindowResize=setInterval(function(){window.dispatchEvent(new Event('resize'));},180);setTimeout(function(){clearInterval(simulateWindowResize);},1000);});});});</script>
<script type="d870110e28d687ab4c5200b2-text/javascript">$(document).ready(function(){$('body').on('click','.show-invoice',function(){$("#invoiceModalContent").load("/client-area/ajax/showInvoice.php?id="+$(this).attr("data-invoice"),function(){$('#invoiceModal').modal('show');});});$('#datatables').DataTable({"processing":true,"serverSide":true,"ajax":"/client-area/ajax/invoices.php","responsive":true,"order":[[0,"desc"]],"columns":[{"name":"id","data":"id","filter":"search","title":"ID","searchable":true,"orderable":true},{"name":"amount","data":"amount","title":"Amount","searchable":true,"orderable":false,"render":function(data,type,row){if(data==0)
return"Nil";else
return"$"+data+(row.is_gift?' <i class="fa fa-gift text-warning"></i>':'');}},{"name":"status","data":"status","id":"datatable-status","filter":"daterange","title":"Status","searchable":true,"orderable":false,"render":function(data,type,row){switch(data){case'Paid':return'<span class="badge badge-pill badge-success">Paid <i class="fa fa-check-circle"></i></span>';break;case'Unpaid':return'<span class="badge badge-pill badge-danger">Unpaid</span>';break;case'Pending':return'<span class="badge badge-pill badge-default">Pending <i class="fa fa-spinner fa-spin"></i></span>';break;case'Outstanding':return'<span class="badge badge-pill badge-danger">Outstanding <i class="fa fa-exclamation-circle"></i></span>';break;case'Authorized':return'<span class="badge badge-pill badge-info">Authorized</span>';break;default:return'<span class="badge badge-pill badge-default">'+data+'</span>';}}},{"name":"created","data":"created","filter":"daterange","title":"Created","searchable":true,"orderable":false},{"name":"item","data":"item","title":"Order","searchable":true,"orderable":true},{"name":"actions","data":"actions","title":"Actions","searchable":false,"orderable":false}],language:{search:"_INPUT_",searchPlaceholder:"Search invoices",emptyTable:"No Available Invoices"}});var table=$('#datatable').DataTable();table.on('click','.edit',function(){$tr=$(this).closest('tr');var data=table.row($tr).data();alert('You press on Row: '+data[0]+' '+data[1]+' '+data[2]+'\'s row.');});table.on('click','.remove',function(e){$tr=$(this).closest('tr');table.row($tr).remove().draw();e.preventDefault();});table.on('click','.like',function(){alert('You clicked on Like button');});$('body').tooltip({selector:'[rel=tooltip]'});});</script>
<script src="/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="d870110e28d687ab4c5200b2-|49" defer=""></script><script>(function(){var js = "window['__CF$cv$params']={r:'7546a1f0f8244cc5',m:'zJSV3gfBMwnRT6Rlqi_d_X89SxwfJ5npZkR.Orr1dnU-1664810121-0-Ac5yQZP2/dcKbqT3bGOoA1uVzeR+OhYYwspWxtPEwZyESTIlFlDhEfq2kGYPe7O6dc2XNj7ll3leOu1DHCiqMg2QmtSgAiigAhw7NyucB68j3SGxqn8JenFieYdmGR2cgo5uiy1j/ryEqTNrL5yyLkg=',s:[0x1725cd7d2e,0x889adfe553],u:'/cdn-cgi/challenge-platform/h/b'};var now=Date.now()/1000,offset=14400,ts=''+(Math.floor(now)-Math.floor(now%offset)),_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='/cdn-cgi/challenge-platform/h/b/scripts/alpha/invisible.js?ts='+ts,document.getElementsByTagName('head')[0].appendChild(_cpo);";var _0xh = document.createElement('iframe');_0xh.height = 1;_0xh.width = 1;_0xh.style.position = 'absolute';_0xh.style.top = 0;_0xh.style.left = 0;_0xh.style.border = 'none';_0xh.style.visibility = 'hidden';document.body.appendChild(_0xh);function handler() {var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;if (_0xi) {var _0xj = _0xi.createElement('script');_0xj.nonce = '';_0xj.innerHTML = js;_0xi.getElementsByTagName('head')[0].appendChild(_0xj);}}if (document.readyState !== 'loading') {handler();} else if (window.addEventListener) {document.addEventListener('DOMContentLoaded', handler);} else {var prev = document.onreadystatechange || function () {};document.onreadystatechange = function (e) {prev(e);if (document.readyState !== 'loading') {document.onreadystatechange = prev;handler();}};}})();</script></body>
</html>