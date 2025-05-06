<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GST Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .calculator-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .result {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="calculator-container">
            <h2 class="text-center mb-4">GST Calculator</h2>
            <form id="gstForm" method="POST">
                <div class="mb-3">
                    <label for="amount" class="form-label">Original Amount (₹)</label>
                    <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="gstRate" class="form-label">GST Rate (%)</label>
                    <select class="form-select" id="gstRate" name="gstRate">
                        <option value="5">5%</option>
                        <option value="12">12%</option>
                        <option value="18">18%</option>
                        <option value="28">28%</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Calculate GST</button>
            </form>

            <div class="result" id="result">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $amount = floatval($_POST["amount"]);
                    $gstRate = floatval($_POST["gstRate"]);
                    
                    $gstAmount = ($amount * $gstRate) / 100;
                    $totalAmount = $amount + $gstAmount;
                    
                    echo "<h4 class='mb-3'>Calculation Results:</h4>";
                    echo "<p>Original Amount: ₹" . number_format($amount, 2) . "</p>";
                    echo "<p>GST Rate: " . $gstRate . "%</p>";
                    echo "<p>GST Amount: ₹" . number_format($gstAmount, 2) . "</p>";
                    echo "<p>Total Amount: ₹" . number_format($totalAmount, 2) . "</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('gstForm').addEventListener('submit', function(e) {
            const amount = document.getElementById('amount').value;
            if (amount <= 0) {
                e.preventDefault();
                alert('Please enter a valid amount greater than 0');
            }
        });
    </script>
</body>
</html>
