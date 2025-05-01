<?php
// PHP EMI calculation (in case form is submitted)
$loanAmount = $interestRate = $loanTenure = $emi = $totalInterest = $totalPayment = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loanAmount = (float) $_POST['loanAmount'];
    $interestRate = (float) $_POST['interestRate'];
    $loanTenure = (float) $_POST['loanTenure'];

    $monthlyInterest = $interestRate / (12 * 100);
    $emi = ($loanAmount * $monthlyInterest * pow(1 + $monthlyInterest, $loanTenure)) / (pow(1 + $monthlyInterest, $loanTenure) - 1);
    $totalPayment = $emi * $loanTenure;
    $totalInterest = $totalPayment - $loanAmount;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan EMI Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            font-family: 'Poppins', sans-serif;
            padding-top: 70px;
        }
        .calculator-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 30px;
            transition: all 0.3s ease;
        }
        .calculator-card:hover {
            transform: translateY(-5px);
        }
        .form-label {
            font-weight: bold;
        }
        .btn-calculate {
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            padding: 10px 30px;
        }
        .btn-calculate:hover {
            background-color: #0056b3;
        }
        .result-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .result-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Loan EMI Calculator</span>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="calculator-card">
                <h2 class="text-center mb-4">EMI Calculator</h2>

                <form method="POST" id="emiForm">
                    <div class="mb-3">
                        <label for="loanAmount" class="form-label">Loan Amount (₹)</label>
                        <input type="number" class="form-control" id="loanAmount" name="loanAmount" placeholder="e.g., 500000" value="<?php echo htmlspecialchars($loanAmount); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="interestRate" class="form-label">Annual Interest Rate (%)</label>
                        <input type="number" step="0.01" class="form-control" id="interestRate" name="interestRate" placeholder="e.g., 7.5" value="<?php echo htmlspecialchars($interestRate); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="loanTenure" class="form-label">Loan Tenure (Months)</label>
                        <input type="number" class="form-control" id="loanTenure" name="loanTenure" placeholder="e.g., 60" value="<?php echo htmlspecialchars($loanTenure); ?>" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-calculate">Calculate EMI</button>
                    </div>
                </form>

                <!-- Results Section -->
                <div class="result-box mt-4" id="resultBox" <?php if(!$emi) echo 'style="display:none;"'; ?>>
                    <div class="result-title text-center">Loan Details</div>
                    <p><strong>Monthly EMI:</strong> ₹ <span id="emiResult"><?php echo number_format($emi, 2); ?></span></p>
                    <p><strong>Total Interest Payable:</strong> ₹ <span id="totalInterest"><?php echo number_format($totalInterest, 2); ?></span></p>
                    <p><strong>Total Payment (Principal + Interest):</strong> ₹ <span id="totalPayment"><?php echo number_format($totalPayment, 2); ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript EMI Calculation (Live) -->
<script>
    document.getElementById('emiForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let loanAmount = parseFloat(document.getElementById('loanAmount').value);
        let interestRate = parseFloat(document.getElementById('interestRate').value);
        let loanTenure = parseFloat(document.getElementById('loanTenure').value);

        if (loanAmount && interestRate && loanTenure) {
            let monthlyInterest = interestRate / (12 * 100);
            let emi = (loanAmount * monthlyInterest * Math.pow(1 + monthlyInterest, loanTenure)) / (Math.pow(1 + monthlyInterest, loanTenure) - 1);
            let totalPayment = emi * loanTenure;
            let totalInterest = totalPayment - loanAmount;

            document.getElementById('emiResult').textContent = emi.toFixed(2);
            document.getElementById('totalInterest').textContent = totalInterest.toFixed(2);
            document.getElementById('totalPayment').textContent = totalPayment.toFixed(2);
            document.getElementById('resultBox').style.display = 'block';
        }
    });
</script>

</body>
</html>
