<?php
// Simple function to simulate Domain Authority
function getDomainAuthority($domain) {
    return rand(20, 90); // Random DA between 20 to 90
}

// For loading multiple domains (batch processing)
function processMultipleDomains($domains) {
    $results = [];
    foreach ($domains as $domain) {
        $results[$domain] = getDomainAuthority($domain);
    }
    return $results;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Authority Checker Tool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
        }
        .result-card {
            display: none;
            margin-top: 20px;
        }
        .ad-space {
            min-height: 90px;
            background: #f0f0f0;
            margin-top: 20px;
        }
        .dark-mode {
            background-color: #121212;
            color: #fff;
        }
        .dark-mode .card {
            background-color: #333;
            color: #fff;
        }
        .dark-mode .btn-primary {
            background-color: #007bff;
        }
        .progress-bar {
            transition: width 0.5s ease;
        }
        .loading-indicator {
            display: none;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="text-center mb-4">Domain Authority Checker Tool</h2>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label for="urlInput" class="form-label">Enter Website URL</label>
            <input type="url" name="url" class="form-control" id="urlInput" placeholder="https://example.com" required>
            <small id="urlHelp" class="form-text text-muted">Enter a valid website URL to check the Domain Authority.</small>
        </div>
        <button type="submit" class="btn btn-primary w-100">Check Domain Authority</button>
    </form>

    <div class="loading-indicator text-center mt-3" id="loadingIndicator">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Ad Space -->
    <div class="ad-space my-4 text-center p-3">
        <small>Advertisement Space</small>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
        // Check if URL is valid
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            echo "<div class='alert alert-danger mt-4'>Invalid URL. Please enter a valid URL.</div>";
        } else {
            $domain = parse_url($url, PHP_URL_HOST);
            $domainAuthority = getDomainAuthority($domain); // Get fake DA value
            echo "
                <div class='card result-card mt-4 p-4'>
                    <h5>Domain Authority for <strong>$domain</strong></h5>
                    <div class='progress mt-2'>
                        <div class='progress-bar' role='progressbar' style='width: $domainAuthority%' aria-valuenow='$domainAuthority' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                    <p class='mt-3'>Domain Authority: <strong>$domainAuthority</strong> (Range: 0 - 100)</p>
                    <p>Domain Authority ranges: 
                        <strong>0-20</strong> (Poor), 
                        <strong>20-40</strong> (Average), 
                        <strong>40-60</strong> (Good), 
                        <strong>60-80</strong> (Very Good), 
                        <strong>80-100</strong> (Excellent).
                    </p>
                </div>
            ";
        }
    }
    ?>

    <div class="text-center mt-4">
        <button class="btn btn-sm btn-dark" onclick="toggleDarkMode()">Toggle Dark Mode</button>
    </div>
</div>

<!-- JavaScript to toggle Dark Mode and show/hide loading indicator -->
<script>
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    }

    // Show loading indicator while fetching domain authority
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('loadingIndicator').style.display = 'block';
    });
</script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
