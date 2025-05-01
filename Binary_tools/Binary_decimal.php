<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binary to Decimal Converter</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .converter-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
        }
        .btn-custom {
            background: #0072ff;
            color: #fff;
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 18px;
        }
        .btn-custom:hover {
            background: #0056d2;
        }
        h1 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .alert {
            border-radius: 15px;
            font-size: 18px;
        }
    </style>
</head>

<body>

<div class="converter-card">
    <h1 class="text-center mb-4">Binary to Decimal Converter</h1>
    <form id="binaryForm">
        <div class="form-group mb-3">
            <label for="binaryInput" class="form-label">Enter Binary Number:</label>
            <input type="text" class="form-control form-control-lg" id="binaryInput" placeholder="e.g., 1010" required>
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-custom mt-3" onclick="convertToDecimal()">Convert</button>
        </div>
    </form>

    <div id="resultSection" class="mt-4 d-none">
        <h4>Decimal Result:</h4>
        <p id="decimalResult" class="alert alert-info"></p>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function convertToDecimal() {
        const binaryInput = document.getElementById('binaryInput').value.trim();
        const decimalResult = document.getElementById('decimalResult');
        const resultSection = document.getElementById('resultSection');

        // Show the result section
        resultSection.classList.remove('d-none');

        // Validate binary input
        if (!/^[01]+$/.test(binaryInput)) {
            decimalResult.textContent = "⚠️ Please enter a valid binary number (only 0 and 1).";
            decimalResult.classList.remove('alert-info');
            decimalResult.classList.add('alert-danger');
            return;
        }

        // Convert binary to decimal
        const decimalValue = parseInt(binaryInput, 2);
        decimalResult.textContent = `✅ Decimal Value: ${decimalValue}`;
        decimalResult.classList.add('alert-info');
        decimalResult.classList.remove('alert-danger');
    }
</script>

</body>
</html>
