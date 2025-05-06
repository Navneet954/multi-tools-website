<?php
$cleanedText = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputText = $_POST['inputText'] ?? '';
    // Remove extra spaces (more than one space) and trim the text
    $cleanedText = preg_replace('/\s+/', ' ', trim($inputText));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove Extra Spaces - Multi-Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 80px;
        }
        .tool-card {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: 0.3s ease;
        }
        .tool-card:hover {
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border-radius: 25px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .preview-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            min-height: 100px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Multi-Tools</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tool-card mt-5">
                <h2 class="text-center mb-4">Remove Extra Spaces</h2>
                <form method="POST" id="spaceForm">
                    <div class="mb-3">
                        <label for="inputText" class="form-label">Enter Your Text:</label>
                        <textarea class="form-control" id="inputText" name="inputText" rows="5" placeholder="Paste your text here..."><?php echo htmlspecialchars($_POST['inputText'] ?? '', ENT_QUOTES); ?></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom px-5">Clean Spaces</button>
                    </div>
                </form>

                <hr class="my-4">

                <h4 class="text-center mb-3">Preview:</h4>
                <div class="preview-box" id="previewBox">
                    <?php echo nl2br(htmlspecialchars($cleanedText)); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS + Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Live Preview JavaScript -->
<script>
document.getElementById('inputText').addEventListener('input', function() {
    let text = this.value;
    let cleaned = text.replace(/\s+/g, ' ').trim();
    document.getElementById('previewBox').innerText = cleaned;
});
</script>

</body>
</html>
