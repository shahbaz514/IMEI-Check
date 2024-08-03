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

if (!isset($data->username) || !isset($data->invoice_no) || !isset($data->total_amount) || !isset($data->inv_date) || !isset($data->due_date) || !isset($data->suply_date) || !isset($data->payment_method) || !isset($data->status) || !isset($data->prof) || !isset($data->payment_id) || !isset($data->payer_id) || !isset($data->payer_email)) :

    echo json_encode([
        'success' => 0,
        'message' => 'Please fill all the fields.',
    ]);
    exit;

elseif (empty(trim($data->username)) || empty(trim($data->invoice_no)) || empty(trim($data->total_amount)) || empty(trim($data->inv_date)) || empty(trim($data->due_date)) || empty(trim($data->suply_date)) || empty(trim($data->payment_method)) || empty(trim($data->status)) || empty(trim($data->prof)) || empty(trim($data->payment_id)) || empty(trim($data->payer_id)) || empty(trim($data->payer_email))) :

    echo json_encode([
        'success' => 0,
        'message' => 'Oops! empty field detected. Please fill all the fields.',
    ]);
    exit;

endif;

try {

    $username = htmlspecialchars(trim($data->username));
    $invoice_no = htmlspecialchars(trim($data->invoice_no));
    $total_amount = htmlspecialchars(trim($data->total_amount));
    $inv_date = htmlspecialchars(trim($data->inv_date));
     $due_date = htmlspecialchars(trim($data->due_date));
    $suply_date = htmlspecialchars(trim($data->suply_date));
    $payment_method = htmlspecialchars(trim($data->payment_method));
    $status= htmlspecialchars(trim($data->status));
     $prof = htmlspecialchars(trim($data->prof));
    $payment_id = htmlspecialchars(trim($data->payment_id));
    $payer_id = htmlspecialchars(trim($data->payer_id));
    $payer_email = htmlspecialchars(trim($data->payer_email));
 
    

    $query = "INSERT INTO `credits`(username,invoice_no,total_amount,inv_date,due_date,suply_date,payment_method,status,prof,payment_id,payer_id,payer_email)
    VALUES(:username,:invoice_no,:total_amount,:inv_date,:due_date,:suply_date,:payment_method,:status,:prof,:payment_id,:payer_id,:payer_email)";

    $stmt = $conn->prepare($query);

    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':invoice_no', $invoice_no, PDO::PARAM_STR);
    $stmt->bindValue(':total_amount', $total_amount, PDO::PARAM_STR);
    $stmt->bindValue(':inv_date', $inv_date, PDO::PARAM_STR);
     $stmt->bindValue(':due_date', $due_date, PDO::PARAM_STR);
    $stmt->bindValue(':suply_date', $suply_date, PDO::PARAM_STR);
    $stmt->bindValue(':payment_method', $payment_method, PDO::PARAM_STR);
    $stmt->bindValue(':status', $status, PDO::PARAM_STR);
     $stmt->bindValue(':prof', $prof, PDO::PARAM_STR);
    $stmt->bindValue(':payment_id', $payment_id, PDO::PARAM_STR);
    $stmt->bindValue(':payer_id', $payer_id, PDO::PARAM_STR);
    $stmt->bindValue(':payer_email', $payer_email, PDO::PARAM_STR);


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