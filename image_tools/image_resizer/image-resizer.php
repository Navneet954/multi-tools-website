<?php
// Image resizing functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && isset($_POST['width']) && isset($_POST['height']) && isset($_POST['unit'])) {
    $image = $_FILES['image'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $unit = $_POST['unit'];
    
    // Convert units to pixels
    list($original_width, $original_height) = getimagesize($image['tmp_name']);
    
    if ($unit === 'percent') {
        // Convert from percentage to pixels
        $width = ($width / 100) * $original_width;
        $height = ($height / 100) * $original_height;
    } elseif ($unit === 'inches') {
        // Convert inches to pixels (assuming 96 DPI for standard screens)
        $width = $width * 96; 
        $height = $height * 96;
    }
    
    // Check if the image is valid
    if ($image['error'] == 0) {
        $uploaded_image_path = 'uploads/' . $image['name'];
        move_uploaded_file($image['tmp_name'], $uploaded_image_path);
        
        // Load the image
        $image_type = exif_imagetype($uploaded_image_path);
        if ($image_type == IMAGETYPE_JPEG) {
            $source_image = imagecreatefromjpeg($uploaded_image_path);
        } elseif ($image_type == IMAGETYPE_PNG) {
            $source_image = imagecreatefrompng($uploaded_image_path);
        } elseif ($image_type == IMAGETYPE_GIF) {
            $source_image = imagecreatefromgif($uploaded_image_path);
        }
        
        // Resizing the image
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $width, $height, $original_width, $original_height);
        
        // Save the resized image
        $resized_image_path = 'uploads/resized_' . $image['name'];
        imagejpeg($new_image, $resized_image_path);
        imagedestroy($new_image);
        imagedestroy($source_image);
        
        // Redirect to the same page with the new resized image
        $image_resized_path = $resized_image_path;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Resizer Tool</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            padding-top: 50px;
        }
        .container {
            background-color: #ffffff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 8px;
        }
        .preview-container {
            text-align: center;
            margin-top: 20px;
        }
        .preview-container img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .btn-upload {
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
        }
        .btn-upload:hover {
            background-color: #0056b3;
        }
        .alert {
            display: none;
        }
    </style>
</head>
<body>

<div class="container">

    <h2 class="text-center mb-4">Image Resizer Tool</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- File Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Choose an image to upload</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <!-- Width & Height -->
        <div class="mb-3">
            <label for="width" class="form-label">Width</label>
            <input type="number" name="width" id="width" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="height" class="form-label">Height</label>
            <input type="number" name="height" id="height" class="form-control" min="1" required>
        </div>

        <!-- Unit Selection (px, %, Inches) -->
        <div class="mb-3">
            <label for="unit" class="form-label">Select Unit</label>
            <select name="unit" id="unit" class="form-select">
                <option value="percent">%</option>
                <option value="px">px (pixels)</option>
                <option value="inches">Inches</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-upload w-100">Resize Image</button>
    </form>

    <!-- Image Preview -->
    <?php if (isset($image_resized_path)): ?>
        <div class="preview-container">
            <h4>Resized Image Preview</h4>
            <img src="<?php echo $image_resized_path; ?>" alt="Resized Image">
            <div>
                <a href="<?php echo $image_resized_path; ?>" class="btn btn-success mt-3" download>Download Resized Image</a>
            </div>
        </div>
    <?php endif; ?>

</div>

<!-- Bootstrap JS & jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Preview image before submitting form
    document.getElementById('image').addEventListener('change', function (e) {
        var reader = new FileReader();
        reader.onload = function () {
            var preview = document.createElement('img');
            preview.src = reader.result;
            preview.style.maxWidth = '100%';
            preview.style.height = 'auto';
            preview.classList.add('mt-4');
            
            var previewContainer = document.querySelector('.preview-container');
            previewContainer.innerHTML = ''; // Clear any previous preview
            previewContainer.appendChild(preview);
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>

</body>
</html>
