<?php
// JPG to GIF conversion logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    
    // Validate the uploaded file
    $allowed_types = ['image/jpeg', 'image/jpg'];
    if (in_array($image['type'], $allowed_types) && $image['error'] == 0) {
        
        $upload_folder = 'uploads/';
        if (!file_exists($upload_folder)) {
            mkdir($upload_folder, 0777, true);
        }

        $original_path = $upload_folder . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $original_path);

        // Load the JPEG image
        $source_image = imagecreatefromjpeg($original_path);

        // Generate new file name
        $gif_filename = $upload_folder . pathinfo($image['name'], PATHINFO_FILENAME) . '_converted.gif';
        
        // Save as GIF
        imagegif($source_image, $gif_filename);

        // Free memory
        imagedestroy($source_image);

        $converted_image_path = $gif_filename;
    } else {
        $error = "Please upload a valid JPG image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JPG to GIF Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #eef2f7;
            padding-top: 50px;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
        }
        .preview img {
            max-width: 100%;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 25px;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container col-md-6 offset-md-3">
    <h2 class="text-center mb-4">JPG to GIF Converter</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Upload JPG Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/jpeg" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Convert to GIF</button>
    </form>

    <div class="preview text-center">
        <div id="originalPreview"></div>

        <?php if (isset($converted_image_path)): ?>
            <h4 class="mt-4">Converted GIF Preview</h4>
            <img src="<?php echo $converted_image_path; ?>" alt="Converted GIF">
            <div class="mt-3">
                <a href="<?php echo $converted_image_path; ?>" class="btn btn-success" download>Download GIF</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Preview Script -->
<script>
    document.getElementById('image').addEventListener('change', function(e){
        const previewContainer = document.getElementById('originalPreview');
        previewContainer.innerHTML = '';

        const file = e.target.files[0];
        if(file && file.type.startsWith('image/')){
            const reader = new FileReader();
            reader.onload = function(event){
                const img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxWidth = '100%';
                img.classList.add('mt-3');
                previewContainer.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>
