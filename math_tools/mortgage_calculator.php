<?php
// ... existing code ...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortgage Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .calculator-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
        }
        .ad-space {
            margin: 20px 0;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            text-align: center;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .btn-primary {
            background-color: #3498db;
            border: none;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-1px);
        }
        #result {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }
        #result h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        #result p {
            margin-bottom: 10px;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="calculator-container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Mortgage Calculator</h1>
                    <form id="mortgageForm">
                        <div class="mb-3">
                            <label for="loanAmount" class="form-label">Loan Amount ($)</label>
                            <input type="number" class="form-control" id="loanAmount" required>
                        </div>
                        <div class="mb-3">
                            <label for="interestRate" class="form-label">Interest Rate (%)</label>
                            <input type="number" step="0.01" class="form-control" id="interestRate" required>
                        </div>
                        <div class="mb-3">
                            <label for="loanTerm" class="form-label">Loan Term (years)</label>
                            <input type="number" class="form-control" id="loanTerm" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Calculate</button>
                    </form>
                    <div id="result" class="mt-4"></div>
                </div>
                <div class="col-md-4">
                    <div class="ad-space">
                        <h5>Advertisement Space 1</h5>
                        <p>Your ad content here</p>
                    </div>
                    <div class="ad-space">
                        <h5>Advertisement Space 2</h5>
                        <p>Your ad content here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('mortgageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const loanAmount = parseFloat(document.getElementById('loanAmount').value);
            const interestRate = parseFloat(document.getElementById('interestRate').value) / 100 / 12;
            const loanTerm = parseFloat(document.getElementById('loanTerm').value) * 12;
            
            const x = Math.pow(1 + interestRate, loanTerm);
            const monthlyPayment = (loanAmount * interestRate * x) / (x - 1);
            
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = `
                <h3>Calculation Result</h3>
                <p>Monthly Payment: $${monthlyPayment.toFixed(2)}</p>
                <p>Total Payment: $${(monthlyPayment * loanTerm).toFixed(2)}</p>
                <p>Total Interest: $${((monthlyPayment * loanTerm) - loanAmount).toFixed(2)}</p>
            `;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>