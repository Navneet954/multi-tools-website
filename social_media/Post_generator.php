<?php
// Save this as post_generator.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Social Media Post Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .post-preview {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            background: white;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .post-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .post-content {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .post-image {
            max-width: 100%;
            height: auto;
            margin-top: 15px;
            border-radius: 10px;
        }
        .ads-space {
            background: #e9ecef;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container py-4">

    <!-- Top Ad Space -->
    <div class="ads-space">
        Your Ad Banner Here (Top)
    </div>

    <h2 class="text-center mb-4">Social Media Post Generator</h2>

    <form id="postForm" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control" id="title" placeholder="Enter your post title">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Post Content</label>
            <textarea class="form-control" id="content" rows="4" placeholder="Write something..."></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" accept="image/*">
        </div>
        <button type="button" class="btn btn-primary w-100" onclick="generatePost()">Generate Post</button>
    </form>

    <!-- Preview Section -->
    <div id="preview" class="post-preview d-none">
        <div class="post-title" id="previewTitle"></div>
        <div class="post-content" id="previewContent"></div>
        <img id="previewImage" class="post-image d-none" alt="Uploaded Image">
    </div>

    <!-- Bottom Ad Space -->
    <div class="ads-space mt-4">
        Your Ad Banner Here (Bottom)
    </div>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function generatePost() {
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');
        const previewTitle = document.getElementById('previewTitle');
        const previewContent = document.getElementById('previewContent');
        const previewImage = document.getElementById('previewImage');

        if (!title && !content && !imageInput.files.length) {
            alert('Please add some content!');
            return;
        }

        previewTitle.textContent = title;
        previewContent.textContent = content;

        if (imageInput.files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('d-none');
            }
            reader.readAsDataURL(imageInput.files[0]);
        } else {
            previewImage.classList.add('d-none');
        }

        preview.classList.remove('d-none');
        preview.scrollIntoView({ behavior: 'smooth' });
    }
</script>

</body>
</html>
