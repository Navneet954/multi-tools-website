<?php
// habit_tracker.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Habit Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 90px;
        }
        .habit-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .habit-card:hover {
            transform: translateY(-5px);
        }
        .ad-space {
            background: #ddd;
            text-align: center;
            padding: 20px;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #007bff;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .habit-list-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .habit-list-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

<!-- Top Ad Space -->
<div class="container">
    <div class="ad-space">
        Top Ad Space (728x90)
    </div>
</div>

<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Habit Tracker</h1>
        <p class="text-muted">Stay consistent and build great habits!</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="habit-card">
                <form id="habitForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" id="habitName" class="form-control" placeholder="Enter Habit Name" required>
                        </div>
                        <div class="col-md-4">
                            <input type="date" id="habitDate" class="form-control" required>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-custom">Add</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="habit-card mt-4">
                <h4 class="mb-3">Your Habits</h4>
                <div id="habitList" class="habit-list">
                    <!-- Habits will appear here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Ad Space -->
<div class="container mt-5">
    <div class="ad-space">
        Bottom Ad Space (728x90)
    </div>
</div>

<!-- Bootstrap JS & jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Habit Tracker JavaScript
$(document).ready(function() {
    $('#habitForm').on('submit', function(e) {
        e.preventDefault();
        let habitName = $('#habitName').val().trim();
        let habitDate = $('#habitDate').val();
        if(habitName && habitDate) {
            $('#habitList').append(`
                <div class="habit-list-item">
                    <span><strong>${habitName}</strong> - ${habitDate}</span>
                    <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                </div>
            `);
            $('#habitName').val('');
            $('#habitDate').val('');
        }
    });

    // Delete Habit
    $(document).on('click', '.delete-btn', function() {
        $(this).closest('.habit-list-item').fadeOut(300, function() {
            $(this).remove();
        });
    });
});
</script>

</body>
</html>
