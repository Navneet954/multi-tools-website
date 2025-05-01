<?php
// Handle image upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    if ($_FILES['image']['error'] == 0) {
        $uploaded_image_path = 'uploads/' . basename($_FILES['image']['name']);
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_image_path);
        $uploaded_image = $uploaded_image_path;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Filters Tool with Download</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .image-preview {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        .filters label {
            font-weight: 600;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Apply Filters to Your Image</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="mb-4">
        <div class="mb-3">
            <label for="image" class="form-label">Choose an Image</label>
            <input class="form-control" type="file" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Upload & Preview</button>
    </form>

    <?php if (isset($uploaded_image)): ?>
        <div class="text-center">
            <h4 class="mb-3">Preview, Adjust & Download</h4>
            <img id="previewImage" src="<?php echo $uploaded_image; ?>" class="image-preview">

            <!-- Hidden Canvas -->
            <canvas id="canvas" style="display:none;"></canvas>

            <!-- Filter Controls -->
            <div class="filters mt-4">
                <div class="mb-3">
                    <label for="grayscale">Grayscale</label>
                    <input type="range" min="0" max="100" value="0" id="grayscale" class="form-range">
                </div>
                <div class="mb-3">
                    <label for="sepia">Sepia</label>
                    <input type="range" min="0" max="100" value="0" id="sepia" class="form-range">
                </div>
                <div class="mb-3">
                    <label for="blur">Blur</label>
                    <input type="range" min="0" max="10" value="0" step="0.1" id="blur" class="form-range">
                </div>
                <div class="mb-3">
                    <label for="brightness">Brightness</label>
                    <input type="range" min="50" max="150" value="100" id="brightness" class="form-range">
                </div>
                <div class="mb-3">
                    <label for="contrast">Contrast</label>
                    <input type="range" min="50" max="150" value="100" id="contrast" class="form-range">
                </div>
                <div class="mb-3">
                    <label for="invert">Invert</label>
                    <input type="range" min="0" max="100" value="0" id="invert" class="form-range">
                </div>
            </div>

            <button id="downloadBtn" class="btn btn-success mt-4">Download Filtered Image</button>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const grayscale = document.getElementById('grayscale');
    const sepia = document.getElementById('sepia');
    const blur = document.getElementById('blur');
    const brightness = document.getElementById('brightness');
    const contrast = document.getElementById('contrast');
    const invert = document.getElementById('invert');
    const previewImage = document.getElementById('previewImage');
    const canvas = document.getElementById('canvas');
    const downloadBtn = document.getElementById('downloadBtn');

    function applyFilters() {
        previewImage.style.filter = `
            grayscale(${grayscale.value}%)
            sepia(${sepia.value}%)
            blur(${blur.value}px)
            brightness(${brightness.value}%)
            contrast(${contrast.value}%)
            invert(${invert.value}%)
        `;
    }

    [grayscale, sepia, blur, brightness, contrast, invert].forEach(filter => {
        filter.addEventListener('input', applyFilters);
    });

    downloadBtn.addEventListener('click', function () {
        const ctx = canvas.getContext('2d');
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.src = previewImage.src;

        img.onload = function() {
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.filter = `
                grayscale(${grayscale.value}%)
                sepia(${sepia.value}%)
                blur(${blur.value}px)
                brightness(${brightness.value}%)
                contrast(${contrast.value}%)
                invert(${invert.value}%)
            `;
            ctx.drawImage(img, 0, 0, img.width, img.height);

            const link = document.createElement('a');
            link.download = 'filtered-image.png';
            link.href = canvas.toDataURL();
            link.click();
        }
    });
</script>

</body>
</html>
