<?php

session_start();

include("config.php");
if(!isset($_SESSION['valid'])){
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="chatstyle.css">
</head>
<body>
    <div class="container">
            <?php
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");
                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $res_id = $result['Id'];
                }
            ?>
        <h2>Hello <b><?php echo $res_Uname ?></b> lets interact</h2>
        <div class="chat-container">
            
            <div class="chat-box" id="chat-box">
                <!-- Chat messages will be appended here -->
            </div>
            <form id="chat-form">
                <input type="text" id="user-input" placeholder="Type your message here..." required>
                <button type="submit">Send</button>
            </form>
        </div>
        <button id="go-back" onclick="goBack()">Go Back</button>
    </div>
    
    
    

    <script src="script.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
