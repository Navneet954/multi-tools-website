<?php
// Initialize variables
$thumbnail_url = "";
$error = "";

if (isset($_POST['youtube_url'])) {
    $youtube_url = trim($_POST['youtube_url']);

    // Extract video ID
    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([^\s&]+)/', $youtube_url, $match)) {
        $video_id = $match[1];
        $thumbnail_url = "https://img.youtube.com/vi/$video_id/maxresdefault.jpg";
    } else {
        $error = "Invalid YouTube URL. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YouTube Thumbnail Downloader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Poppins', sans-serif;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background-color: #ff0000;
            color: #fff;
            border: none;
        }
        .btn-custom:hover {
            background-color: #cc0000;
        }
        .thumbnail-preview {
            margin-top: 20px;
            text-align: center;
        }
        .ad-space {
            background: #e0e0e0;
            text-align: center;
            padding: 15px;
            margin-bottom: 20px;
            font-weight: bold;
            border-radius: 10px;
            color: #555;
        }
    </style>
</head>
<body>

<!-- Top Ad Space -->
<div class="container">
    <div class="ad-space">
        <!-- Your Top Advertisement Here -->
        TOP ADVERTISEMENT SPACE
    </div>
</div>

<!-- Main Container -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card p-4">
                <h2 class="text-center mb-4">YouTube Thumbnail Downloader</h2>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" onsubmit="return validateForm();">
                    <div class="mb-3">
                        <label for="youtube_url" class="form-label">Enter YouTube Video URL</label>
                        <input type="text" name="youtube_url" id="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=example" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom btn-lg">Get Thumbnail</button>
                    </div>
                </form>

                <?php if (!empty($thumbnail_url)): ?>
                    <div class="thumbnail-preview">
                        <h4 class="mt-4">Thumbnail Preview</h4>
                        <img src="<?php echo $thumbnail_url; ?>" alt="Thumbnail" class="img-fluid rounded">
                        <div class="mt-3">
                            <a href="<?php echo $thumbnail_url; ?>" download class="btn btn-success btn-lg">Download Thumbnail</a>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>

<!-- Bottom Ad Space -->
<div class="container mt-4">
    <div class="ad-space">
        <!-- Your Bottom Advertisement Here -->
        BOTTOM ADVERTISEMENT SPACE
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript Form Validation -->
<script>
function validateForm() {
    var url = document.getElementById('youtube_url').value;
    if (url.trim() === '') {
        alert('Please enter a YouTube URL.');
        return false;
    }
    return true;
}
</script>

</body>
</html>
