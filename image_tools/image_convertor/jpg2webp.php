<?php
// Handle the form submission and convert JPG to WebP
$webp_image = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    if ($file['error'] == 0) {
        $file_type = mime_content_type($file['tmp_name']);
        if (in_array($file_type, ['image/jpeg', 'image/jpg'])) {
            $source = imagecreatefromjpeg($file['tmp_name']);
            $output_path = 'uploads/' . uniqid('image_', true) . '.webp';
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }
            imagewebp($source, $output_path, 80); // Quality 80%
            imagedestroy($source);
            $webp_image = $output_path;
        } else {
            $error = 'Only JPG/JPEG images are allowed!';
        }
    } else {
        $error = 'Error uploading file!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JPG to WebP Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 50px;
        }
        .upload-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }
        .preview-image {
            width: 100%;
            max-height: 300px;
            object-fit: contain;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">JPG to WebP Converter</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="upload-card">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Select JPG Image:</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/jpeg" onchange="previewBeforeUpload(event)" required>
                    </div>

                    <div id="preview-container" class="mb-3" style="display:none;">
                        <label class="form-label">Selected Image Preview:</label>
                        <img id="preview-image" class="preview-image" src="#" alt="Preview">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Convert to WebP</button>
                </form>

                <?php if ($webp_image): ?>
                    <div class="mt-4">
                        <h5>Converted WebP Image:</h5>
                        <img src="<?= htmlspecialchars($webp_image) ?>" alt="WebP Preview" class="preview-image">
                        <a href="<?= htmlspecialchars($webp_image) ?>" download class="btn btn-success w-100 mt-2">Download WebP</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Preview selected image before upload
function previewBeforeUpload(event) {
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    previewContainer.style.display = 'block';
    previewImage.src = URL.createObjectURL(event.target.files[0]);
}
</script>

</body>
</html>
