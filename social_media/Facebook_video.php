<?php
// Handle video URL and fetch download link
$video_url = '';
$video_download_url = '';
$error = '';

if (isset($_POST['url'])) {
    $video_url = trim($_POST['url']);

    if (filter_var($video_url, FILTER_VALIDATE_URL)) {
        // Extract video link (basic scraping for demonstration purposes)
        $html = file_get_contents($video_url);

        if (preg_match('/"playable_url":"([^"]+)"/', $html, $match)) {
            $video_download_url = stripcslashes($match[1]);
        } else {
            $error = "Unable to fetch video. Please make sure the Facebook post is public.";
        }
    } else {
        $error = "Please enter a valid URL.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facebook Video Downloader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
            padding-top: 30px;
        }
        .container {
            max-width: 700px;
            margin: auto;
        }
        .card {
            border: none;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            border-radius: 15px;
        }
        .ads-space {
            background: #e0e0e0;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            color: #777;
            font-size: 1.2rem;
        }
        .btn-download {
            background-color: #1877f2;
            color: white;
            font-weight: bold;
            border-radius: 30px;
            padding: 10px 30px;
        }
        .btn-download:hover {
            background-color: #165ec9;
        }
        video {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Ads Top -->
    <div class="ads-space">
        [ Your Top Ad Banner Here ]
    </div>

    <div class="card p-4">
        <h2 class="text-center mb-4">Facebook Video Downloader</h2>

        <form method="POST" class="mb-3">
            <div class="input-group">
                <input type="url" name="url" class="form-control" placeholder="Paste Facebook video URL..." required>
                <button type="submit" class="btn btn-download">Download</button>
            </div>
        </form>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($video_download_url)): ?>
            <h5 class="mt-4">Video Preview:</h5>
            <video controls>
                <source src="<?php echo htmlspecialchars($video_download_url); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <a href="<?php echo htmlspecialchars($video_download_url); ?>" download class="btn btn-success w-100 mt-3">Download Video</a>
        <?php endif; ?>

    </div>

    <!-- Ads Bottom -->
    <div class="ads-space mt-4">
        [ Your Bottom Ad Banner Here ]
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
