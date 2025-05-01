<?php
// Convert PNG to JPG when form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    
    // Check if uploaded file is a PNG
    if ($image['error'] == 0) {
        $img_info = getimagesize($image['tmp_name']);
        if ($img_info['mime'] == 'image/png') {
            // Load PNG
            $png_image = imagecreatefrompng($image['tmp_name']);
            
            // Create a white background for JPG
            $width = imagesx($png_image);
            $height = imagesy($png_image);
            $jpg_image = imagecreatetruecolor($width, $height);

            $white = imagecolorallocate($jpg_image, 255, 255, 255);
            imagefill($jpg_image, 0, 0, $white);

            // Copy PNG onto white background
            imagecopy($jpg_image, $png_image, 0, 0, 0, 0, $width, $height);

            // Save as JPG
            $converted_path = 'uploads/converted_' . pathinfo($image['name'], PATHINFO_FILENAME) . '.jpg';
            imagejpeg($jpg_image, $converted_path, 90); // 90% quality

            imagedestroy($png_image);
            imagedestroy($jpg_image);

            $success = true;
        } else {
            $error = "Please upload a valid PNG image.";
        }
    } else {
        $error = "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PNG to JPG Converter</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            padding-top: 50px;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .preview img {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 20px;
        }
        .btn-upload {
            background-color: #28a745;
            color: white;
        }
        .btn-upload:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">PNG to JPG Converter</h2>

    <?php if (isset($success) && $success): ?>
        <div class="alert alert-success">Image converted successfully!</div>
        <div class="text-center">
            <h5 class="mt-3">Converted JPG Preview</h5>
            <img src="<?php echo $converted_path; ?>" alt="Converted JPG" class="img-fluid mt-2">
            <div class="mt-3">
                <a href="<?php echo $converted_path; ?>" download class="btn btn-success">Download JPG</a>
            </div>
        </div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <label for="image" class="form-label">Select a PNG image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/png" required>
        </div>
        <button type="submit" class="btn btn-upload w-100">Convert to JPG</button>
    </form>

    <!-- Preview Area -->
    <div class="preview text-center" id="preview-container"></div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Preview the uploaded PNG before conversion
    document.getElementById('image').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('preview-container');
        previewContainer.innerHTML = '';

        if (file && file.type === 'image/png') {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                previewContainer.appendChild(imgElement);
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.innerHTML = '<div class="alert alert-warning mt-3">Please select a valid PNG image.</div>';
        }
    });
</script>

</body>
</html>
