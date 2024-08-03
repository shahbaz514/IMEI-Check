<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
include "inc/head.php";
echo "<title>IMEICHECK.UK - Add Top Ups</title>";

?>
    <style>
        h3 .fa-search{
            padding: 60px;
            border-radius: 50%;
            border: 2px solid orange!important;
            color: orange!important;
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
        .clickable {
    cursor: pointer;
}
/*responsive*/
@media(max-width: 800px){

	.col-sm-6 {
    flex: 0 0 auto;
    width: 100%;
}
}

@media(max-width: 734px){
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
		padding-left: 0%;
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
	
	.clickable {
    cursor: pointer;
}
    </style>
  
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-light rounded align-items-center justify-content-center mx-0">
            <div style="padding-left: 0px; padding-right: 0px; padding-top:20px;" class="bg-light text-center rounded col-sm-12">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">All Payment Methods</h6>
                </div>
                <div class="table-responsive" id="pay">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                        <tr>
                            <th></th>
                            <th>METHOD</th>
                            <th>PAY</th>
                            <th>FEE</th>
                            <th>MINIMUM</th>
                            <th>MAXIMUM</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><img src="img/paypal-icon.png" style="width: 60px;"></td>
                            <td data-label="Method">Paypal</td>
                            
                            <td data-label="Fee">4%</td>
                            <td data-label="Minimum">$2.00</td>
                            <td data-label="Maximum">$300.00</td>
                            <td data-label="Pay">
                                <button href="#"  type="button" class="btn btn-success clickable" id="show">
                                    $ Top Up
                                </button>
                                </td>
                             <td id="box" style="display:none">
                                    <p style="text-align:center; font-weight:bold;">Please fill details below</p>

                                                <form action="paypal/charge.php" method="post">
                                                    <input type="text" name="amount" value="20.00" class="form-control" />
                                                    <center style="margin-top: 10px;">
                                                    <input type="submit" name="submit" value="Pay Now" class="btn btn-info" >
                                                    <button type="button" class="btn btn-secondary" id="hide" style="margin-top: 10px;">Close</button>
                                                    </center>
                                                </form>
                                </td>
                        </tr>
                        <tr>
                            <td><img src="img/card-icon.png" style="width: 60px;"></td>
                            <td data-label="Method">Cards</td>
                            
                            <td data-label="Fee">4%</td>
                            <td data-label="Minimum">$5.00</td>
                            <td data-label="Maximum">$300.00</td>
                            <td data-label="Pay">
                                <button href="#" type="button" class="btn btn-success" id="cshow" >
                                    $ Top Up
                                </button>
                            </td>
                            <td id="card" style="display:none">
                                    <p style="text-align:center; font-weight:bold;">Please fill details below</p>

                                                <form action="" enctype="multipart/form-data" method="post">
                                                    <input type="number" name="amountStripe" placeholder="Enter Amount" min="2" max="1000" class="form-control" required>
                                                    <input style="margin-top: 10px;" type="number" name="cardNumber" placeholder="Card Number" class="form-control" required>
                                                    <input style="margin-top: 10px;" type="number" name="expiryMonth" placeholder="Expiry Month" class="form-control" required>
                                                    <input style="margin-top: 10px;" type="number" name="expiryYear" placeholder="Expiry Year" class="form-control" required>
                                                    <input style="margin-top: 10px;" type="number" name="cvc" placeholder="CVC" class="form-control" required>
                                                    <center style="margin-top: 10px;">
                                                        <input type="submit" name="placeOrderStripe" value="Place Order" class="btn btn-info">
                                                        <button type="button" class="btn btn-secondary" id="chide">Close</button>
                                                    </center>
                                                </form>

                                </td>
                        </tr>
                        <tr>

                            <td><img src="https://ifreeicloud.co.uk/client-area/assets/img/usdt-icon.png" style="width: 60px;"></td>
                            <td data-label="Method">USDT</td>
                            
                            <td data-label="Fee">0%</td>
                            <td data-label="Minimum">$10</td>
                            <td data-label="Maximum">$1000.00</td>
                            <td data-label="Pay">
                                <button type="button" class="btn btn-success" id="ushow">
                                    $ Top Up
                                </button>
                            </td>
                            <td id="usdt" style="display:none">
                                    
<p style="text-align:center; font-weight:bold;">Please fill details below</p>
                                                 <form action="" enctype="multipart/form-data" method="post">
                                                    <input type="number" name="amountUSDT" placeholder="Enter Amount" min="10" max="1000" class="form-control" required>

                                                    <center style="margin-top: 10px;">
                                                        <input type="submit" name="placeOrderUSDT" value="Place Order" class="btn btn-info">
                                                        <button type="button" class="btn btn-secondary" id="uhide" style="margin-top: 10px;">Close</button>
                                                    </center>
                                                </form>
                                </td>
                        </tr> 
                        <tr>
                            <td><img src="img/bank.png" style="width: 60px;"></td>
                            <td data-label="Mehtod">Direct Transfer</td>
                            
                            <td data-label="Fee">0%</td>
                            <td data-label="Minimum">$2</td>
                            <td data-label="Maximum">$1000.00</td>
                            <td data-label="Pay">
                                <button type="button" class="btn btn-success" id="dshow">
                                    $ Top Up
                                </button>
                            </td>
                            <td id="bank" style="display:none">
                                    
                                                   <p style="text-align:center; font-weight:bold;">Please fill details below</p>
                                                 <form action="" enctype="multipart/form-data" method="post">
                                                    <input type="number" name="amountBankTransfer" placeholder="Enter Amount" min="2" max="1000" class="form-control" required>
                                                    <center style="margin-top: 10px;">
                                                        <input type="submit" name="placeOrderBankTransfer" value="Place Order" class="btn btn-info">
                                                        <button type="button" class="btn btn-secondary" id="dhide" style="margin-top: 10px;">Close</button>
                                                    </center>
                                                </form>

                                </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

<script>
$(document).ready(function(){
  $("#hide").click(function(){
      $('#box').hide();
   });
   $("#show").click(function(){
       $('#box').show();
   });
});
$(document).ready(function(){
  $("#chide").click(function(){
      $('#card').hide();
   });
   $("#cshow").click(function(){
       $('#card').show();
   });
});
$(document).ready(function(){
  $("#uhide").click(function(){
      $('#usdt').hide();
   });
   $("#ushow").click(function(){
       $('#usdt').show();
   });
});
$(document).ready(function(){
  $("#dhide").click(function(){
      $('#bank').hide();
   });
   $("#dshow").click(function(){
       $('#bank').show();
   });
});

</script>

<?php

if (isset($_POST['placeOrderUSDT']))
{
    $amountUSDT = mysqli_real_escape_string($db, $_POST['amountUSDT']);
    $inv_date = date("j F Y");
    $due_date = date("j F Y");
    $suply_date = date("j F Y");
    $paymentMethod = "USDT";
    $item = "IMEI Check Credits";
    $qty = 1;
    $rowlast = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM credits ORDER BY id DESC LIMIT 1"));
    $invoice = $rowlast['invoice_no'] + 1;

    $sqlInsert = mysqli_query($db, "INSERT INTO `credits`(`username`, `invoice_no`, `item`, `qty`, `total_amount`, `inv_date`, `due_date`, `suply_date`, `payment_method`, `status`) 
                                                VALUES ('".$_SESSION['username']."', '$invoice', '$item','$qty','$amountUSDT', '$inv_date', '$due_date', '$suply_date', '$paymentMethod', 'Unpaid')");
    if($sqlInsert)
    {
        header('Location: invoiceDetails.php?invoice='.$invoice.'');
    }
}



if (isset($_POST['placeOrderBankTransfer']))
{
    $amountBankTransfer = mysqli_real_escape_string($db, $_POST['amountBankTransfer']);
    $inv_date = date("j F Y");
    $due_date = date("j F Y");
    $suply_date = date("j F Y");
    $paymentMethod = "Direct Transfer";
    $item = "IMEI Check Credits";
    $qty = 1;
    $rowlast = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM credits ORDER BY id DESC LIMIT 1"));
    $invoice = $rowlast['invoice_no'] + 1;

    $sqlInsert = mysqli_query($db, "INSERT INTO `credits`(`username`, `invoice_no`, `item`, `qty`, `total_amount`, `inv_date`, `due_date`, `suply_date`, `payment_method`, `status`) 
                                                VALUES ('".$_SESSION['username']."', '$invoice', '$item','$qty','$amountBankTransfer', '$inv_date', '$due_date', '$suply_date', '$paymentMethod', 'Unpaid')");
    if($sqlInsert)
    {
        header('Location: invoiceDetails.php?invoice='.$invoice.'');
    }
}
?>

<?php

if (isset($_POST['placeOrderStripe']))
{
    $amountStripe = mysqli_real_escape_string($db, $_POST['amountStripe']);
    $cardNumber = mysqli_real_escape_string($db, $_POST['cardNumber']);
    $expiryMonth = mysqli_real_escape_string($db, $_POST['expiryMonth']);
    $expiryYear = mysqli_real_escape_string($db, $_POST['expiryYear']);
    $cvc = mysqli_real_escape_string($db, $_POST['cvc']);
    $inv_date = date("j F Y");
    $due_date = date("j F Y");
    $suply_date = date("j F Y");
    $paymentMethod = "Stripe";
    $item = "IMEI Check Credits";
    $qty = 1;
    $rowlast = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM credits ORDER BY id DESC LIMIT 1"));
    $invoice = $rowlast['invoice_no'] + 1;

    $sqlInsert = mysqli_query($db, "INSERT INTO `credits`(`username`, `invoice_no`, `item`, `qty`, `total_amount`, `inv_date`, `due_date`, `suply_date`, `payment_method`, `status`) 
                                                VALUES ('".$_SESSION['username']."', '$invoice', '$item','$qty','$amountStripe', '$inv_date', '$due_date', '$suply_date', '$paymentMethod', 'Unpaid')");
    if($sqlInsert)
    {
        header('Location: payment/index.php?orderid='.$invoice.'&&cardnumber='.$cardNumber.'&&experyMonth='.$expiryMonth.'&&experyYear='.$expiryYear.'&&cvc='.$cvc.'');
    }
}
?>
<script src="https://www.blockonomics.co/js/pay_button.js"></script>

<?php
include "inc/footer.php";
?>

