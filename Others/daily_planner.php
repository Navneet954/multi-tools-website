<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Planner Creator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .planner-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 40px;
        }
        .ad-space {
            margin: 20px 0;
            padding: 25px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            text-align: center;
        }
        .task-item {
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        .task-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .task-time {
            font-weight: 500;
            color: #0d6efd;
        }
        .task-description {
            margin-left: 20px;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="planner-container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Daily Planner Creator</h1>
                    <div class="mb-4">
                        <form id="taskForm">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="time" class="form-control" id="taskTime" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="taskDescription" placeholder="Enter task description" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tasksList"></div>
                </div>
                <div class="col-md-4">
                    <div class="ad-space">
                        <h5>Advertisement Space 1</h5>
                        <p>Your ad content here</p>
                    </div>
                    <div class="ad-space">
                        <h5>Advertisement Space 2</h5>
                        <p>Your ad content here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let tasks = JSON.parse(localStorage.getItem('dailyPlannerTasks')) || [];
        
        function renderTasks() {
            const tasksList = document.getElementById('tasksList');
            tasksList.innerHTML = tasks.map((task, index) => `
                <div class="task-item" data-index="${index}">
                    <div class="d-flex align-items-center">
                        <div class="task-time">${task.time}</div>
                        <div class="task-description">${task.description}</div>
                        <button class="btn btn-danger btn-sm ms-auto" onclick="deleteTask(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        function saveTasks() {
            localStorage.setItem('dailyPlannerTasks', JSON.stringify(tasks));
        }

        function deleteTask(index) {
            tasks.splice(index, 1);
            saveTasks();
            renderTasks();
        }

        document.getElementById('taskForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const time = document.getElementById('taskTime').value;
            const description = document.getElementById('taskDescription').value;
            
            tasks.push({ time, description });
            tasks.sort((a, b) => a.time.localeCompare(b.time));
            
            saveTasks();
            renderTasks();
            
            this.reset();
        });

        renderTasks();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>