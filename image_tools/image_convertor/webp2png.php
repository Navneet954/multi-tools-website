<?php
// Handle conversion when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['webp_image'])) {
    $file = $_FILES['webp_image'];

    if ($file['error'] === 0) {
        $source = imagecreatefromwebp($file['tmp_name']);
        if ($source !== false) {
            $outputName = 'converted_' . time() . '.png';
            imagepng($source, $outputName);
            imagedestroy($source);
            $convertedImage = $outputName;
        } else {
            $error = "Invalid WebP image.";
        }
    } else {
        $error = "Error uploading the file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WebP to PNG Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 80px;
        }
        .preview-box {
            border: 2px dashed #0d6efd;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            text-align: center;
            transition: all 0.3s;
        }
        .preview-box:hover {
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .preview-box img {
            max-width: 100%;
            max-height: 300px;
            margin-top: 15px;
            border-radius: 8px;
        }
        .btn-upload {
            background-color: #0d6efd;
            color: white;
        }
        .btn-upload:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>

<div class="container">
    <h1 class="text-center mb-4 text-primary">WebP to PNG Converter</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" enctype="multipart/form-data" id="uploadForm" class="preview-box">
                <label for="webp_image" class="form-label">Select WebP Image</label>
                <input class="form-control" type="file" name="webp_image" id="webp_image" accept=".webp" required>

                <div id="preview" class="mt-3">
                    <p class="text-muted">Preview will appear here</p>
                </div>

                <button type="submit" class="btn btn-upload mt-4 w-100">Convert to PNG</button>
            </form>

            <?php if (isset($convertedImage)): ?>
                <div class="preview-box mt-4">
                    <h5 class="text-success">Converted PNG Image:</h5>
                    <img src="<?= $convertedImage ?>" alt="Converted PNG">
                    <div class="mt-3">
                        <a href="<?= $convertedImage ?>" class="btn btn-success" download>Download PNG</a>
                    </div>
                </div>
            <?php elseif (isset($error)): ?>
                <div class="alert alert-danger mt-4"><?= $error; ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Preview JavaScript -->
<script>
document.getElementById('webp_image').addEventListener('change', function(event) {
    const preview = document.getElementById('preview');
    preview.innerHTML = ''; // Clear previous preview

    const file = event.target.files[0];
    if (file && file.type === 'image/webp') {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgElement = document.createElement('img');
            imgElement.src = e.target.result;
            preview.appendChild(imgElement);
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '<p class="text-danger">Please upload a valid WebP file.</p>';
    }
});
</script>

</body>
</html>
