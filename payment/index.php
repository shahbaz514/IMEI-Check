<?php
@ob_start();
@session_start();
include "dbConfig.php";
include "inc/head.php";
if (!isset($_SESSION['username']))
{
    header("location:login.php");
}if (!isset($_GET['orderid']))
{
    header("location: ../addFunds.php");
}

$sql = "SELECT * FROM credits WHERE invoice_no = '".$_GET['orderid']."'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
}
$sqlc = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
$resultc = $db->query($sqlc);

if ($resultc->num_rows > 0) {
  // output data of each row
  $rowc = $resultc->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>NyXie Payment</title>
	<!-- Stripe JavaScript library -->
    <script src="https://js.stripe.com/v2/"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <!-- jQuery is used only for this example; it isn't required to use Stripe -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>
	<h1 style="text-align: center;">Give Payment of $<?php echo $row['total_amount']; ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                
                <!-- display errors returned by createToken -->
                <span class="payment-errors"></span>
                <!-- stripe payment form -->
                <form action="submit.php" method="POST" id="paymentFrm">
                    <p>
                        <input type="hidden" class="form-control" value="<?php echo $rowc['name'] ?>" name="name" size="50" />
                        <input type="hidden" class="form-control" value="<?php echo $rowc['email'] ?>" name="email" size="50" />
                    </p>
                    <p>
                        <label>Card Number</label>
                        <input type="text"  value="<?php echo $_GET['cardnumber'] ?>" name="card_num" size="20" autocomplete="off"
                class="card-number form-control" />
                    </p>
                    <p>
                        <label>CVC</label>
                        <input type="text" name="cvc" value="<?php echo $_GET['cvc'] ?>" size="4" autocomplete="off" class="card-cvc form-control" />
                    </p>
                    <p>
                        <label>Expiration (MM/YYYY)</label>
                        <div class="row">
                            <div class="col-xs-5">
                                <input type="text" name="exp_month" size="2" value="<?php echo $_GET['experyMonth'] ?>" class="card-expiry-month form-control"/>
                            </div>
                            <div class="col-xs-2">
                                <span> / </span>
                            </div>
                            <div class="col-xs-5">
                                <input type="text" name="exp_year" size="4" value="<?php echo $_GET['experyYear'] ?>" class="card-expiry-year form-control"/>
                            </div>
                        </div>
                        
                    </p>
                    <p>
                        <input type="hidden" class="form-control" value="<?php echo $row['total_amount'] ?>" name="total" />
                        <input type="hidden" class="form-control" value="<?php echo $_GET['orderid'] ?>" name="orderid" />
                    </p>
                    <center>
                        <button type="submit" id="payBtn" class="btn btn-danger">Submit Payment</button>
                    </center>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
<script type="text/javascript">
//set your publishable key
Stripe.setPublishableKey('pk_test_RCflAU9Cvn4JGZjh35ak1w2100FrTTGEdm');

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        //enable the submit button
        $('#payBtn').removeAttr("disabled");
        //display the errors on the form
        $(".payment-errors").html(response.error.message);
    } else {
        var form$ = $("#paymentFrm");
        //get token id
        var token = response['id'];
        //insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" 
+ token + "' />");
        //submit form to the server
        form$.get(0).submit();
    }
}
$(document).ready(function() {
    //on form submit
    $("#paymentFrm").submit(function(event) {
        //disable the submit button to prevent repeated clicks
        $('#payBtn').attr("disabled", "disabled");
        
        //create single-use token to charge the user
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
        //submit from callback
        return false;
    });
});
</script>

<?php

include "inc/footer.php";