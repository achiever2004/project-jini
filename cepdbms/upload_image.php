<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $filename = basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $stmt = $con->prepare("INSERT INTO images (filename) VALUES (?)");
            $stmt->bind_param("s", $filename);
            if ($stmt->execute()) {
                header("Location: companion3d.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file uploaded or upload error.";
    }
}
?>
