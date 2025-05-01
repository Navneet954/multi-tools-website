<?php
// BMP to PNG Conversion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $uploaded_path = $upload_dir . $image['name'];
        move_uploaded_file($image['tmp_name'], $uploaded_path);

        $image_type = mime_content_type($uploaded_path);

        if ($image_type == 'image/bmp' || pathinfo($uploaded_path, PATHINFO_EXTENSION) == 'bmp') {
            $bmp = imagecreatefrombmp($uploaded_path);
            $new_file_name = pathinfo($uploaded_path, PATHINFO_FILENAME) . '.png';
            $converted_path = $upload_dir . $new_file_name;
            imagepng($bmp, $converted_path);
            imagedestroy($bmp);

            $converted_image_path = $converted_path;
        } else {
            $error = "Please upload a valid BMP image.";
        }
    } else {
        $error = "Failed to upload the image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BMP to PNG Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f1f3f5;
            font-family: 'Poppins', sans-serif;
            padding-top: 50px;
        }
        .converter-box {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        .preview {
            margin-top: 20px;
            text-align: center;
        }
        .preview img {
            max-width: 100%;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 10px;
            background: #fafafa;
        }
        .btn-upload {
            background: #007bff;
            color: #fff;
            font-weight: bold;
        }
        .btn-upload:hover {
            background: #0056b3;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="converter-box">
        <h2 class="text-center mb-4">BMP to PNG Converter</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data" id="uploadForm">
            <div class="mb-3">
                <label for="image" class="form-label">Select BMP Image</label>
                <input class="form-control" type="file" name="image" id="image" accept=".bmp" required>
            </div>
            <button type="submit" class="btn btn-upload w-100">Convert to PNG</button>
        </form>

        <!-- Preview before upload -->
        <div class="preview" id="previewBox" style="display:none;">
            <h5 class="mt-4">Preview:</h5>
            <img id="previewImage" src="" alt="BMP Preview">
        </div>

        <!-- Show converted image -->
        <?php if (isset($converted_image_path)): ?>
            <div class="preview">
                <h5 class="mt-4">Converted PNG Image:</h5>
                <img src="<?php echo $converted_image_path; ?>" alt="Converted PNG">
                <div class="mt-3">
                    <a href="<?php echo $converted_image_path; ?>" class="btn btn-success" download>Download PNG</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Show image preview
    document.getElementById('image').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file && file.type === 'image/bmp') {
            const reader = new FileReader();
            reader.onload = function (event) {
                const previewImage = document.getElementById('previewImage');
                previewImage.src = event.target.result;
                document.getElementById('previewBox').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            alert('Please upload a BMP image only!');
            this.value = '';
            document.getElementById('previewBox').style.display = 'none';
        }
    });
</script>

</body>
</html>
