<?php
// PHP processing
$hexInput = '';
$binaryOutput = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hexInput = strtoupper(trim($_POST['hexInput'] ?? ''));

    // Validate if it's a proper hexadecimal string
    if (preg_match('/^[0-9A-F]+$/', $hexInput)) {
        $binaryOutput = base_convert($hexInput, 16, 2);
    } else {
        $binaryOutput = "Invalid Hexadecimal Value!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hexadecimal to Binary Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            margin-top: 70px;
        }
        .converter-card {
            background: #fff;
            color: #333;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            transition: 0.3s;
        }
        .converter-card:hover {
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }
        .btn-custom {
            background-color: #6a11cb;
            color: #fff;
            border-radius: 25px;
        }
        .btn-custom:hover {
            background-color: #2575fc;
        }
        .preview-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            min-height: 100px;
            font-weight: bold;
            font-family: 'Courier New', Courier, monospace;
            color: #333;
            overflow-wrap: break-word;
            word-break: break-word;
        }
        .form-label {
            font-weight: 600;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Hex ➔ Binary</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="converter-card mt-5">
                <h2 class="text-center mb-4">Hexadecimal to Binary Converter</h2>
                
                <form method="POST" id="hexForm">
                    <div class="mb-3">
                        <label for="hexInput" class="form-label">Enter Hexadecimal Value:</label>
                        <input type="text" class="form-control" id="hexInput" name="hexInput" placeholder="Example: 1A3F" value="<?php echo htmlspecialchars($hexInput, ENT_QUOTES); ?>" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-custom px-5">Convert</button>
                    </div>
                </form>

                <hr class="my-4">

                <h5 class="text-center mb-3">Binary Output:</h5>
                <div class="preview-box" id="binaryOutput">
                    <?php echo htmlspecialchars($binaryOutput); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Simple Client-side validation -->
<script>
document.getElementById('hexForm').addEventListener('submit', function(e) {
    const input = document.getElementById('hexInput').value.trim();
    const hexPattern = /^[0-9A-Fa-f]+$/;
    if (!hexPattern.test(input)) {
        alert('Please enter a valid hexadecimal value!');
        e.preventDefault();
    }
});
</script>

</body>
</html>
