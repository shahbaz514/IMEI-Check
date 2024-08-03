<?php
// Connect to your database
$db = new PDO('mysql:host=localhost;dbname=imeichec_apios', 'imeichec_apios', 'Shahbaz@786');

// Get all the blog posts
$stmt = $db->query('SELECT * FROM users');
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the blog posts as JSON
header('Content-Type: application/json');
echo json_encode($posts);
?>
<?php
// Define your API endpoints
$endpoints = array(
    '/posts' => 'userspost.php',
    '/posts/(\d+)' => 'userspost.php?id=$1'
);

// Get the request URI
$request_uri = $_SERVER['REQUEST_URI'];

// Remove the query string from the request URI
$request_uri = explode('?', $request_uri)[0];

// Find the script to run for the requested endpoint
foreach ($endpoints as $pattern => $script) {
    // Replace any regex patterns with their values
    $pattern = str_replace('/', '\/', $pattern);
    $pattern = '/^' . $pattern . '$/';

    if (preg_match($pattern, $request_uri)) {
        // Call the script for the matching endpoint
        include $script;
        exit;
    }
}

// If no endpoint was matched, return a 404 error
header('HTTP/1.0 404 Not Found');
echo '404 Not Found';
?>
