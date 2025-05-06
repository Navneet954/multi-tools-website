<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REM to PX Converter</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin-top: 80px;
        }

        .container {
            max-width: 800px;
        }

        .converter-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .converter-card h3 {
            color: #007bff;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            font-size: 1.2rem;
            padding: 10px;
        }

        .output {
            font-size: 1.5rem;
            color: #333;
            font-weight: bold;
            margin-top: 20px;
        }

        .ad-space {
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px;
            margin-top: 20px;
        }

        .ad-space p {
            font-size: 1rem;
            margin: 0;
        }

        .preview-box {
            background-color: #007bff;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 1.5rem;
        }

        /* Custom CSS for responsive design */
        @media (max-width: 767px) {
            .converter-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<!-- Advertisement Top -->
<div class="ad-space">
    <p>Advertisement Space - Top</p>
</div>

<!-- Main Content -->
<div class="container">
    <div class="converter-card">
        <h3>REM to PX Converter</h3>
        
        <form id="remToPxForm">
            <div class="mb-3">
                <label for="remInput" class="form-label">Enter REM Value</label>
                <input type="number" class="form-control" id="remInput" placeholder="Enter REM value" required>
            </div>
            <div class="mb-3">
                <label for="baseFontSize" class="form-label">Base Font Size (px)</label>
                <input type="number" class="form-control" id="baseFontSize" value="16" placeholder="Default: 16px" required>
            </div>
            <button type="submit" class="btn btn-primary">Convert</button>
        </form>

        <div class="output mt-4" id="output"></div>

        <!-- Preview box -->
        <div class="preview-box mt-4" id="previewBox">
            Preview: 1rem = 16px
        </div>
    </div>
</div>

<!-- Advertisement Bottom -->
<div class="ad-space mt-5">
    <p>Advertisement Space - Bottom</p>
</div>

<!-- Bootstrap JS and Custom JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // JavaScript to handle the conversion and live preview
    document.getElementById('remToPxForm').addEventListener('submit', function(e) {
        e.preventDefault();

        var remValue = parseFloat(document.getElementById('remInput').value);
        var baseFontSize = parseFloat(document.getElementById('baseFontSize').value);

        if (isNaN(remValue) || isNaN(baseFontSize) || remValue <= 0 || baseFontSize <= 0) {
            alert('Please enter valid numbers for REM and Base Font Size.');
            return;
        }

        var pxValue = remValue * baseFontSize;

        // Displaying the result
        document.getElementById('output').textContent = `${remValue} REM = ${pxValue.toFixed(2)} PX`;

        // Preview Update
        document.getElementById('previewBox').textContent = `Preview: ${remValue}rem = ${pxValue.toFixed(2)}px`;
    });
</script>

</body>
</html>
