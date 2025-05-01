<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URL Encoder / Decoder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }
        .card {
            width: 100%;
            max-width: 700px;
            padding: 20px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        textarea {
            resize: none;
        }
        .btn-custom {
            width: 48%;
        }
        .preview-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            min-height: 100px;
            white-space: pre-wrap;
        }
        .title {
            font-weight: bold;
            color: #0072ff;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php
// Initialize variables
$input = '';
$output = '';
$mode = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = trim($_POST['text']);
    $mode = $_POST['mode'];

    if ($mode === 'encode') {
        $output = urlencode($input);
    } elseif ($mode === 'decode') {
        $output = urldecode($input);
    }
}
?>

<div class="card">
    <h2 class="title">URL Encoder / Decoder</h2>
    <form method="post" id="urlForm">
        <div class="mb-3">
            <label for="text" class="form-label">Enter Text or URL</label>
            <textarea class="form-control" id="text" name="text" rows="4" placeholder="Enter your text here..." oninput="livePreview()"><?php echo htmlspecialchars($input); ?></textarea>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <button type="submit" name="mode" value="encode" class="btn btn-primary btn-custom">Encode</button>
            <button type="submit" name="mode" value="decode" class="btn btn-success btn-custom">Decode</button>
        </div>

        <div class="mb-3">
            <label class="form-label">Preview Result</label>
            <div class="preview-box" id="preview"><?php echo htmlspecialchars($output); ?></div>
        </div>
    </form>
</div>

<!-- Bootstrap JS + dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
function livePreview() {
    const text = document.getElementById('text').value;
    const preview = document.getElementById('preview');
    
    preview.innerText = text;
}
</script>

</body>
</html>
