<?php
// BMP to JPG conversion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        $uploaded_image_path = 'uploads/' . $image['name'];
        move_uploaded_file($image['tmp_name'], $uploaded_image_path);

        $image_type = mime_content_type($uploaded_image_path);

        if ($image_type === 'image/bmp' || pathinfo($uploaded_image_path, PATHINFO_EXTENSION) === 'bmp') {
            $bmp_image = imagecreatefrombmp($uploaded_image_path);

            $jpg_filename = 'uploads/' . pathinfo($image['name'], PATHINFO_FILENAME) . '.jpg';
            imagejpeg($bmp_image, $jpg_filename, 100);

            imagedestroy($bmp_image);
            unlink($uploaded_image_path); // Delete original BMP after conversion

            $converted_image_path = $jpg_filename;
        } else {
            $error = "Please upload a valid BMP file.";
            unlink($uploaded_image_path);
        }
    } else {
        $error = "Error uploading file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BMP to JPG Converter</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            padding: 30px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .preview-container img {
            max-width: 100%;
            border: 1px solid #ccc;
            margin-top: 20px;
            border-radius: 8px;
        }
        .btn-upload {
            background-color: #007bff;
            color: #fff;
        }
        .btn-upload:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">BMP to JPG Converter</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Choose BMP Image</label>
            <input type="file" name="image" id="image" accept=".bmp" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-upload w-100">Convert to JPG</button>
    </form>

    <div class="preview-container text-center">
        <h5 id="preview-title" class="mt-4" style="display:none;">BMP Preview</h5>
        <img id="preview-image" style="display:none;" />
    </div>

    <?php if (isset($converted_image_path)): ?>
        <div class="text-center mt-5">
            <h5>Converted JPG</h5>
            <img src="<?php echo $converted_image_path; ?>" alt="Converted JPG" class="img-fluid rounded mb-3">
            <div>
                <a href="<?php echo $converted_image_path; ?>" class="btn btn-success" download>Download JPG</a>
            </div>
        </div>
    <?php endif; ?>

</div>

<!-- Bootstrap & jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Live BMP preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file && file.type === 'image/bmp') {
        const reader = new FileReader();
        reader.onload = function(event) {
            const previewImage = document.getElementById('preview-image');
            previewImage.src = event.target.result;
            previewImage.style.display = 'block';
            document.getElementById('preview-title').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        alert('Please select a BMP file.');
        e.target.value = ''; // Clear the input
    }
});
</script>

</body>
</html>
