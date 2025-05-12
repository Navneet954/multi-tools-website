<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awesome Stopwatch Timer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fb;
        }
        .stopwatch-container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .stopwatch-display {
            font-size: 3rem;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin: 20px 0;
        }
        .btn-start-stop, .btn-reset {
            font-size: 1.2rem;
            padding: 10px 30px;
            margin: 10px;
            border-radius: 10px;
            border: none;
        }
        .btn-start-stop {
            background-color: #007bff;
            color: white;
        }
        .btn-reset {
            background-color: #dc3545;
            color: white;
        }
        .ad-space {
            background-color: #f8f9fa;
            text-align: center;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
        }
        /* For responsiveness */
        @media (max-width: 576px) {
            .stopwatch-container {
                padding: 15px;
            }
            .stopwatch-display {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Ad Space Top -->
    <div class="ad-space">
        <h5>Advertisement Space</h5>
        <p>Place your ads here</p>
    </div>

    <div class="container">
        <div class="stopwatch-container">
            <h2 class="text-center mb-4">Awesome Stopwatch</h2>
            <!-- Stopwatch Display -->
            <div class="stopwatch-display" id="display">00:00:00</div>

            <!-- Stopwatch Controls -->
            <div class="text-center">
                <button class="btn-start-stop" id="startStopBtn">Start</button>
                <button class="btn-reset" id="resetBtn">Reset</button>
            </div>
        </div>
    </div>

    <!-- Ad Space Bottom -->
    <div class="ad-space">
        <h5>Advertisement Space</h5>
        <p>Place your ads here</p>
    </div>

    <!-- JavaScript for Stopwatch Functionality -->
    <script>
        let timer;
        let isRunning = false;
        let elapsedTime = 0;
        let startStopBtn = document.getElementById("startStopBtn");
        let display = document.getElementById("display");
        let resetBtn = document.getElementById("resetBtn");

        function formatTime(time) {
            let hours = Math.floor(time / 3600);
            let minutes = Math.floor((time % 3600) / 60);
            let seconds = time % 60;

            return `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
        }

        function pad(num) {
            return num < 10 ? `0${num}` : num;
        }

        function startStopwatch() {
            if (!isRunning) {
                timer = setInterval(function() {
                    elapsedTime++;
                    display.textContent = formatTime(elapsedTime);
                }, 100);
                startStopBtn.textContent = "Stop";
            } else {
                clearInterval(timer);
                startStopBtn.textContent = "Start";
            }
            isRunning = !isRunning;
        }

        function resetStopwatch() {
            clearInterval(timer);
            elapsedTime = 0;
            display.textContent = formatTime(elapsedTime);
            startStopBtn.textContent = "Start";
            isRunning = false;
        }

        startStopBtn.addEventListener("click", startStopwatch);
        resetBtn.addEventListener("click", resetStopwatch);
    </script>

    <!-- Bootstrap JS (for Bootstrap components like modals, tooltips, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
