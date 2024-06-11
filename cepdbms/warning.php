<?php
session_start();
include("config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warning</title>
    <link rel="stylesheet" href="styles_landing.css">
</head>
<body>
    <div class="container">
        <div class="ball-1"></div>
        <div class="ball-2"></div>
        <div class="ball-3"></div>
        <div class="box">
            <div class="contains">
                <div class="section-1">
                    <h1>Warning!</h1>
                    <p>Your search items were not yet upgraded!</p>
                    <div class="button">
                        <a href="javascript:history.back()">GoBack</a>
                        <a href="contactus.php">ContactTeam</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
