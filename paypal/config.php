<?php
require_once "vendor/autoload.php";

use Omnipay\Omnipay;
// Connect with the database
$db = new mysqli('localhost', 'imeichec_apios', 'Shahbaz@786', 'imeichec_apios');

if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}

$sqlAuth = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM athentication WHERE id = '1'"));

define('CLIENT_ID', $sqlAuth['paypal_CLIENT_ID']);
define('CLIENT_SECRET', $sqlAuth['paypal_CLIENT_SECRET']);

define('PAYPAL_RETURN_URL', 'https://imeicheck.uk/beta/paypal/success.php');
define('PAYPAL_CANCEL_URL', 'https://imeicheck.uk/beta/paypal/cancel.php');
define('PAYPAL_CURRENCY', 'USD'); // set your currency here


$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live

