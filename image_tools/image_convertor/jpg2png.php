<?php
// Check if the form is submitted and the image is uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    // Check if the uploaded image is a JPG file
    if ($image['error'] == 0 && exif_imagetype($image['tmp_name']) == IMAGETYPE_JPEG) {
        // Define the path for the uploaded image and converted PNG image
        $upload_dir = 'uploads/';
        $uploaded_image_path = $upload_dir . basename($image['name']);
        $converted_image_path = $upload_dir . pathinfo($image['name'], PATHINFO_FILENAME) . '.png';

        // Move the uploaded image to the server
        move_uploaded_file($image['tmp_name'], $uploaded_image_path);

        // Convert the JPG image to PNG
        $img = imagecreatefromjpeg($uploaded_image_path);
        imagepng($img, $converted_image_path);
        imagedestroy($img);

        // Store the converted PNG image path to display on the page
        $image_converted_path = $converted_image_path;
    } else {
        $error_message = "Please upload a valid JPG image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JPG to PNG Converter</title>
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
    <h2 class="text-center mb-4">JPG to PNG Converter</h2>
    
    <!-- Error message -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- Form for uploading JPG image -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Choose a JPG image to upload</label>
            <input type="file" name="image" id="image" class="form-control" required accept=".jpg, .jpeg">
        </div>
        <button type="submit" class="btn btn-upload w-100">Convert to PNG</button>
    </form>

    <!-- Image Preview -->
    <?php if (isset($image_converted_path)): ?>
        <div class="preview-container">
            <h4>Converted PNG Image Preview</h4>
            <img src="<?php echo $image_converted_path; ?>" alt="Converted PNG Image">
            <div>
                <a href="<?php echo $image_converted_path; ?>" class="btn btn-success mt-3" download>Download Converted PNG</a>
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
