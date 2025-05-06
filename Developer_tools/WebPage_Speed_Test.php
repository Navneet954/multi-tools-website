<?php
// Optional: You can insert logic here for logging or handling any server-side tasks related to the speed test.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Page Speed Test</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding-top: 80px;
        }

        .main-container {
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: 20px auto;
            border-radius: 8px;
            width: 100%;
            max-width: 900px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .ad-space {
            background-color: #f0f0f0;
            height: 80px;
            margin-bottom: 20px;
            text-align: center;
            line-height: 80px;
            color: #333;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-test {
            width: 100%;
            margin-top: 20px;
        }

        .progress-bar {
            width: 0%;
        }

        .result {
            margin-top: 20px;
            display: none;
            text-align: center;
        }

        .alert {
            display: none;
        }

        .result .speed-result {
            font-size: 1.5rem;
            color: #007bff;
            font-weight: bold;
        }

        .result .time {
            color: #888;
        }
    </style>
</head>
<body>

<!-- Ad Space Top -->
<div class="ad-space">Ad Space (Top)</div>

<div class="container">
    <div class="main-container">
        <h1>Web Page Speed Test</h1>

        <!-- URL Input and Test Button -->
        <div class="mb-3">
            <input type="text" class="form-control" id="url" placeholder="Enter URL for Speed Test" required>
        </div>

        <button class="btn btn-primary btn-test" id="startTest">Start Speed Test</button>

        <!-- Loading Spinner -->
        <div id="loading" class="spinner-border text-primary" role="status" style="display: none; margin-top: 20px;">
            <span class="visually-hidden">Loading...</span>
        </div>

        <!-- Progress Bar -->
        <div class="progress mt-4" style="height: 25px; display: none;">
            <div class="progress-bar" role="progressbar"></div>
        </div>

        <!-- Test Results -->
        <div class="result">
            <div class="speed-result">Test Completed</div>
            <div class="time">Page Load Time: <span id="loadTime"></span> seconds</div>
        </div>

        <div class="alert alert-danger" role="alert" id="errorAlert" style="display: none;">
            Please enter a valid URL.
        </div>
    </div>
</div>

<!-- Ad Space Bottom -->
<div class="ad-space">Ad Space (Bottom)</div>

<!-- Bootstrap and JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
// JavaScript for the Speed Test
document.getElementById('startTest').addEventListener('click', function() {
    var url = document.getElementById('url').value;

    // Display error if URL is empty
    if (!url) {
        document.getElementById('errorAlert').style.display = 'block';
        return;
    } else {
        document.getElementById('errorAlert').style.display = 'none';
    }

    // Prepare for the test
    document.getElementById('loading').style.display = 'inline-block';
    document.querySelector('.progress').style.display = 'block';

    // Start test
    var startTime = Date.now();

    // Simulate a speed test with setTimeout (replace this with actual logic for real testing)
    var fakeLoadTime = Math.random() * 3 + 2; // Fake load time between 2 and 5 seconds
    var progressBar = document.querySelector('.progress-bar');

    var interval = setInterval(function() {
        var currentProgress = (Date.now() - startTime) / (fakeLoadTime * 1000) * 100;
        if (currentProgress >= 100) {
            clearInterval(interval);
            currentProgress = 100;
            document.getElementById('loading').style.display = 'none';
            document.querySelector('.result').style.display = 'block';
            document.getElementById('loadTime').innerText = fakeLoadTime.toFixed(2);
        }
        progressBar.style.width = currentProgress + '%';
    }, 100);

    // Simulate delay for fake loading
    setTimeout(function() {
        document.querySelector('.result').style.display = 'block';
        document.getElementById('loadTime').innerText = fakeLoadTime.toFixed(2);
    }, fakeLoadTime * 1000);
});
</script>

</body>
</html>
