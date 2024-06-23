document.addEventListener('DOMContentLoaded', (event) => {
    fetchTasks();
});

function fetchTasks() {
    fetch('fetch_tasks.php')
    .then(response => response.json())
    .then(data => {
        let pendingTasks = document.getElementById('pendingTasks');
        let completedTasks = document.getElementById('completedTasks');
        pendingTasks.innerHTML = '';
        completedTasks.innerHTML = '';

        data.forEach(task => {
            let taskItem = document.createElement('li');
            taskItem.textContent = `${task.title} - ${task.time} - ${task.date}`;
            taskItem.setAttribute('data-id', task.id);
            taskItem.setAttribute('data-completed', task.completed);

            let checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.checked = task.completed;
            checkbox.addEventListener('change', updateTaskStatus);

            taskItem.appendChild(checkbox);

            if (task.completed) {
                taskItem.classList.add('completed');
                completedTasks.appendChild(taskItem);
            } else {
                pendingTasks.appendChild(taskItem);
            }
        });
    });
}

function addTask() {
    let title = document.getElementById('taskTitle').value;
    let time = document.getElementById('taskTime').value;
    let date = document.getElementById('taskDate').value;

    fetch('add_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `title=${title}&time=${time}&date=${date}`
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        fetchTasks();
    });
}

function updateTaskStatus(event) {
    let taskId = event.target.parentElement.getAttribute('data-id');
    let completed = event.target.checked ? 1 : 0;

    fetch('update_task_status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${taskId}&completed=${completed}`
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        fetchTasks();
    });
}

document.getElementById('chat-form').addEventListener('submit', function(event) {
    event.preventDefault();
    let userInput = document.getElementById('user-input').value;

    let userMessage = document.createElement('div');
    userMessage.classList.add('chat-message', 'user');
    userMessage.textContent = userInput;
    document.getElementById('chat-box').appendChild(userMessage);

    fetch('chatbot.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'user_query=' + encodeURIComponent(userInput)
    })
    .then(response => response.text())
    .then(data => {
        let botMessage = document.createElement('div');
        botMessage.classList.add('chat-message', 'bot');
        botMessage.textContent = data;
        document.getElementById('chat-box').appendChild(botMessage);

        document.getElementById('chat-box').scrollTop = document.getElementById('chat-box').scrollHeight;
    });

    document.getElementById('user-input').value = '';
});

