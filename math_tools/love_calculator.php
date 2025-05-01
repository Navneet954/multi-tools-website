<?php
// No backend processing required, all done in JS
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Love Calculator ❤️</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #ffafbd, #ffc3a0);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
        }
        .love-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: 0.4s;
        }
        .love-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .result-box {
            margin-top: 20px;
            padding: 20px;
            background: #ffdde1;
            border-radius: 10px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            color: #d6336c;
            display: none;
        }
        .ad-space {
            background: #f8f9fa;
            text-align: center;
            padding: 10px;
            margin: 20px 0;
            border: 1px dashed #ccc;
            color: #6c757d;
        }
    </style>

</head>
<body>

<!-- Top Ad Space -->
<div class="ad-space">
    Your Top Ad Here (728x90)
</div>

<div class="container d-flex align-items-center justify-content-center flex-column">
    <h1 class="text-white text-center mb-4">❤️ Love Calculator ❤️</h1>

    <div class="love-card col-md-6">
        <form id="loveForm">
            <div class="mb-3">
                <label for="yourName" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="yourName" required placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="partnerName" class="form-label">Partner's Name</label>
                <input type="text" class="form-control" id="partnerName" required placeholder="Enter partner's name">
            </div>
            <button type="submit" class="btn btn-danger w-100">Calculate Love ❤️</button>
        </form>

        <div class="result-box" id="resultBox">
            <!-- Result will be shown here -->
        </div>
    </div>
</div>

<!-- Bottom Ad Space -->
<div class="ad-space">
    Your Bottom Ad Here (728x90)
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript -->
<script>
    document.getElementById('loveForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var yourName = document.getElementById('yourName').value.trim();
        var partnerName = document.getElementById('partnerName').value.trim();

        if (yourName === "" || partnerName === "") {
            alert("Please enter both names!");
            return;
        }

        // Random love percentage between 40 and 100
        var loveScore = Math.floor(Math.random() * 60) + 40;

        var resultText = `<strong>${yourName}</strong> ❤️ <strong>${partnerName}</strong><br>Love Score: <span style="font-size: 2rem;">${loveScore}%</span>`;

        document.getElementById('resultBox').innerHTML = resultText;
        document.getElementById('resultBox').style.display = "block";
    });
</script>

</body>
</html>
