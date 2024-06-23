<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <div class="container">
        <div class="box form-box">


        <?php

include("config.php");

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    // Check if age is greater than 18
    if($age <= 18){
        echo "<div class='message'>
                <p>You must be older than 18 to register.</p>
              </div> </br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    } else {
        $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email = '$email'");

        if(mysqli_num_rows($verify_query) != 0){
            echo "<div class='message'>
                    <p>This email is already used, try another one please!</p>
                  </div> </br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        } else {
            mysqli_query($con, "INSERT INTO users (Username, Email, Age, Password) VALUES ('$username', '$email', '$age', '$password')")
            or die("Error occurred");

            echo "<div class='message'>
                    <p>Registration Successful!</p>
                  </div> </br>";
            echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
        }
    }
} else {

?>



            <header>Sign Up</header>
            <form action=""method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Sign Up" required>
                </div>
                <div class="links">
                    Already have an acount? <a href="login.php">Login Now</a>
                </div>
            </form>
        </div>
        <?php    } ?>
    </div>
</body>
</html>