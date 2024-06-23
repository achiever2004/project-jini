<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = 'doctor_db';
$user = 'root';
$pass = '#Aimer2004#';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$data = json_decode(file_get_contents('php://input'), true);
$doctorType = $data['doctorType'];
$doctorRole = $data['doctorRole'];

$stmt = $conn->prepare("SELECT specialist_name FROM doctor_specialists WHERE doctor_type = ? AND doctor_role = ?");
$stmt->bind_param('ss', $doctorType, $doctorRole);

$stmt->execute();
$stmt->bind_result($specialistName);
$stmt->fetch();

$stmt->close();
$conn->close();

if ($specialistName) {
    echo json_encode(['success' => true, 'specialistName' => $specialistName]);
} else {
    echo json_encode(['success' => false]);
}
?>
