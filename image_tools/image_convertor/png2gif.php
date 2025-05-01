<?php
// PNG to GIF conversion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    if ($image['error'] == 0 && exif_imagetype($image['tmp_name']) == IMAGETYPE_PNG) {
        // Upload original PNG
        $uploaded_image_path = 'uploads/' . $image['name'];
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        move_uploaded_file($image['tmp_name'], $uploaded_image_path);

        // Load PNG image
        $source_image = imagecreatefrompng($uploaded_image_path);

        // Save as GIF
        $gif_image_path = 'uploads/converted_' . pathinfo($image['name'], PATHINFO_FILENAME) . '.gif';
        imagegif($source_image, $gif_image_path);

        imagedestroy($source_image);

        $conversion_success = true;
    } else {
        $conversion_error = "Please upload a valid PNG file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PNG to GIF Converter</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
        }
        .preview img {
            max-width: 100%;
            border: 2px dashed #2575fc;
            margin-top: 20px;
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #2575fc;
            color: white;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #6a11cb;
        }
    </style>
</head>
<body>

<div class="container text-center">
    <h2 class="mb-4">PNG to GIF Converter</h2>

    <?php if (isset($conversion_success) && $conversion_success): ?>
        <div class="alert alert-success">Image successfully converted!</div>
        <div class="preview">
            <h5>GIF Preview:</h5>
            <img src="<?php echo $gif_image_path; ?>" alt="Converted GIF">
            <div class="mt-3">
                <a href="<?php echo $gif_image_path; ?>" class="btn btn-success" download>Download GIF</a>
            </div>
        </div>
    <?php elseif (isset($conversion_error)): ?>
        <div class="alert alert-danger"><?php echo $conversion_error; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <input type="file" name="image" id="image" class="form-control" accept="image/png" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Convert to GIF</button>
    </form>

    <div id="livePreview" class="preview"></div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Live Preview before upload
    document.getElementById('image').addEventListener('change', function (e) {
        var reader = new FileReader();
        reader.onload = function (event) {
            var previewContainer = document.getElementById('livePreview');
            previewContainer.innerHTML = '<h5 class="mt-4">PNG Preview:</h5><img src="' + event.target.result + '" alt="PNG Preview">';
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>

</body>
</html>
