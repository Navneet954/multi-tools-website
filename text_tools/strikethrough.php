<?php
// Strikethrough Text Generator - Improved Version
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strikethrough Text Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }
        .main-container {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease;
        }
        .form-control {
            border-radius: 12px;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }
        .preview-box {
            border: 2px dashed #0d6efd;
            border-radius: 15px;
            padding: 20px;
            min-height: 100px;
            font-size: 1.5rem;
            background-color: #f8f9fa;
            color: #333;
            margin-top: 20px;
            word-wrap: break-word;
            transition: all 0.4s ease-in-out;
        }
        .btn-custom {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            margin: 5px;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #6610f2, #0d6efd);
            transform: scale(1.05);
        }
        .ad-space {
            background: #e2e6ea;
            border: 2px dashed #adb5bd;
            text-align: center;
            padding: 15px;
            margin: 20px 0;
            font-size: 1.1rem;
            color: #6c757d;
            border-radius: 10px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- Top Ad Space -->
<div class="ad-space">Your Ad Here (Top Banner)</div>

<div class="container main-container">
    <h1 class="text-center mb-4">🎯 Strikethrough Text Generator</h1>

    <div class="mb-3">
        <label for="inputText" class="form-label">Enter Your Text:</label>
        <textarea class="form-control" id="inputText" rows="4" placeholder="Type your text here..."></textarea>
    </div>

    <div class="text-center">
        <button class="btn btn-custom" onclick="generateStrikethrough()">Generate</button>
        <button class="btn btn-custom" onclick="copyText()">Copy</button>
        <button class="btn btn-custom" onclick="clearText()">Clear</button>
    </div>

    <h3 class="text-center mt-5 mb-3">Preview:</h3>
    <div class="preview-box" id="previewArea">Your strikethrough text will appear here...</div>
</div>

<!-- Bottom Ad Space -->
<div class="ad-space">Your Ad Here (Bottom Banner)</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for functionality -->
<script>
    function generateStrikethrough() {
        const inputText = document.getElementById('inputText').value.trim();
        const preview = document.getElementById('previewArea');

        if (inputText === '') {
            preview.innerHTML = '<span class="text-danger">Please enter some text!</span>';
            return;
        }

        let strikethroughText = '';
        for (let char of inputText) {
            strikethroughText += char + '\u0336'; // Unicode combining long stroke overlay
        }

        preview.style.opacity = 0;
        setTimeout(() => {
            preview.innerText = strikethroughText;
            preview.style.opacity = 1;
        }, 200);
    }

    function copyText() {
        const preview = document.getElementById('previewArea').innerText;
        if (preview.trim() === '' || preview.includes('Please enter')) {
            alert('Nothing to copy!');
            return;
        }
        navigator.clipboard.writeText(preview)
            .then(() => alert('Strikethrough text copied!'))
            .catch(err => alert('Failed to copy text'));
    }

    function clearText() {
        document.getElementById('inputText').value = '';
        document.getElementById('previewArea').innerHTML = 'Your strikethrough text will appear here...';
    }
</script>

</body>
</html>
