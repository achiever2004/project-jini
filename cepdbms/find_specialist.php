<?php
header('Content-Type: application/json');

// Database connection parameters
$host = 'localhost';
$db = 'doctor_db';
$user = 'root';
$pass = '#Aimer2004#';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);
$doctorType = $data['doctorType'];
$doctorRole = $data['doctorRole'];

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT specialist_name FROM doctor_specialists WHERE doctor_type = ? AND doctor_role = ?");
$stmt->bind_param('ss', $doctorType, $doctorRole);

// Execute the statement
$stmt->execute();
$stmt->bind_result($specialistName);
$stmt->fetch();

// Close the statement and connection
$stmt->close();
$conn->close();

// Return the result
if ($specialistName) {
    echo json_encode(['success' => true, 'specialistName' => $specialistName]);
} else {
    echo json_encode(['success' => false]);
}
?>
