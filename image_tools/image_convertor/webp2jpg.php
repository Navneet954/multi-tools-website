<?php
$converted = false;
$convertedImage = '';

if (isset($_POST['submit']) && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $filename = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if ($fileExt === 'webp') {
        $img = imagecreatefromwebp($fileTmp);
        if ($img) {
            $newFilename = 'converted_' . time() . '.jpg';
            $outputPath = __DIR__ . '/' . $newFilename;
            imagejpeg($img, $outputPath, 100);
            imagedestroy($img);
            $converted = true;
            $convertedImage = $newFilename;
        }
    } else {
        $error = "Please upload a valid .webp image.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WEBP to JPG Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 20px;
        }
        .converter-card {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        .preview-img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
            border-radius: 10px;
        }
        .btn-custom {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 15px;
            border-radius: 10px;
            font-size: 16px;
            transition: background 0.3s;
        }
        .btn-custom:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="converter-card">
    <h2 class="mb-4">WEBP to JPG Converter</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" id="uploadForm">
        <div class="mb-3">
            <input class="form-control" type="file" name="image" id="imageInput" accept=".webp" required>
        </div>
        <button type="submit" name="submit" class="btn btn-custom w-100">Convert to JPG</button>
    </form>

    <!-- Image Preview -->
    <div id="previewContainer" style="display:none;">
        <h5 class="mt-4">Image Preview:</h5>
        <img id="previewImage" class="preview-img" src="#" alt="Preview">
    </div>

    <?php if ($converted): ?>
        <div class="mt-4">
            <h5>Converted Successfully!</h5>
            <a href="<?= htmlspecialchars($convertedImage) ?>" download class="btn btn-success mt-2">Download JPG</a>
            <div class="mt-3">
                <img src="<?= htmlspecialchars($convertedImage) ?>" class="preview-img" alt="Converted Image">
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Preview JavaScript -->
<script>
document.getElementById('imageInput').addEventListener('change', function(event) {
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const file = event.target.files[0];

    if (file && file.type === 'image/webp') {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.style.display = 'block';
            previewImage.src = e.target.result;
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
    }
});
</script>

</body>
</html>
