<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    $sql = "INSERT INTO tasks (title, time, date) VALUES ('$title', '$time', '$date')";

    if ($con->query($sql) === TRUE) {
        header("Location: tasks.php");
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>
