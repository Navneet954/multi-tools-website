<?php
// PHP: Handle POST text if needed (For future plagiarism logic)
$inputText = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputText = $_POST['inputText'] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plagiarism Checker | Multi-Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: #eef2f7;
            font-family: 'Poppins', sans-serif;
            margin-top: 80px;
        }
        .checker-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
            transition: 0.3s ease;
        }
        .checker-card:hover {
            box-shadow: 0px 15px 30px rgba(0,0,0,0.15);
        }
        .btn-custom {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #0056b3, #0086c3);
        }
        .result-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            min-height: 150px;
            white-space: pre-wrap;
            overflow-wrap: break-word;
            border: 1px dashed #ccc;
        }
        .progress {
            height: 20px;
        }
        .progress-bar {
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Multi-Tools</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-5">
            <div class="checker-card">
                <h2 class="text-center mb-4">Plagiarism Checker</h2>

                <form method="POST" id="plagiarismForm">
                    <div class="mb-3">
                        <label for="inputText" class="form-label">Paste Your Text Below:</label>
                        <textarea class="form-control" id="inputText" name="inputText" rows="7" placeholder="Enter or paste your text here..."><?php echo htmlspecialchars($inputText); ?></textarea>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-custom" onclick="checkPlagiarism()">Check Plagiarism</button>
                    </div>
                </form>

                <!-- Progress bar (Fake animation for now) -->
                <div class="progress mt-4" style="display:none;" id="progressSection">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressBar" style="width: 0%;">0%</div>
                </div>

                <!-- Results Section -->
                <div class="result-box" id="resultBox" style="display:none;">
                    <h5>Result:</h5>
                    <p id="plagiarismResultText" class="mt-2"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for fake plagiarism check -->
<script>
function checkPlagiarism() {
    var inputText = document.getElementById('inputText').value.trim();
    var resultBox = document.getElementById('resultBox');
    var resultText = document.getElementById('plagiarismResultText');
    var progressSection = document.getElementById('progressSection');
    var progressBar = document.getElementById('progressBar');

    if (inputText.length === 0) {
        alert('Please paste some text to check.');
        return;
    }

    // Reset
    resultBox.style.display = 'none';
    progressSection.style.display = 'block';
    progressBar.style.width = '0%';
    progressBar.innerText = '0%';

    var progress = 0;
    var interval = setInterval(function() {
        if (progress >= 100) {
            clearInterval(interval);
            progressSection.style.display = 'none';
            resultBox.style.display = 'block';

            // Fake Random Plagiarism percentage
            var randomPercent = Math.floor(Math.random() * 50) + 1;
            resultText.innerHTML = `
                <strong>Originality:</strong> ${100 - randomPercent}% unique<br>
                <strong>Plagiarism:</strong> ${randomPercent}% copied
            `;
        } else {
            progress += 10;
            progressBar.style.width = progress + '%';
            progressBar.innerText = progress + '%';
        }
    }, 200);
}
</script>

</body>
</html>
