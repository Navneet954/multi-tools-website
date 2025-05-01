<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    // Handle the uploaded image and crop
    $image = $_FILES['image'];
    $upload_dir = 'uploads/';
    $uploaded_image_path = $upload_dir . basename($image['name']);

    if (move_uploaded_file($image['tmp_name'], $uploaded_image_path)) {
        // Crop the image using GD or Imagick library (if necessary)
        $cropped_image_path = $upload_dir . 'cropped_' . basename($image['name']);
        // For simplicity, you can save the image directly or process the crop via JavaScript and pass it to PHP
        $image_resized_path = $uploaded_image_path; // Temporarily using the uploaded image path
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Cropper Tool with Free Transform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
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
            max-width: 800px;
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
        .btn-download {
            margin-top: 10px;
            background-color: #28a745;
            color: #fff;
        }
        .btn-download:hover {
            background-color: #218838;
        }
        .upload-drop-zone {
            border: 2px dashed #007bff;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }
        .upload-drop-zone.hover {
            background-color: #f1f1f1;
        }
        .loader {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        .loader img {
            width: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Image Cropper Tool with Free Transform</h2>

    <!-- Image Upload Form -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="upload-drop-zone" id="upload-drop-zone">
            <p>Drag & Drop Image Here or Click to Select File</p>
        </div>
        <input type="file" name="image" id="image" class="form-control" style="display: none;" accept="image/*">
        <div class="mb-3">
            <button type="button" class="btn btn-primary w-100" id="upload-btn">Upload & Crop</button>
        </div>
    </form>

    <!-- Image Cropper Container -->
    <div id="cropper-container" style="display: none;">
        <h3 class="text-center">Crop your image</h3>
        <div class="preview-container">
            <img id="image-preview" src="" alt="Image Preview">
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-success w-100" id="crop-btn">Crop Image</button>
        </div>
    </div>

    <!-- Preview of the cropped image -->
    <div class="preview-container" id="cropped-preview" style="display: none;">
        <h4>Cropped Image Preview</h4>
        <img id="cropped-image" src="" alt="Cropped Image">
        
        <!-- Download button -->
    </div>
    <a href="#" id="download-link" class="btn-download p-3" download>Download Cropped Image</a>

    <!-- Loader -->
    <div class="loader" id="loader">
        <img src="https://i.gifer.com/YCZH.gif" alt="Loading...">
        <p>Processing image...</p>
    </div>
</div>

<!-- Bootstrap JS & jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    let cropper;
    let imagePreview = document.getElementById('image-preview');
    const uploadZone = document.getElementById('upload-drop-zone');
    const fileInput = document.getElementById('image');
    const loader = document.getElementById('loader');

    // Handle image upload via drag and drop or file input
    uploadZone.addEventListener('click', () => {
        fileInput.click();
    });

    uploadZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadZone.classList.add('hover');
    });

    uploadZone.addEventListener('dragleave', () => {
        uploadZone.classList.remove('hover');
    });

    uploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        const file = e.dataTransfer.files[0];
        handleFile(file);
    });

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        handleFile(file);
    });

    function handleFile(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function () {
                imagePreview.src = reader.result;
                document.getElementById('cropper-container').style.display = 'block';

                // Initialize cropper with free transform settings
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(imagePreview, {
                    aspectRatio: NaN,  // No fixed aspect ratio
                    viewMode: 1,  // Restrict cropper to image boundaries
                    autoCropArea: 0.8,
                    movable: true,  // Allow moving of the cropper box
                    scalable: true,  // Allow resizing of the cropper box
                    rotatable: true,  // Allow rotating of the cropper box
                });
            }
            reader.readAsDataURL(file);
        } else {
            alert('Please select a valid image file.');
        }
    }

    // Crop the image when user clicks on the "Crop Image" button
    document.getElementById('crop-btn').addEventListener('click', function () {
        const croppedCanvas = cropper.getCroppedCanvas();
        const croppedImage = croppedCanvas.toDataURL();

        // Display cropped image in preview
        document.getElementById('cropped-preview').style.display = 'block';
        document.getElementById('cropped-image').src = croppedImage;

        // Enable the download button and set the download link
        const downloadLink = document.getElementById('download-link');
        downloadLink.href = croppedImage;

        // Hide cropper container
        document.getElementById('cropper-container').style.display = 'none';
    });

    // Show loader while uploading or processing
    document.getElementById('upload-btn').addEventListener('click', function () {
        loader.style.display = 'block';
        setTimeout(function () {
            loader.style.display = 'none';
            alert('Image uploaded and processed successfully!');
        }, 3000);  // Simulating delay (e.g., server processing)
    });
</script>

</body>
</html>
