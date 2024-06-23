<?php
session_start();
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'];
    $command = $_POST['user_command'];

    $api_key = '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'; 
    $api_url = 'https://datasets-server.huggingface.co/splits?dataset=gsarti%2Fflores_101';

    $data = [
        'inputs' => $command,
        'parameters' => [
            'max_length' => 150,
            'temperature' => 0.7
        ]
    ];

    $ch = curl_init($api_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' . 'Bearer ' . $api_key
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response, true);

    $generated_response = isset($response_data[0]['generated_text']) ? $response_data[0]['generated_text'] : "I'm sorry, I couldn't process your request.";

    $stmt = $con->prepare("INSERT INTO conversations (user_id, command, response) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $command, $generated_response);
    $stmt->execute();
    $stmt->close();

    $keywords = [
        'Task Manager' => 'tasks.php',
        '3D Companion' => 'companion3d.php',
        'Smart Assistant' => 'doctor_specialist.php',
        'Global Connectivity' => 'global_connectivity.php',
        'Complete Authorization' => 'complete_authorization.php',
        'Limited Access' => 'limited_access.php'
    ];

    foreach ($keywords as $keyword => $page) {
        if (stripos($command, $keyword) !== false) {
            header("Location: $page");
            exit();
        }
    }

    $_SESSION['response'] = $generated_response;
    header("Location: interactive_page.php");
    exit();
}
?>
