<?php
session_start();
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'];
    $command = $_POST['user_command'];

    // Hugging Face API configuration
    $api_key = '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'; // Replace with your Hugging Face API key
    $api_url = 'https://datasets-server.huggingface.co/splits?dataset=gsarti%2Fflores_101';

    // Prepare data for the Hugging Face API request
    $data = [
        'inputs' => $command,
        'parameters' => [
            'max_length' => 150,
            'temperature' => 0.7
        ]
    ];

    // Initialize cURL session
    $ch = curl_init($api_url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' . 'Bearer ' . $api_key
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute cURL request and get response
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the API response
    $response_data = json_decode($response, true);

    // Check if the response is valid and contains generated text
    $generated_response = isset($response_data[0]['generated_text']) ? $response_data[0]['generated_text'] : "I'm sorry, I couldn't process your request.";

    // Store the command and response in the database
    $stmt = $con->prepare("INSERT INTO conversations (user_id, command, response) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $command, $generated_response);
    $stmt->execute();
    $stmt->close();

    // Check for keywords to redirect to respective pages
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
