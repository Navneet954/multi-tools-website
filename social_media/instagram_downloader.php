<?php
// Instagram Downloader PHP logic
function getInstagramImage($url) {
    $url = trim($url);
    if (empty($url)) return false;

    // Fetch page content
    $html = @file_get_contents($url);
    if (!$html) return false;

    // Extract image URL using regex
    if (preg_match('/"display_url":"([^"]+)"/', $html, $matches)) {
        $imageURL = stripslashes($matches[1]);
        return $imageURL;
    } else {
        return false;
    }
}

// Process the form
$imageLink = '';
if (isset($_POST['url'])) {
    $postURL = $_POST['url'];
    $imageLink = getInstagramImage($postURL);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instagram Photo Downloader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .main-section {
            margin-top: 50px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0,0,0,0.1);
        }
        .download-btn {
            margin-top: 20px;
        }
        .ad-space {
            height: 90px;
            background: #e0e0e0;
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #777;
            font-size: 1.2rem;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- Top Ad Space -->
<div class="container">
    <div class="ad-space">
        Top Ad Space (728x90)
    </div>
</div>

<div class="container main-section">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h2 class="text-center mb-4">Instagram Photo Downloader</h2>
                <form method="POST" action="">
                    <div class="input-group mb-3">
                        <input type="url" class="form-control" name="url" placeholder="Paste Instagram Post URL here..." required>
                        <button class="btn btn-primary" type="submit">Download</button>
                    </div>
                </form>

                <?php if ($imageLink): ?>
                    <div class="text-center">
                        <h5 class="mb-3">Preview:</h5>
                        <img src="<?php echo htmlspecialchars($imageLink); ?>" alt="Instagram Image" class="img-fluid rounded shadow-sm mb-3">
                        <div class="download-btn">
                            <a href="<?php echo htmlspecialchars($imageLink); ?>" download class="btn btn-success">
                                <i class="fas fa-download"></i> Download Image
                            </a>
                        </div>
                    </div>
                <?php elseif (isset($_POST['url'])): ?>
                    <div class="alert alert-danger mt-4 text-center">
                        Unable to fetch image. Make sure the Instagram post is public.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Ad Space -->
<div class="container">
    <div class="ad-space">
        Bottom Ad Space (728x90)
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- FontAwesome for Download Icon -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
