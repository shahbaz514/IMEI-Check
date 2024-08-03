<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['endpoint'] == 'creditsget') {
    // code to retrieve products from database
    // return the products in JSON format
}
// connect to database
$db = new PDO('mysql:host=localhost;dbname=imeichec_apios', 'imeichec_apios', 'Shahbaz@786');

// retrieve products from database
$stmt = $db->query('SELECT * FROM credits');
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// encode products in JSON format
$json = json_encode($products);

// set content-type header
header('Content-Type: application/json');

// return JSON response
echo $json;


?>
