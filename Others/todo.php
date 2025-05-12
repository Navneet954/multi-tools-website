<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for styling -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container {
            max-width: 800px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .todo-item {
            display: flex;
            align-items: center;
            padding: 26px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: all 0.3s ease-in-out;
            
        }
        .todo-item:hover {
            background-color: #f1f1f1;
        }
        .todo-item button {
            margin-left: 10px;
        }
        .todo-input {
            margin-bottom: 20px;
        }
        .todo-list {
            margin-top: 30px;
        }
        .ad-space {
            background-color: #ffcc00;
            text-align: center;
            padding: 10px;
            margin: 10px 0;
            font-size: 1.2rem;
            color: black;
            font-weight: bold;
        }
        .ad-space-bottom {
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
            background-color: #ffcc00;
            padding: 10px;
        }
        .completed {
            text-decoration: line-through;
            color: #999;
        }
    </style>
</head>
<body>

<!-- Ad Space Top -->
<div class="ad-space">
    <p>Advertisement Space - Top</p>
</div>

<div class="container">
    <div class="header">
        <h1>To-Do List</h1>
        <p class="lead">Manage your tasks easily with a simple and effective to-do list.</p>
    </div>

    <!-- Input Field for New Task -->
    <div class="todo-input">
        <input type="text" id="todo-input" class="form-control" placeholder="Enter a new task">
        <button class="btn btn-primary mt-2" id="add-btn">Add Task</button>
    </div>

    <!-- Todo List Display -->
    <div class="todo-list" id="todo-list">
        <!-- To-Do items will appear here dynamically -->
    </div>
</div>

<!-- Ad Space Bottom -->
<div class="ad-space-bottom">
    <p>Advertisement Space - Bottom</p>
</div>

<!-- JavaScript for functionality -->
<script>
    const todoInput = document.getElementById('todo-input');
    const addBtn = document.getElementById('add-btn');
    const todoList = document.getElementById('todo-list');

    // Function to add a new task
    addBtn.addEventListener('click', () => {
        const taskText = todoInput.value.trim();

        if (taskText) {
            const todoItem = document.createElement('div');
            todoItem.classList.add('todo-item');
            
            // Create checkbox
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.classList.add('me-3');
            checkbox.onclick = () => {
                if (checkbox.checked) {
                    taskTextElement.classList.add('completed');
                } else {
                    taskTextElement.classList.remove('completed');
                }
            };
            todoItem.appendChild(checkbox);

            // Add task text
            const taskTextElement = document.createElement('span');
            taskTextElement.textContent = taskText;
            todoItem.appendChild(taskTextElement);

            // Edit button
            const editBtn = document.createElement('button');
            editBtn.classList.add('btn', 'btn-warning', 'btn-sm');
            editBtn.textContent = 'Edit';
            editBtn.onclick = () => {
                todoInput.value = taskText;
                todoItem.remove();
            };
            todoItem.appendChild(editBtn);

            // Delete button
            const deleteBtn = document.createElement('button');
            deleteBtn.classList.add('btn', 'btn-danger', 'btn-sm');
            deleteBtn.textContent = 'Delete';
            deleteBtn.onclick = () => {
                todoItem.remove();
            };
            todoItem.appendChild(deleteBtn);

            // Append to the list
            todoList.appendChild(todoItem);
            todoInput.value = ''; // Clear input field
        }
    });

    // Optionally, allow pressing 'Enter' to add a task
    todoInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            addBtn.click();
        }
    });
</script>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
