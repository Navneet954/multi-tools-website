<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PX to EM Converter</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 80px;
        }
        .container {
            max-width: 800px;
        }
        .converter-container {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .result-preview {
            margin-top: 20px;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }
        .btn-convert {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-convert:hover {
            background-color: #0056b3;
        }
        .ads-container {
            margin: 20px 0;
            text-align: center;
            background-color: #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .ads-container img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<!-- Top Ad Space -->
<div class="ads-container">
    <h4>Advertisement - Top</h4>
    <img src="https://via.placeholder.com/728x90.png?text=Top+Ad+Space" alt="Top Ad">
</div>

<div class="container">
    <h1 class="text-center mb-4">PX to EM Converter</h1>
    <div class="converter-container">
        <div class="input-group">
            <label for="pxValue" class="form-label">Enter PX Value:</label>
            <input type="number" id="pxValue" class="form-control" placeholder="Enter px value" required>
        </div>
        <div class="input-group">
            <label for="baseFontSize" class="form-label">Enter Base Font Size (in PX):</label>
            <input type="number" id="baseFontSize" class="form-control" value="16" placeholder="Default: 16px" required>
        </div>
        <button class="btn btn-convert w-100" onclick="convertToEM()">Convert</button>

        <!-- Conversion Result Preview -->
        <div id="resultPreview" class="result-preview" style="display: none;">
            <p><strong>Converted EM Value:</strong> <span id="emValue"></span></p>
            <p><strong>Preview:</strong></p>
            <p id="previewText">This is a preview text with the converted EM value applied.</p>
        </div>
    </div>
</div>

<!-- Bottom Ad Space -->
<div class="ads-container">
    <h4>Advertisement - Bottom</h4>
    <img src="https://via.placeholder.com/728x90.png?text=Bottom+Ad+Space" alt="Bottom Ad">
</div>

<!-- Bootstrap JS and Custom Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function convertToEM() {
        var pxValue = document.getElementById('pxValue').value;
        var baseFontSize = document.getElementById('baseFontSize').value;
        
        if (pxValue && baseFontSize) {
            var emValue = (pxValue / baseFontSize).toFixed(2); // Calculate EM value
            document.getElementById('emValue').textContent = emValue + ' em';

            // Show the result preview
            document.getElementById('resultPreview').style.display = 'block';
            document.getElementById('previewText').style.fontSize = emValue + 'em';
        } else {
            alert("Please enter both PX value and base font size.");
        }
    }
</script>

</body>
</html>
