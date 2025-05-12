<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ebook_title = htmlspecialchars($_POST['ebook_title']);
    $ebook_author = htmlspecialchars($_POST['ebook_author']);
    $ebook_content = nl2br(htmlspecialchars($_POST['ebook_content']));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Book Creator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f2f5;
            font-family: 'Arial', sans-serif;
            margin-top: 20px;
        }
        .ad-space {
            background: #e0e0e0;
            height: 90px;
            margin-bottom: 20px;
            text-align: center;
            line-height: 90px;
            font-size: 1.5rem;
            color: #777;
            border-radius: 8px;
        }
        .form-section, .preview-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .preview-content {
            white-space: pre-wrap;
            min-height: 300px;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Top Ad Space -->
    <div class="ad-space mb-4">
        Top Advertisement Space
    </div>

    <h1 class="text-center mb-4">📚 E-Book Creator</h1>

    <div class="row">
        <!-- E-Book Form -->
        <div class="col-md-6">
            <div class="form-section">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">E-Book Title</label>
                        <input type="text" class="form-control" id="ebook_title" name="ebook_title" required oninput="updatePreview()">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Author Name</label>
                        <input type="text" class="form-control" id="ebook_author" name="ebook_author" required oninput="updatePreview()">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" id="ebook_content" name="ebook_content" rows="10" required oninput="updatePreview()"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create E-Book</button>
                </form>
            </div>
        </div>

        <!-- Live Preview -->
        <div class="col-md-6">
            <div class="preview-section">
                <h4 class="text-center mb-3">📖 Live Preview</h4>
                <h2 id="preview_title" class="text-primary text-center"></h2>
                <h5 id="preview_author" class="text-secondary text-center mb-4"></h5>
                <div id="preview_content" class="preview-content"></div>
            </div>
        </div>
    </div>

    <!-- Display created ebook if form submitted -->
    <?php if (!empty($ebook_title)): ?>
    <div class="row">
        <div class="col-12">
            <div class="preview-section">
                <h2 class="text-center text-success">🎉 Your E-Book</h2>
                <h2 class="text-primary text-center"><?= $ebook_title; ?></h2>
                <h5 class="text-secondary text-center mb-4">By <?= $ebook_author; ?></h5>
                <div class="preview-content"><?= $ebook_content; ?></div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Bottom Ad Space -->
    <div class="ad-space mt-5">
        Bottom Advertisement Space
    </div>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
function updatePreview() {
    document.getElementById('preview_title').innerText = document.getElementById('ebook_title').value;
    document.getElementById('preview_author').innerText = document.getElementById('ebook_author').value;
    document.getElementById('preview_content').innerText = document.getElementById('ebook_content').value;
}
</script>

</body>
</html>
