<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown Timer</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        /* Body Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        /* Ad spaces */
        .ad-space {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Countdown Timer Styles */
        .countdown-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 70vh;
        }

        .countdown-box {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 60%;
        }

        .countdown-box h1 {
            font-size: 3rem;
            color: #007bff;
            font-weight: 700;
        }

        .time {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .time div {
            font-size: 2.5rem;
            font-weight: bold;
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 80px;
            text-align: center;
        }

        .time span {
            display: block;
            font-size: 1.2rem;
            color: #ccc;
        }

        /* Footer Ad Space */
        footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            font-size: 1.2rem;
            color: #333;
        }

    </style>

</head>
<body>

    <!-- Top Advertisement -->
    <div class="ad-space">
        <p><strong>Top Advertisement Space</strong> - Your ad here</p>
    </div>

    <!-- Countdown Timer Section -->
    <div class="container countdown-container">
        <div class="countdown-box">
            <h1>Countdown Timer</h1>
            <div class="time">
                <div id="days">
                    <p id="days-count">00</p>
                    <span>Days</span>
                </div>
                <div id="hours">
                    <p id="hours-count">00</p>
                    <span>Hours</span>
                </div>
                <div id="minutes">
                    <p id="minutes-count">00</p>
                    <span>Minutes</span>
                </div>
                <div id="seconds">
                    <p id="seconds-count">00</p>
                    <span>Seconds</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Advertisement -->
    <footer>
        <p><strong>Bottom Advertisement Space</strong> - Your ad here</p>
    </footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Countdown Timer Logic -->
    <script>
        // Set the date we're counting down to
        var countdownDate = new Date("May 30, 2025 00:00:00").getTime();

        // Update the countdown every 1 second
        var x = setInterval(function() {

            // Get the current date and time
            var now = new Date().getTime();
            
            // Find the distance between now and the countdown date
            var distance = countdownDate - now;

            // Calculate time left
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result
            document.getElementById("days-count").innerHTML = days;
            document.getElementById("hours-count").innerHTML = hours;
            document.getElementById("minutes-count").innerHTML = minutes;
            document.getElementById("seconds-count").innerHTML = seconds;

            // If the countdown is over, display a message
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("days-count").innerHTML = "00";
                document.getElementById("hours-count").innerHTML = "00";
                document.getElementById("minutes-count").innerHTML = "00";
                document.getElementById("seconds-count").innerHTML = "00";
                alert("Countdown Finished!");
            }
        }, 1000);
    </script>

</body>
</html>
