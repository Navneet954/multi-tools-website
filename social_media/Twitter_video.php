<?php
// Function to fetch Twitter video URL
function getTwitterVideoUrl($url) {
    $videoUrl = '';
    $response = @file_get_contents('https://publish.twitter.com/oembed?url=' . urlencode($url));
    if ($response) {
        $data = json_decode($response, true);
        if (isset($data['html'])) {
            preg_match('/src="([^"]+)"/', $data['html'], $matches);
            if (!empty($matches[1])) {
                $iframeUrl = html_entity_decode($matches[1]);
                $iframeContent = @file_get_contents($iframeUrl);
                if ($iframeContent) {
                    preg_match('/video\\s+src="([^"]+)"/', $iframeContent, $videoMatch);
                    if (!empty($videoMatch[1])) {
                        $videoUrl = html_entity_decode($videoMatch[1]);
                    }
                }
            }
        }
    }
    return $videoUrl;
}

// Handle form submission
$videoLink = '';
$error = '';
if (isset($_POST['twitter_url']) && !empty(trim($_POST['twitter_url']))) {
    $inputUrl = trim($_POST['twitter_url']);
    $videoLink = getTwitterVideoUrl($inputUrl);
    if (!$videoLink) {
        $error = "Failed to fetch video. Please make sure the URL is correct.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Twitter Video Downloader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f8fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
        }
        .heading {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1da1f2;
        }
        .ad-space {
            background: #e1e8ed;
            color: #657786;
            text-align: center;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        .form-control {
            height: 50px;
            border-radius: 10px;
        }
        .btn-primary {
            height: 50px;
            border-radius: 10px;
            font-weight: bold;
        }
        .video-preview {
            margin-top: 20px;
            text-align: center;
        }
        footer {
            margin-top: 50px;
            text-align: center;
            color: #657786;
        }
    </style>
</head>
<body>

<!-- Top Ad Space -->
<div class="container mt-4">
    <div class="ad-space">
        Top Ad Space (728x90)
    </div>
</div>

<!-- Main Form -->
<div class="container">
    <div class="main-container">
        <h2 class="text-center heading">Twitter Video Downloader</h2>
        <form method="post" action="">
            <div class="mb-3">
                <input type="url" name="twitter_url" class="form-control" placeholder="Paste Twitter Video URL here..." required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Download</button>
        </form>

        <?php if ($error): ?>
            <div class="alert alert-danger mt-4" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if ($videoLink): ?>
            <div class="video-preview">
                <h5 class="mt-4">Video Preview:</h5>
                <video width="100%" controls>
                    <source src="<?php echo htmlspecialchars($videoLink); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <a href="<?php echo htmlspecialchars($videoLink); ?>" class="btn btn-success mt-3" download>Download Video</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Bottom Ad Space -->
<div class="container mt-4">
    <div class="ad-space">
        Bottom Ad Space (728x90)
    </div>
</div>

<footer class="mt-5 mb-4">
    &copy; <?php echo date('Y'); ?> Twitter Video Downloader. All rights reserved.
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
