<?php
$base64String = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $imageFile = $_FILES['image']['tmp_name'];
    $imageData = file_get_contents($imageFile);
    $imageType = mime_content_type($imageFile);
    $base64String = 'data:' . $imageType . ';base64,' . base64_encode($imageData);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image to Base64 Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Arial', sans-serif;
            padding-top: 50px;
        }
        .container {
            max-width: 800px;
        }
        .preview-img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 5px;
            background: #fff;
        }
        .base64-box {
            background: #fff;
            padding: 20px;
            border: 2px dashed #0d6efd;
            border-radius: 10px;
            word-wrap: break-word;
            overflow-x: auto;
            font-family: 'Courier New', Courier, monospace;
            max-height: 400px;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>

<div class="container text-center">
    <h1 class="mb-4 text-primary">Image to Base64 Converter</h1>

    <form method="POST" enctype="multipart/form-data" id="uploadForm" class="mb-4">
        <div class="mb-3">
            <input class="form-control" type="file" name="image" id="imageInput" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Convert to Base64</button>
    </form>

    <div id="previewSection" class="d-none">
        <h4 class="mb-3">Image Preview:</h4>
        <img id="previewImage" class="preview-img" src="#" alt="Image Preview">
    </div>

    <?php if ($base64String): ?>
        <div class="mt-5">
            <h4 class="mb-3">Base64 Output:</h4>
            <div class="base64-box"><?php echo htmlspecialchars($base64String); ?></div>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS for Preview -->
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const previewSection = document.getElementById('previewSection');
        const previewImage = document.getElementById('previewImage');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewSection.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>
