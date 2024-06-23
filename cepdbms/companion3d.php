<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Companion Gallery</title>
    <link rel="stylesheet" href="styles_img.css">
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <div class="ball-1"></div>
    <div class="ball-2"></div>
    <div class="ball-3"></div>
    <div class="container-task task-body">
        <h1 class="task">Image Gallery</h1>
        <div class="add-task">
            <h2>Add New Image</h2>
            <form action="upload_image.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="image" required>
                <button type="submit">Upload Image</button>
            </form>
        </div>
        <div class="task-section">
            <h2>Uploaded Images</h2>
            <ul class="image-grid">
                <?php
                include 'config.php';
                $sql = "SELECT * FROM images ORDER BY uploaded_at DESC";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li>";
                        echo "<img src='uploads/" . $row['filename'] . "' alt='" . $row['filename'] . "'>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>No images uploaded yet</li>";
                }

                $con->close();
                ?>
            </ul>
        </div>
        <div class="close-container">
            <button class="close-button" onclick="goBack()">Close</button>
        </div>
    </div>
</body>
</html>
