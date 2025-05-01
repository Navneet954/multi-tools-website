<?php
$minifiedCode = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['js_code'])) {
    $input = $_POST['js_code'];

    // Basic JavaScript Minification
    $minifiedCode = preg_replace('/\/\/[^\n]*\n/', '', $input); // Remove single-line comments
    $minifiedCode = preg_replace('/\/\*.*?\*\//s', '', $minifiedCode); // Remove multi-line comments
    $minifiedCode = preg_replace('/\s+/', ' ', $minifiedCode); // Replace multiple spaces with one
    $minifiedCode = str_replace(["\n", "\r", "\t"], '', $minifiedCode); // Remove line breaks and tabs
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JavaScript Minifier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 60px;
        }
        .main-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .form-control {
            min-height: 150px;
            font-family: monospace;
            resize: vertical;
        }
        .btn-custom {
            background: #007bff;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .btn-custom:hover {
            background: #0056b3;
        }
        .preview-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            font-family: monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
            min-height: 150px;
        }
        footer {
            margin-top: 40px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">JavaScript Minifier</h1>
    <div class="main-container">
        <form method="POST" id="minifyForm">
            <div class="mb-3">
                <label for="js_code" class="form-label">Enter JavaScript Code:</label>
                <textarea class="form-control" id="js_code" name="js_code" placeholder="Paste your JavaScript code here..." required><?php echo isset($_POST['js_code']) ? htmlspecialchars($_POST['js_code']) : ''; ?></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-custom">Minify JavaScript</button>
            </div>
        </form>
    </div>

    <?php if (!empty($minifiedCode)) : ?>
        <div class="main-container mt-5">
            <h4 class="mb-3 text-success">Minified Output:</h4>
            <div class="preview-box" id="previewBox"><?php echo htmlspecialchars($minifiedCode); ?></div>
            <div class="text-end mt-3">
                <button class="btn btn-outline-success btn-sm" onclick="copyMinified()">Copy to Clipboard</button>
            </div>
        </div>
    <?php endif; ?>
</div>

<footer class="mt-5">
    <p>&copy; 2025 JavaScript Minifier Tool</p>
</footer>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Copy to Clipboard Script -->
<script>
function copyMinified() {
    const text = document.getElementById('previewBox').innerText;
    navigator.clipboard.writeText(text)
        .then(() => {
            alert("Minified code copied to clipboard!");
        })
        .catch(err => {
            alert("Failed to copy text: ", err);
        });
}
</script>

</body>
</html>
