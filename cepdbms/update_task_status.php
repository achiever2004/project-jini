<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $completed = $_POST['completed'];

    $sql = "UPDATE tasks SET completed = $completed WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        header("Location: tasks.php");
    } else {
        echo "Error updating record: " . $con->error;
    }

    $con->close();
}
?>
