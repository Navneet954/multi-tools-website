<?php
$result = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = $_POST['value'] ?? 0;
    $total = $_POST['total'] ?? 0;
    
    if ($total > 0) {
        $percentage = ($value / $total) * 100;
        $result = number_format($percentage, 2) . "%";
    } else {
        $result = "Total must be greater than 0.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Percentage Calculator - Multi-Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .calculator-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            animation: fadeIn 1s ease;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #007bff;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 10px 30px;
            transition: 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .result-box {
            margin-top: 20px;
            background: #f8f9fa;
            border-left: 5px solid #007bff;
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 20px;
            text-align: center;
            color: #333;
            font-weight: bold;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<div class="calculator-card">
    <h2>Percentage Calculator</h2>
    <form method="POST" id="percentageForm">
        <div class="mb-3">
            <label for="value" class="form-label">Value:</label>
            <input type="number" class="form-control" id="value" name="value" placeholder="Enter part value" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total:</label>
            <input type="number" class="form-control" id="total" name="total" placeholder="Enter total value" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-custom">Calculate</button>
        </div>
    </form>

    <?php if (!empty($result)): ?>
        <div class="result-box mt-4">
            Result: <?php echo htmlspecialchars($result); ?>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional: Add instant preview using JS -->
<script>
document.getElementById('percentageForm').addEventListener('input', function() {
    const value = parseFloat(document.getElementById('value').value);
    const total = parseFloat(document.getElementById('total').value);
    const resultBox = document.querySelector('.result-box');

    if (!isNaN(value) && !isNaN(total) && total > 0) {
        const percentage = (value / total) * 100;
        if (!resultBox) return;
        resultBox.innerHTML = "Live Preview: " + percentage.toFixed(2) + "%";
    }
});
</script>

</body>
</html>
