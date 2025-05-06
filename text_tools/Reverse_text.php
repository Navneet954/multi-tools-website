<?php
$reversedText = "";
if (isset($_POST['text'])) {
    $reversedText = strrev($_POST['text']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reverse Text Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 100px;
            margin-bottom: 50px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        .main-heading {
            font-size: 2.2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 30px;
        }
        .preview-box {
            min-height: 100px;
            background-color: #e9ecef;
            border-radius: 10px;
            padding: 20px;
            font-size: 1.2rem;
            margin-top: 20px;
            white-space: pre-wrap;
        }
        .ad-space {
            background: #fff;
            border: 2px dashed #ccc;
            height: 100px;
            margin: 20px 0;
            text-align: center;
            padding-top: 35px;
            font-size: 1.2rem;
            color: #999;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Top Ad Space -->
    <div class="ad-space">Top Ad Space</div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h1 class="text-center main-heading">Reverse Text Generator</h1>
                <form method="POST" id="reverseForm">
                    <div class="mb-3">
                        <label for="text" class="form-label">Enter Text</label>
                        <textarea class="form-control" id="text" name="text" rows="4" placeholder="Type your text here..." required><?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''; ?></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Reverse Text</button>
                    </div>
                </form>

                <!-- Live Preview -->
                <?php if ($reversedText != ""): ?>
                    <h5 class="mt-4">Reversed Text:</h5>
                    <div class="preview-box" id="preview"><?php echo htmlspecialchars($reversedText); ?></div>
                <?php else: ?>
                    <h5 class="mt-4">Reversed Text Preview:</h5>
                    <div class="preview-box" id="preview">Your reversed text will appear here...</div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- Bottom Ad Space -->
    <div class="ad-space">Bottom Ad Space</div>

</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Live JavaScript Preview -->
<script>
document.getElementById('text').addEventListener('input', function() {
    let text = this.value;
    let reversed = text.split('').reverse().join('');
    document.getElementById('preview').innerText = reversed || 'Your reversed text will appear here...';
});
</script>

</body>
</html>
