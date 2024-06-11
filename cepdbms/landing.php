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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles_landing.css">
    <script defer src="script.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <div class="ball-1"></div>
        <div class="ball-2"></div>
        <div class="ball-3"></div>
        <div class="box">
            <nav>
                <div class="logo">
                    <img src="./logo-aruk.jpg" width="50" height="auto" style="margin-top: 20px;" alt="Example Image">
                </div>
                <div class="menu-toggle" id="menu-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul id="nav-menu" class="Navbar glass">
                    <li><a href="./landing.php">Home</a></li>
                    <li><a href="./functions.php">Functionalities</a></li>
                    <li><a href="./welcome.php">Logout</a></li>
                </ul>
            </nav>

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

            <div class="contains">
                <div class="section-1">
                    <h1>Welcome! <b><?php echo $res_Uname ?></b></h1>
                    <h3>To our <span></span> New Personalised <span></span> Assistant</h3>
                    <p>Your email is <br>
                        <b style="color: red;"><?php echo $res_Email; ?></b>
                    </p>
                    <p>Explore the Learning gateway with your creation.</p>
                    <div class="button">
                        <a href="aboutus.php">AboutUs</a>
                        <a href="./edit.php">Change Profile</a>
                    </div>
                    <div class="glass">
                    <h2>Submit Your Text</h2>
                    <form action="submit_text.php" method="POST">
                        <textarea name="user_text" rows="5" cols="40" placeholder="Enter your text here..."></textarea><br>
                        <button type="submit" class="new_but">Submit</button>
                    </form>
                </div>
                </div>

                
            </div>
            
        </div>
    </div>
</body>
</html>
