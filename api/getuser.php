<?php
// Establish database connection
$dbHost = 'localhost';
$dbName = 'imeichec_apios';
$dbUser = 'imeichec_apios';
$dbPass = 'Shahbaz@786';

$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

// Login endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve login credentials from the request body
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $password = $data['password'];

    // Retrieve user details from the database based on the provided username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Authentication successful
        $response = ['message' => 'Login successful'];
        // You can generate and return a session token or JWT here
    } else {
        // Authentication failed
        $response = ['message' => 'Invalid username or password'];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>