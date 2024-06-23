<?php
session_start();
include("config.php");

if(!isset($_SESSION['valid'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$user_text = mysqli_real_escape_string($con, $_POST['user_text']);

$sql = "INSERT INTO user_submissions (username, submission) VALUES ('$username', '$user_text')";
mysqli_query($con, $sql);

$keywords = array("tasks", "companion3d", "doctor_specialist"); 
$redirect_page = "warning.php"; 

foreach ($keywords as $keyword) {
    if (strpos($user_text, $keyword) !== false) {
        $redirect_page = $keyword . ".php"; 
        break;
    }
}

header("Location: $redirect_page");
exit();
?>
