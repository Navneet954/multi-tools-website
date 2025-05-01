<?php
// PHP logic for currency conversion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'] ?? 0;
    $fromCurrency = $_POST['fromCurrency'] ?? 'USD';
    $toCurrency = $_POST['toCurrency'] ?? 'INR';

    // Dummy conversion rates (in real implementation, fetch rates from API)
    $conversionRates = [
        'USD' => 1,
        'INR' => 75.00,
        'EUR' => 0.85,
        'GBP' => 0.75,
        'AUD' => 1.35
    ];

    if ($amount > 0 && isset($conversionRates[$fromCurrency]) && isset($conversionRates[$toCurrency])) {
        $convertedAmount = $amount * ($conversionRates[$toCurrency] / $conversionRates[$fromCurrency]);
    } else {
        $convertedAmount = 0;
    }
} else {
    $convertedAmount = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 80px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background-color: #ffffff;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 1.25rem;
            text-align: center;
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 30px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 25px;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .result-box {
            background: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 1.2rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            Currency Converter
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" required placeholder="Enter amount to convert" value="<?= $amount ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label for="fromCurrency" class="form-label">From Currency</label>
                    <select class="form-select" id="fromCurrency" name="fromCurrency" required>
                        <option value="USD" <?= isset($fromCurrency) && $fromCurrency == 'USD' ? 'selected' : '' ?>>USD</option>
                        <option value="INR" <?= isset($fromCurrency) && $fromCurrency == 'INR' ? 'selected' : '' ?>>INR</option>
                        <option value="EUR" <?= isset($fromCurrency) && $fromCurrency == 'EUR' ? 'selected' : '' ?>>EUR</option>
                        <option value="GBP" <?= isset($fromCurrency) && $fromCurrency == 'GBP' ? 'selected' : '' ?>>GBP</option>
                        <option value="AUD" <?= isset($fromCurrency) && $fromCurrency == 'AUD' ? 'selected' : '' ?>>AUD</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="toCurrency" class="form-label">To Currency</label>
                    <select class="form-select" id="toCurrency" name="toCurrency" required>
                        <option value="USD" <?= isset($toCurrency) && $toCurrency == 'USD' ? 'selected' : '' ?>>USD</option>
                        <option value="INR" <?= isset($toCurrency) && $toCurrency == 'INR' ? 'selected' : '' ?>>INR</option>
                        <option value="EUR" <?= isset($toCurrency) && $toCurrency == 'EUR' ? 'selected' : '' ?>>EUR</option>
                        <option value="GBP" <?= isset($toCurrency) && $toCurrency == 'GBP' ? 'selected' : '' ?>>GBP</option>
                        <option value="AUD" <?= isset($toCurrency) && $toCurrency == 'AUD' ? 'selected' : '' ?>>AUD</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-custom px-5">Convert</button>
                </div>
            </form>

            <?php if ($convertedAmount > 0): ?>
                <div class="result-box">
                    <h5>Converted Amount</h5>
                    <p><?= number_format($convertedAmount, 2) ?> <?= $toCurrency ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
