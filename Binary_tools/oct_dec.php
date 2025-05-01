<?php
// PHP Processing
$octalInput = '';
$decimalOutput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $octalInput = trim($_POST['octalInput'] ?? '');
    if (preg_match('/^[0-7]+$/', $octalInput)) {
        $decimalOutput = octdec($octalInput);
    } else {
        $decimalOutput = "Invalid Octal Number!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Octal to Decimal Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }
        .converter-card {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            transition: all 0.3s ease;
        }
        .converter-card:hover {
            transform: translateY(-5px);
        }
        .btn-custom {
            background: #4facfe;
            color: #fff;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s ease;
        }
        .btn-custom:hover {
            background: #00f2fe;
            color: #000;
        }
        .result-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            font-size: 20px;
            text-align: center;
            margin-top: 20px;
            word-break: break-word;
        }
    </style>
</head>
<body>

<div class="converter-card text-center">
    <h2 class="mb-4">Octal to Decimal Converter</h2>

    <form method="POST" id="converterForm">
        <div class="mb-3">
            <input type="text" class="form-control form-control-lg" id="octalInput" name="octalInput" placeholder="Enter Octal Number" value="<?php echo htmlspecialchars($octalInput, ENT_QUOTES); ?>" required>
        </div>
        <button type="submit" class="btn btn-custom px-5 py-2">Convert</button>
    </form>

    <?php if ($decimalOutput !== ''): ?>
        <div class="result-box">
            <strong>Decimal Output:</strong><br>
            <?php echo htmlspecialchars($decimalOutput); ?>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript Validation (Optional Extra) -->
<script>
document.getElementById('converterForm').addEventListener('submit', function(e) {
    const octalInput = document.getElementById('octalInput').value.trim();
    if (!/^[0-7]+$/.test(octalInput)) {
        e.preventDefault();
        alert('Please enter a valid Octal Number (digits 0-7 only)');
    }
});
</script>

</body>
</html>
