<?php
// JPG to BMP conversion in PHP
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $uploaded_path = $upload_dir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $uploaded_path);

        $img_type = exif_imagetype($uploaded_path);
        if ($img_type == IMAGETYPE_JPEG) {
            $jpg_image = imagecreatefromjpeg($uploaded_path);
            
            // Save as BMP
            $bmp_filename = $upload_dir . pathinfo($image['name'], PATHINFO_FILENAME) . '.bmp';
            imagebmp($jpg_image, $bmp_filename);

            imagedestroy($jpg_image);

            $converted_image_path = $bmp_filename;
        } else {
            $error_message = "Please upload a valid JPG image.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JPG to BMP Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #acb6e5 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        .container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 500px;
        }
        .preview-container img {
            max-width: 100%;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">JPG to BMP Converter</h2>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Choose JPG Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/jpeg" required>
        </div>

        <button type="submit" class="btn btn-custom w-100">Convert to BMP</button>
    </form>

    <div class="preview-container text-center" id="previewContainer">
        <!-- JavaScript preview goes here -->
    </div>

    <?php if (isset($converted_image_path)): ?>
        <div class="text-center mt-4">
            <h5>Download Converted BMP</h5>
            <a href="<?php echo $converted_image_path; ?>" class="btn btn-success" download>Download BMP</a>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap 5 JS + jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Preview selected JPG before uploading
    document.getElementById('image').addEventListener('change', function (e) {
        var previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = '';

        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function (event) {
                var imgElement = document.createElement('img');
                imgElement.src = event.target.result;
                previewContainer.appendChild(imgElement);
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>

</body>
</html>
