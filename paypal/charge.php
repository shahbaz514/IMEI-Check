<?php
require_once 'config.php';
$rowlast = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM credits ORDER BY id DESC LIMIT 1"));
$invoice = $rowlast['invoice_no'] + 1;
if (isset($_POST['submit'])) {

    try {
        $response = $gateway->purchase(array(
            'amount' => $_POST['amount'],
            'items' => array(
                array(
                    'name' => 'IMEI Check Credits',
                    'price' => $_POST['amount'],
                    'paymentMethod' => 'Paypal',
                    'quantity' => 1,
                    'inv_date' => date("j F Y"),
                    'due_date' => date("j F Y"),
                    'suply_date' => date("j F Y"),
                    'invoice_no' => $invoice,
                ),
            ),
            'currency' => PAYPAL_CURRENCY,
            'returnUrl' => PAYPAL_RETURN_URL,
            'cancelUrl' => PAYPAL_CANCEL_URL,
        ))->send();

        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            echo $response->getMessage();
        }
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}