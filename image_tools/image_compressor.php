<?php
// Image compression functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && isset($_POST['quality'])) {
    $image = $_FILES['image'];
    $quality = intval($_POST['quality']); // Quality between 10 - 100

    if ($image['error'] == 0) {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        $uploaded_image_path = 'uploads/' . uniqid() . '_' . $image['name'];
        move_uploaded_file($image['tmp_name'], $uploaded_image_path);

        $image_type = exif_imagetype($uploaded_image_path);

        if ($image_type == IMAGETYPE_JPEG) {
            $source_image = imagecreatefromjpeg($uploaded_image_path);
        } elseif ($image_type == IMAGETYPE_PNG) {
            $source_image = imagecreatefrompng($uploaded_image_path);
        } elseif ($image_type == IMAGETYPE_GIF) {
            $source_image = imagecreatefromgif($uploaded_image_path);
        } else {
            $error = "Unsupported file type!";
        }

        if (!isset($error)) {
            $compressed_image_path = 'uploads/compressed_' . uniqid() . '_' . $image['name'];

            if ($image_type == IMAGETYPE_PNG) {
                imagepng($source_image, $compressed_image_path, floor($quality / 10)); 
            } else {
                imagejpeg($source_image, $compressed_image_path, $quality); 
            }

            imagedestroy($source_image);

            $compressed = $compressed_image_path;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Compressor Tool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f8fa;
            padding-top: 50px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(0,0,0,0.1);
        }
        .preview-container img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            margin-top: 20px;
            border-radius: 5px;
        }
        .btn-compress {
            background-color: #007bff;
            color: white;
        }
        .btn-compress:hover {
            background-color: #0056b3;
        }
        #qualityValue {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Image Compressor Tool</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <!-- File Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Select Image</label>
            <input type="file" name="image" id="image" class="form-control" required accept="image/*">
        </div>

        <!-- Quality Range -->
        <div class="mb-3">
            <label for="quality" class="form-label">Compression Quality: <span id="qualityValue">80</span>%</label>
            <input type="range" name="quality" id="quality" class="form-range" min="10" max="100" value="80" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-compress w-100">Compress Image</button>
    </form>

    <!-- Preview Section -->
    <div class="preview-container text-center">
        <?php if (isset($compressed)): ?>
            <h4 class="mt-4">Compressed Image Preview</h4>
            <img src="<?php echo $compressed; ?>" alt="Compressed Image" class="img-fluid">
            <div>
                <a href="<?php echo $compressed; ?>" class="btn btn-success mt-3" download>Download Compressed Image</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Live update range value
    const qualityInput = document.getElementById('quality');
    const qualityValue = document.getElementById('qualityValue');

    qualityInput.addEventListener('input', function() {
        qualityValue.textContent = this.value;
    });

    // Live preview selected image
    document.getElementById('image').addEventListener('change', function (e) {
        var reader = new FileReader();
        reader.onload = function () {
            let previewContainer = document.querySelector('.preview-container');
            previewContainer.innerHTML = '<h4 class="mt-4">Selected Image Preview</h4>';
            let img = document.createElement('img');
            img.src = reader.result;
            img.className = 'img-fluid';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>

</body>
</html>
