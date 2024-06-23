<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="styles_tasks.css">
</head>
<body>
    <div class="ball-1"></div>
    <div class="ball-2"></div>
    <div class="ball-3"></div>
    <div class="container-task task-body">
        <h1 class="task">Task Manager</h1>
        <div class="add-task">
            <h2>Add New Task</h2>
            <form action="add_task.php" method="POST">
                <input type="text" name="title" placeholder="Task Title" required>
                <input type="time" name="time" required>
                <input type="date" name="date" required>
                <button type="submit">Add Task</button>
            </form>
        </div>
        <div class="task-section">
            <h2>Pending Tasks</h2>
            <ul>
                <?php
                    include 'config.php';
                    $sql = "SELECT * FROM tasks WHERE completed = FALSE";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<li>";
                            echo $row['title'] . " - " . $row['time'] . " - " . $row['date'];
                            echo "<form action='update_task_status.php' method='POST' style='display:inline;'>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "<input type='hidden' name='completed' value='1'>";
                            echo "<input type='checkbox' onchange='this.form.submit()'>";
                            echo "</form>";
                            echo "</li>";
                        }
                    } else {
                        echo "<li>No pending tasks</li>";
                    }

                    $con->close();
                ?>
            </ul>
        </div>
        <div class="task-section">
            <h2>Completed Tasks</h2>
            <ul>
            <?php
                include 'config.php';
                $sql = "SELECT * FROM tasks WHERE completed = TRUE";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li class='completed'>";
                        echo $row['title'] . " - " . $row['time'] . " - " . $row['date'];
                        echo "<form action='update_task_status.php' method='POST' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='hidden' name='completed' value='0'>";
                        echo "<input type='checkbox' checked onchange='this.form.submit()'>";
                        echo "</form>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>No completed tasks</li>";
                }

                $con->close();
                ?>
            </ul>
        </div>
        <div class="glass-effect">
            <button onclick="goBack()">Go Back</button>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
