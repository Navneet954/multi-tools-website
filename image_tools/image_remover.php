<?php
// Background removal code
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        $uploaded_image_path = 'uploads/' . $image['name'];
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }
        move_uploaded_file($image['tmp_name'], $uploaded_image_path);

        $image_type = exif_imagetype($uploaded_image_path);

        if (in_array($image_type, [IMAGETYPE_JPEG, IMAGETYPE_PNG])) {
            if ($image_type == IMAGETYPE_JPEG) {
                $source = imagecreatefromjpeg($uploaded_image_path);
            } else {
                $source = imagecreatefrompng($uploaded_image_path);
            }

            $width = imagesx($source);
            $height = imagesy($source);

            $output = imagecreatetruecolor($width, $height);
            imagesavealpha($output, true);
            $trans_colour = imagecolorallocatealpha($output, 0, 0, 0, 127);
            imagefill($output, 0, 0, $trans_colour);

            // Loop every pixel
            for ($x = 0; $x < $width; $x++) {
                for ($y = 0; $y < $height; $y++) {
                    $rgb = imagecolorat($source, $x, $y);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;

                    // Set threshold (adjust for better results)
                    if ($r > 240 && $g > 240 && $b > 240) {
                        // Light color detected: make transparent
                        imagesetpixel($output, $x, $y, $trans_colour);
                    } else {
                        // Copy original pixel
                        imagesetpixel($output, $x, $y, $rgb);
                    }
                }
            }

            $new_image_path = 'uploads/removed_' . basename($image['name']);
            imagepng($output, $new_image_path);
            imagedestroy($source);
            imagedestroy($output);

            $processed_image = $new_image_path;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Background Remover</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f9fc;
            padding-top: 50px;
        }
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .preview-container img {
            max-width: 100%;
            border: 1px solid #ccc;
            margin-top: 20px;
            background: url('https://www.transparenttextures.com/patterns/white-diamond.png'); /* Checker background */
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Image Background Remover</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Upload Your Image</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
        </div>

        <button class="btn btn-primary w-100" type="submit">Remove Background</button>
    </form>

    <!-- Preview Before Upload -->
    <div id="preview" class="preview-container text-center"></div>

    <!-- Show Result -->
    <?php if (isset($processed_image)): ?>
        <div class="text-center mt-5">
            <h4>Background Removed:</h4>
            <img src="<?php echo $processed_image; ?>" alt="Result Image" class="img-fluid mt-3">
            <br>
            <a href="<?php echo $processed_image; ?>" class="btn btn-success mt-3" download>Download Transparent Image</a>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Image preview
document.getElementById('image').addEventListener('change', function(e){
    const preview = document.getElementById('preview');
    preview.innerHTML = ''; // Clear previous
    const file = e.target.files[0];
    if (file){
        const reader = new FileReader();
        reader.onload = function(event){
            const img = document.createElement('img');
            img.src = event.target.result;
            img.classList.add('img-fluid', 'mt-3');
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>
