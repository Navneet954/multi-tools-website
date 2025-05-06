<?php
if (isset($_POST['generate'])) {
    $text = trim($_POST['text']);
    $hashtags = '';

    if (!empty($text)) {
        // Basic sanitize and generate hashtags
        $words = preg_split('/\s+/', $text);
        $hashtagsArray = array_map(function($word) {
            $cleanWord = preg_replace('/[^A-Za-z0-9]/', '', $word);
            return '#' . strtolower($cleanWord);
        }, $words);

        $hashtags = implode(' ', array_filter($hashtagsArray));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hashtag Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            padding-top: 20px;
        }
        .ad-space {
            background: #e0e0e0;
            height: 100px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            font-size: 1.2rem;
            border-radius: 8px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
        }
        .hashtag-preview {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 1.2rem;
            word-wrap: break-word;
        }
        .btn-generate {
            background: #007bff;
            border: none;
            font-weight: bold;
        }
        .btn-generate:hover {
            background: #0056b3;
        }
        .footer-ad {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Top Ad Space -->
    <div class="ad-space">
        Top Ad Space (728x90)
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h2 class="text-center mb-4">Hashtag Generator</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="text" class="form-label">Enter Text</label>
                        <textarea name="text" id="text" class="form-control" rows="4" placeholder="Enter keywords, sentences, or ideas..."><?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''; ?></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="generate" class="btn btn-generate">Generate Hashtags</button>
                    </div>
                </form>

                <?php if (!empty($hashtags)): ?>
                    <div class="hashtag-preview mt-4" id="previewBox">
                        <?php echo htmlspecialchars($hashtags); ?>
                    </div>

                    <div class="d-grid mt-3">
                        <button class="btn btn-outline-primary" onclick="copyHashtags()">Copy Hashtags</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bottom Ad Space -->
    <div class="ad-space footer-ad">
        Bottom Ad Space (728x90)
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS for Copy to Clipboard -->
<script>
function copyHashtags() {
    var copyText = document.getElementById("previewBox").innerText;
    navigator.clipboard.writeText(copyText).then(function() {
        alert("Hashtags copied to clipboard!");
    }, function(err) {
        alert("Failed to copy hashtags");
    });
}
</script>

</body>
</html>
