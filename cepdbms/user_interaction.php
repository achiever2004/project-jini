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
    <title>User Interaction</title>
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
                <div class="glass glass-interaction">
                    <h2><b><?php echo strtoupper($res_Uname);?></b> Interaction</h2>
                    <form id="commandForm" action="process_command.php" method="POST">
                        <textarea name="user_command" rows="5" cols="40" placeholder="Enter your command here..."></textarea><br>
                        <button type="submit" class="new_but">Submit</button>
                    </form>
                </div>
                <div class="glass-interaction">
                    <h2>JINI Response</h2>
                    <div id="responses">
                        <!-- Responses will be displayed here -->
                    </div>
                    <div class="glass">
                        <div id="additionalResponse">
                            <!-- Response will be displayed here -->
                        </div>
                    </div>
                </div>
                <div class="button-group">
                        <button class="go-back-button" onclick="goBack()">Go Back</button>
                </div>
            </div>
        </div>  
        
    </div>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>