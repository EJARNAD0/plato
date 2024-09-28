<?php
// Assuming you're using POST and receiving JSON
header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['message' => 'Invalid input']);
    http_response_code(400); // Bad request
    exit;
}

// Example of processing the data
$firstname = $data['firstname'] ?? null;
$lastname = $data['lastname'] ?? null;
$username = $data['username'] ?? null;
$password = $data['password'] ?? null;
$access = $data['access'] ?? null;

// Ensure all fields are provided
if (!$firstname || !$lastname || !$username || !$password || !$access) {
    echo json_encode(['message' => 'Please fill all fields']);
    http_response_code(400); // Bad request
    exit;
}

// For demonstration purposes, let's assume you have a database connection here
// Example database interaction
// $conn = new mysqli($servername, $username, $password, $dbname);

// Placeholder for database insertion logic
// $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, password, access) VALUES (?, ?, ?, ?, ?)");
// $stmt->bind_param("sssss", $firstname, $lastname, $username, password_hash($password, PASSWORD_DEFAULT), $access);

// Assuming insertion is successful
// if ($stmt->execute()) {
echo json_encode(['message' => 'User created successfully']);
http_response_code(200); // OK
// } else {
//    echo json_encode(['message' => 'User creation failed']);
//    http_response_code(500); // Internal Server Error
// }

exit;
?>
