<?php
// PHP processing
$billAmount = 0;
$tipPercentage = 0;
$tipAmount = 0;
$totalAmount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $billAmount = $_POST['billAmount'] ?? 0;
    $tipPercentage = $_POST['tipPercentage'] ?? 0;
    
    // Calculate the tip amount and total amount
    $tipAmount = ($billAmount * $tipPercentage) / 100;
    $totalAmount = $billAmount + $tipAmount;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tip Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .tip-calculator-container {
            margin-top: 100px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
        }

        .tip-calculator-container h2 {
            font-size: 2rem;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
        }

        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border-radius: 30px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .result-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin-top: 30px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        .result-container h4 {
            font-size: 1.25rem;
        }

        .result-container .output {
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>

    <!-- Main Container -->
    <div class="container tip-calculator-container">
        <h2>Tip Calculator</h2>
        <form method="POST" action="" id="tipCalculatorForm">
            <div class="mb-3">
                <label for="billAmount" class="form-label">Bill Amount (in INR)</label>
                <input type="number" class="form-control" id="billAmount" name="billAmount" value="<?= $billAmount ?>" placeholder="Enter bill amount" required>
            </div>
            <div class="mb-3">
                <label for="tipPercentage" class="form-label">Tip Percentage (%)</label>
                <input type="number" class="form-control" id="tipPercentage" name="tipPercentage" value="<?= $tipPercentage ?>" placeholder="Enter tip percentage" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-custom px-5">Calculate Tip</button>
            </div>
        </form>

        <!-- Result Display -->
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            <div class="result-container mt-4">
                <h4>Results</h4>
                <p><strong>Tip Amount:</strong> <span class="output">₹<?= number_format($tipAmount, 2) ?></span></p>
                <p><strong>Total Amount:</strong> <span class="output">₹<?= number_format($totalAmount, 2) ?></span></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and optional JS for interactive features -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to ensure only positive values are entered
        document.getElementById('billAmount').addEventListener('input', function (event) {
            if (event.target.value < 0) {
                event.target.value = 0;
            }
        });

        document.getElementById('tipPercentage').addEventListener('input', function (event) {
            if (event.target.value < 0) {
                event.target.value = 0;
            }
        });
    </script>
</body>

</html>
