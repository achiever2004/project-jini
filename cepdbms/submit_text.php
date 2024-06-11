<?php
session_start();
include("config.php");

if(!isset($_SESSION['valid'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$user_text = mysqli_real_escape_string($con, $_POST['user_text']);

// Insert submission into the database
$sql = "INSERT INTO user_submissions (username, submission) VALUES ('$username', '$user_text')";
mysqli_query($con, $sql);

// Analyze the text for keywords
$keywords = array("tasks", "companion3d", "doctor_specialist"); // Replace with actual keywords
$redirect_page = "warning.php"; // Default redirect page to warning.php

foreach ($keywords as $keyword) {
    if (strpos($user_text, $keyword) !== false) {
        $redirect_page = $keyword . ".php"; // Redirect to a specific page based on keyword
        break;
    }
}

// Redirect to the appropriate page
header("Location: $redirect_page");
exit();
?>
