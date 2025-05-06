<?php
// PHP Handling
$originalPrice = '';
$discountPercentage = '';
$discountAmount = '';
$finalPrice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $originalPrice = $_POST['originalPrice'] ?? 0;
    $discountPercentage = $_POST['discountPercentage'] ?? 0;

    if (is_numeric($originalPrice) && is_numeric($discountPercentage)) {
        $discountAmount = ($originalPrice * $discountPercentage) / 100;
        $finalPrice = $originalPrice - $discountAmount;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discount Calculator - Multi-Tools Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            margin-top: 80px;
        }
        .calculator-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0px 8px 24px rgba(0,0,0,0.1);
            transition: all 0.3s ease-in-out;
        }
        .calculator-card:hover {
            box-shadow: 0px 12px 30px rgba(0,0,0,0.2);
        }
        .btn-custom {
            background: #007bff;
            border: none;
            border-radius: 25px;
            padding: 10px 30px;
            color: #fff;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        .btn-custom:hover {
            background: #0056b3;
        }
        .result-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 500;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Multi-Tools</a>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="calculator-card mt-5">
                <h2 class="text-center mb-4">Discount Calculator</h2>
                <form method="POST" id="discountForm">
                    <div class="mb-3">
                        <label for="originalPrice" class="form-label">Original Price</label>
                        <input type="number" step="0.01" class="form-control" id="originalPrice" name="originalPrice" placeholder="Enter original price" value="<?php echo htmlspecialchars($originalPrice); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="discountPercentage" class="form-label">Discount Percentage (%)</label>
                        <input type="number" step="0.01" class="form-control" id="discountPercentage" name="discountPercentage" placeholder="Enter discount percentage" value="<?php echo htmlspecialchars($discountPercentage); ?>" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Calculate</button>
                    </div>
                </form>

                <!-- PHP Result Preview -->
                <?php if ($finalPrice !== ''): ?>
                    <div class="result-box">
                        <p><strong>Discount Amount:</strong> ₹<?php echo number_format($discountAmount, 2); ?></p>
                        <p><strong>Final Price After Discount:</strong> ₹<?php echo number_format($finalPrice, 2); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Optional JS: Live Calculation (Real Time without submitting form) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const originalPriceInput = document.getElementById('originalPrice');
    const discountPercentageInput = document.getElementById('discountPercentage');
    const form = document.getElementById('discountForm');

    form.addEventListener('input', function() {
        const price = parseFloat(originalPriceInput.value) || 0;
        const discount = parseFloat(discountPercentageInput.value) || 0;
        
        if (price > 0 && discount >= 0) {
            const discountAmt = (price * discount) / 100;
            const finalAmt = price - discountAmt;

            const preview = document.querySelector('.result-box');
            if (preview) {
                preview.innerHTML = `
                    <p><strong>Discount Amount:</strong> ₹${discountAmt.toFixed(2)}</p>
                    <p><strong>Final Price After Discount:</strong> ₹${finalAmt.toFixed(2)}</p>
                `;
            }
        }
    });
});
</script>

</body>
</html>
