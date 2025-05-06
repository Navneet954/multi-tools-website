<?php
// Basic TikTok Video Downloader using PHP (without API)
// Note: This uses 3rd party no-watermark services. 

function getTikTokDownloadLink($url) {
    $apiUrl = "https://api.tikmate.app/api/lookup?url=" . urlencode($url);
    $response = @file_get_contents($apiUrl);

    if ($response) {
        $json = json_decode($response, true);
        if (isset($json['token']) && isset($json['id'])) {
            $videoLink = "https://tikmate.app/download/" . $json['token'] . "/" . $json['id'] . ".mp4";
            return $videoLink;
        }
    }
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TikTok Video Downloader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 700px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .preview-video {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 20px;
        }
        .ads {
            background: #e9ecef;
            border-radius: 8px;
            text-align: center;
            padding: 15px;
            margin: 20px 0;
            font-size: 1rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<!-- Top Ads Space -->
<div class="ads">
    <strong>Top Ad Space</strong><br>
    (Place your Ad Code here)
</div>

<div class="container">
    <div class="card p-4">
        <h2 class="text-center mb-4 text-primary">🎵 TikTok Video Downloader</h2>
        
        <form method="post" class="mb-3">
            <div class="input-group">
                <input type="url" name="tiktok_url" class="form-control" placeholder="Paste TikTok Video URL here..." required>
                <button class="btn btn-primary" type="submit">Download</button>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['tiktok_url'])) {
            $url = trim($_POST['tiktok_url']);
            $downloadLink = getTikTokDownloadLink($url);

            if ($downloadLink) {
                echo '<h5 class="text-success text-center">Preview:</h5>';
                echo '<video class="preview-video" controls>
                        <source src="'.htmlspecialchars($downloadLink).'" type="video/mp4">
                        Your browser does not support the video tag.
                      </video>';
                echo '<div class="d-grid mt-4">
                        <a href="'.htmlspecialchars($downloadLink).'" class="btn btn-success btn-lg" download>Download Video</a>
                      </div>';
            } else {
                echo '<div class="alert alert-danger mt-3">❌ Unable to fetch the video. Please check the URL!</div>';
            }
        }
        ?>
    </div>
</div>

<!-- Bottom Ads Space -->
<div class="ads">
    <strong>Bottom Ad Space</strong><br>
    (Place your Ad Code here)
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
