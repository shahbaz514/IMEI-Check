<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel</title>
</head>
<body>
<h3>User cancelled the payment.</h3>

<?php

ob_start();
session_start();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header('Location: signin.php');
}
$sqlSelect = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM credits WHERE username = '".$_SESSION['username']."' ORDER BY id DESC"));
$sqlUp = mysqli_query($db, "UPDATE `credits` SET status = 'Cancel' WHERE id = '".$sqlSelect['id']."'");
if ($sqlUp)
{
    header("Location: ../invoiceDetails.php?invoice=".$sqlSelect['invoice_no']."");
}
?>
</body>
</html>