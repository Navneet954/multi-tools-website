<?php
// Handle formatting when form is submitted
$formatted_code = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['php_code'])) {
    $raw_code = trim($_POST['php_code']);

    // Basic formatting: Indent after { and outdent after }
    $lines = explode("\n", $raw_code);
    $formatted_lines = [];
    $indent_level = 0;

    foreach ($lines as $line) {
        $line = trim($line);

        if (preg_match('/^\}/', $line)) {
            $indent_level = max(0, $indent_level - 1);
        }

        $formatted_lines[] = str_repeat("    ", $indent_level) . $line;

        if (preg_match('/\{$/', $line)) {
            $indent_level++;
        }
    }

    $formatted_code = implode("\n", $formatted_lines);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Formatter Tool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
            padding-top: 50px;
        }
        .card {
            border: none;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 15px;
        }
        textarea {
            resize: vertical;
            min-height: 150px;
            font-family: 'Courier New', Courier, monospace;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 25px;
            padding: 10px 25px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .preview-box {
            background: #272c36;
            color: #00ff7f;
            border-radius: 10px;
            padding: 20px;
            overflow-x: auto;
            white-space: pre;
            font-family: 'Courier New', Courier, monospace;
            min-height: 200px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">🚀 PHP Code Formatter</h1>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <form method="POST" onsubmit="return validateForm();">
                    <div class="mb-3">
                        <label for="php_code" class="form-label">Paste your PHP code:</label>
                        <textarea class="form-control" id="php_code" name="php_code" placeholder="Enter your raw PHP code here..."><?php echo isset($_POST['php_code']) ? htmlspecialchars($_POST['php_code']) : ''; ?></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Format Code</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h5 class="text-center mb-3">Formatted Output</h5>
                <div class="preview-box" id="preview"><?php echo htmlspecialchars($formatted_code); ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript Validation -->
<script>
function validateForm() {
    var code = document.getElementById("php_code").value.trim();
    if (code == "") {
        alert("Please paste some PHP code before formatting.");
        return false;
    }
    return true;
}
</script>

</body>
</html>
