<?php
$servername = "localhost";
$username = "root";
$password = "#Aimer2004#";
$dbname = "cep";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_query = $_POST['user_query'];
$response = "Sorry, I don't understand that.";

if (preg_match('/^[0-9\+\-\*\/\(\) ]+$/', $user_query)) {
    try {
        $result = eval("return $user_query;");
        $response = "The result is: $result";
    } catch (Exception $e) {
        $response = "There was an error in your mathematical expression.";
    }
} else {
    $sql = "SELECT bot_response FROM conversations WHERE user_query LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_query = "%$user_query%";
    $stmt->bind_param("s", $search_query);
    $stmt->execute();
    $stmt->bind_result($bot_response);

    if ($stmt->fetch()) {
        $response = $bot_response;
    }

    $stmt->close();
}

$conn->close();

echo $response;
?>
