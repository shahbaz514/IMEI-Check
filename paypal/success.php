<?php
ob_start();
session_start();
require_once 'config.php';

// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $response = $transaction->send();

    if ($response->isSuccessful()) {
        // The customer has successfully paid.
        $arr_body = $response->getData();

        $payment_id = $arr_body['id'];
        $payer_id = $arr_body['payer']['payer_info']['payer_id'];
        $payer_email = $arr_body['payer']['payer_info']['email'];
        $amount = $arr_body['transactions'][0]['amount']['total'];
        $currency = PAYPAL_CURRENCY;
        $payment_status = $arr_body['state'];
        $inv_date = date("j F Y");
        $due_date = date("j F Y");
        $suply_date = date("j F Y");
        $paymentMethod = "Paypal";
        $item = "IMEI Check Credits";
        $qty = 1;
        $rowlast = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM credits ORDER BY id DESC LIMIT 1"));
        $invoice = $rowlast['invoice_no'] + 1;

        $sqlInsert = mysqli_query($db, "INSERT INTO `credits`(`username`, `invoice_no`, `item`, `qty`, `total_amount`, `inv_date`, `due_date`, `suply_date`, `payment_method`, `status`, `payment_id`, `payer_id`, `payer_email`) 
                                                VALUES ('".$_SESSION['username']."', '$invoice', '$item','$qty','$amount', '$inv_date', '$due_date', '$suply_date', '$paymentMethod', 'Unpaid', '$payment_id', '$payer_id', '$payer_email')");
        if($sqlInsert)
        {
            header("Location: ../invoiceDetails.php?invoice=".$invoice."&&approve=".$invoice."");
        }
    } else {
        echo $response->getMessage();
    }
} else {
    echo 'Transaction is declined';
}