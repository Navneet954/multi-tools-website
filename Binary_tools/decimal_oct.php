<?php
$decimalInput = '';
$octalOutput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $decimalInput = $_POST['decimalInput'] ?? '';

    if (is_numeric($decimalInput)) {
        $octalOutput = decoct((int)$decimalInput);
    } else {
        $octalOutput = "Invalid input!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Decimal to Octal Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .converter-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #6e8efb;
            color: white;
            border-radius: 25px;
            padding: 10px 30px;
            transition: 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #5b73d6;
        }
        .output-box {
            background: #f1f3f5;
            padding: 20px;
            border-radius: 10px;
            font-size: 1.2rem;
            text-align: center;
            margin-top: 20px;
        }
        h1 {
            font-weight: bold;
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

<div class="converter-card">
    <h1>Decimal to Octal</h1>
    <form method="POST" id="decimalForm">
        <div class="mb-3">
            <label for="decimalInput" class="form-label">Enter Decimal Number:</label>
            <input type="text" class="form-control" id="decimalInput" name="decimalInput" value="<?php echo htmlspecialchars($decimalInput, ENT_QUOTES); ?>" placeholder="e.g. 123">
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-custom">Convert</button>
        </div>
    </form>

    <?php if (!empty($octalOutput)) : ?>
        <div class="output-box mt-4">
            <strong>Octal Result:</strong><br>
            <?php echo htmlspecialchars($octalOutput); ?>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional JavaScript Validation -->
<script>
document.getElementById('decimalForm').addEventListener('submit', function(e) {
    let decimalInput = document.getElementById('decimalInput').value.trim();
    if (decimalInput === '' || isNaN(decimalInput)) {
        e.preventDefault();
        alert('Please enter a valid decimal number!');
    }
});
</script>

</body>
</html>
