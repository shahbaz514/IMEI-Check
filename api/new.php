<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['endpoint'] == 'usersget') {
    // code to retrieve products from database
    // return the products in JSON format
}
// connect to database
$db = new PDO('mysql:host=localhost;dbname=imeichec_apios', 'imeichec_apios', 'Shahbaz@786');

// retrieve products from database
$stmt = $db->query('SELECT * FROM users');
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// encode products in JSON format
$json = json_encode($products);

// set content-type header
header('Content-Type: application/json');

// return JSON response
echo $json;


?>
