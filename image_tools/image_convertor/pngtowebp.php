<?php
// Handle conversion after form submission
$webpFilePath = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['png_file'])) {
    $file = $_FILES['png_file'];

    if ($file['error'] === 0 && strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) === 'png') {
        $pngPath = $file['tmp_name'];

        // Create WebP file
        $webpFilePath = 'uploads/' . uniqid('converted_', true) . '.webp';
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        $image = imagecreatefrompng($pngPath);
        if ($image) {
            imagepalettetotruecolor($image); // Better quality
            imagewebp($image, $webpFilePath, 90); // 90% quality
            imagedestroy($image);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PNG to WebP Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background: #f8fafc;
            font-family: 'Poppins', sans-serif;
            padding-top: 50px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }
        .preview-img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
        }
        .btn-custom {
            background-color: #4f46e5;
            color: white;
            border-radius: 8px;
        }
        .btn-custom:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold">PNG to WebP Converter</h1>
        <p class="text-muted">Upload your PNG file and convert it to WebP instantly!</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <form method="POST" enctype="multipart/form-data" id="uploadForm">
                    <div class="mb-3">
                        <label for="pngFile" class="form-label">Choose PNG File</label>
                        <input class="form-control" type="file" id="pngFile" name="png_file" accept="image/png" required>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">Convert to WebP</button>
                </form>

                <!-- Preview Section -->
                <div id="previewSection" class="mt-4" style="display:none;">
                    <h5>Preview:</h5>
                    <img id="pngPreview" class="preview-img" src="#" alt="PNG Preview">
                </div>

                <?php if (!empty($webpFilePath)): ?>
                    <div class="mt-5 text-center">
                        <h5 class="text-success">Converted Successfully!</h5>
                        <p>Here is your WebP Image:</p>
                        <img src="<?php echo htmlspecialchars($webpFilePath); ?>" class="preview-img" alt="WebP Preview">
                        <a href="<?php echo htmlspecialchars($webpFilePath); ?>" class="btn btn-success mt-3" download>Download WebP</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for Image Preview -->
<script>
document.getElementById('pngFile').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file && file.type === 'image/png') {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('previewSection').style.display = 'block';
            document.getElementById('pngPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('previewSection').style.display = 'none';
    }
});
</script>

</body>
</html>
