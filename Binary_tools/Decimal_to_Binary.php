<?php
// PHP Processing
$decimal = '';
$binary = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $decimal = isset($_POST['decimal']) ? trim($_POST['decimal']) : '';

    if (is_numeric($decimal)) {
        $binary = decbin((int)$decimal);
    } else {
        $binary = 'Invalid input!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Decimal to Binary Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .converter-card {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .converter-card h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #343a40;
        }
        .btn-custom {
            background-color: #2575fc;
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 50px;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #6a11cb;
        }
        .result-box {
            margin-top: 20px;
            background: #f1f3f5;
            padding: 15px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 18px;
            color: #212529;
            word-wrap: break-word;
        }
    </style>
</head>
<body>

<div class="converter-card">
    <h2>Decimal to Binary Converter</h2>
    <form method="POST" id="decimalForm">
        <div class="mb-3">
            <input type="text" class="form-control form-control-lg" name="decimal" id="decimalInput" placeholder="Enter a Decimal Number" value="<?php echo htmlspecialchars($decimal); ?>" required>
        </div>
        <button type="submit" class="btn btn-custom">Convert</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <div class="result-box mt-4" id="binaryResult">
        <?php echo htmlspecialchars($binary); ?>
    </div>
    <?php endif; ?>
</div>

<!-- Bootstrap 5 JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional: JavaScript to auto-focus input -->
<script>
    document.getElementById('decimalInput').focus();
</script>

</body>
</html>
