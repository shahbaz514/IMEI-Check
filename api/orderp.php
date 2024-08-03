<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if ($_SERVER['REQUEST_METHOD'] !== 'POST') :
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Invalid Request Method. HTTP method should be POST',
    ]);
    exit;
endif;

require 'db.php';
$database = new Database();
$conn = $database->dbConnection();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->orderid) || !isset($data->status) || !isset($data->service) || !isset($data->imei) || !isset($data->result) || !isset($data->credits) || !isset($data->username)) :

    echo json_encode([
        'success' => 0,
        'message' => 'Please fill all the fields.',
    ]);
    exit;

elseif (empty(trim($data->orderid)) || empty(trim($data->status)) || empty(trim($data->service)) || empty(trim($data->imei)) || empty(trim($data->result)) || empty(trim($data->credits)) || empty(trim($data->username))) :

    echo json_encode([
        'success' => 0,
        'message' => 'Oops! empty field detected. Please fill all the fields.',
    ]);
    exit;

endif;

try {

    $orderid = htmlspecialchars(trim($data->orderid));
    $status = htmlspecialchars(trim($data->status));
    $service = htmlspecialchars(trim($data->service));
    $imei = htmlspecialchars(trim($data->imei));
     $result = htmlspecialchars(trim($data->result));
    $credits = htmlspecialchars(trim($data->credits));
    $username = htmlspecialchars(trim($data->username));
    

    $query = "INSERT INTO `orders`(orderid,status,service,imei,result,credits,username) VALUES(:orderid,:status,:service,:imei,:result,:credits,:username)";

    $stmt = $conn->prepare($query);

    $stmt->bindValue(':orderid', $orderid, PDO::PARAM_STR);
    $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    $stmt->bindValue(':service', $service, PDO::PARAM_STR);
    $stmt->bindValue(':imei', $imei, PDO::PARAM_STR);
    $stmt->bindValue(':result', $result, PDO::PARAM_STR);
    $stmt->bindValue(':credits', $credits, PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    
    if ($stmt->execute()) {

        http_response_code(201);
        echo json_encode([
            'success' => 1,
            'message' => 'Data Inserted Successfully.'
        ]);
        exit;
    }
    
    echo json_encode([
        'success' => 0,
        'message' => 'Data not Inserted.'
    ]);
    exit;

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => 0,
        'message' => $e->getMessage()
    ]);
    exit;
}