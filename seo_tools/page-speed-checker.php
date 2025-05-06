<?php
// API Key for Google PageSpeed Insights
$apiKey = 'YOUR_GOOGLE_PAGESPEED_API_KEY';
$apiUrl = 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=';

// Initialize variables
$pageSpeedData = null;
$error = '';

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    
    // Validate URL
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $error = 'Please enter a valid URL.';
    } else {
        // Fetch page speed data from Google API
        $response = file_get_contents($apiUrl . urlencode($url) . '&key=' . $apiKey);
        
        if ($response === FALSE) {
            $error = 'Unable to fetch data. Please try again.';
        } else {
            $pageSpeedData = json_decode($response, true);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page Speed Checker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .ad-space {
            min-height: 90px;
            border: 2px dashed #ccc;
            text-align: center;
            padding: 20px;
        }
        .page-speed-result {
            margin-top: 30px;
            border-radius: 8px;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .result-item {
            font-size: 18px;
            font-weight: bold;
        }
        .result-item span {
            font-weight: normal;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Page Speed Checker Tool</h2>

    <!-- Form to submit URL -->
    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <input type="url" name="url" class="form-control" placeholder="Enter Website URL (https://example.com)" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Check Page Speed</button>
    </form>

    <!-- Ad Space (if needed) -->
    <div class="ad-space my-4 bg-light">
        <!-- Ad code goes here -->
        <p>Ad Space</p>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger mt-4">
            <?php echo $error; ?>
        </div>
    <?php elseif ($pageSpeedData): ?>
        <div class="page-speed-result">
            <h4>Page Speed Insights Results</h4>
            <div class="result-item">
                <span>Page Speed Score:</span> 
                <?php echo $pageSpeedData['lighthouseResult']['categories']['performance']['score'] * 100; ?>%
            </div>
            <div class="result-item">
                <span>First Contentful Paint (FCP):</span> 
                <?php echo round($pageSpeedData['lighthouseResult']['audits']['first-contentful-paint']['displayValue'], 2); ?> seconds
            </div>
            <div class="result-item">
                <span>Speed Index:</span> 
                <?php echo round($pageSpeedData['lighthouseResult']['audits']['speed-index']['displayValue'], 2); ?> seconds
            </div>
            <div class="result-item">
                <span>Time to Interactive (TTI):</span> 
                <?php echo round($pageSpeedData['lighthouseResult']['audits']['interactive']['displayValue'], 2); ?> seconds
            </div>
            <div class="result-item">
                <span>Largest Contentful Paint (LCP):</span> 
                <?php echo round($pageSpeedData['lighthouseResult']['audits']['largest-contentful-paint']['displayValue'], 2); ?> seconds
            </div>
            <div class="result-item">
                <span>Cumulative Layout Shift (CLS):</span> 
                <?php echo round($pageSpeedData['lighthouseResult']['audits']['cumulative-layout-shift']['displayValue'], 2); ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
