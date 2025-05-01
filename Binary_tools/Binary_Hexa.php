<?php
// PHP Backend Conversion
$binaryInput = '';
$hexadecimalOutput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $binaryInput = trim($_POST['binaryInput'] ?? '');
    
    // Validate Binary Input
    if (preg_match('/^[01]+$/', $binaryInput)) {
        $decimal = bindec($binaryInput); // Convert Binary to Decimal
        $hexadecimalOutput = strtoupper(dechex($decimal)); // Decimal to Hexadecimal
    } else {
        $hexadecimalOutput = 'Invalid Binary Number!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Binary to Hexadecimal Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 80px;
        }
        .converter-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: 0.3s ease;
        }
        .converter-card:hover {
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .btn-custom {
            background-color: #4e73df;
            color: #fff;
            border-radius: 25px;
            transition: 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #2e59d9;
        }
        .result-box {
            background: #e2e6ea;
            padding: 20px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Binary to Hexadecimal</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="converter-card mt-5">
                <h2 class="text-center mb-4">Binary to Hexadecimal Converter</h2>
                <form method="POST" id="converterForm">
                    <div class="mb-3">
                        <label for="binaryInput" class="form-label">Enter Binary Number:</label>
                        <input type="text" class="form-control" id="binaryInput" name="binaryInput" placeholder="e.g., 101011" value="<?php echo htmlspecialchars($binaryInput, ENT_QUOTES); ?>" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom px-5">Convert</button>
                    </div>
                </form>

                <hr class="my-4">

                <!-- Output Section -->
                <h5 class="text-center mb-3">Hexadecimal Output:</h5>
                <div class="result-box" id="hexOutput">
                    <?php echo $hexadecimalOutput ? $hexadecimalOutput : 'Output will appear here...'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Small JavaScript for Validation (Optional Enhancement) -->
<script>
    document.getElementById('converterForm').addEventListener('submit', function(event) {
        const binaryInput = document.getElementById('binaryInput').value.trim();
        const validBinary = /^[01]+$/;

        if (!validBinary.test(binaryInput)) {
            event.preventDefault();
            alert('Please enter a valid binary number (only 0s and 1s).');
        }
    });
</script>

</body>
</html>
