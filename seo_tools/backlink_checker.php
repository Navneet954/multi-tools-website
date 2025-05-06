<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Advanced Backlink Checker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f8;
            color: #333;
        }
        h2 {
            font-weight: 600;
        }
        .ad-space {
            min-height: 90px;
            border: 2px dashed #ccc;
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #888;
            background-color: #fafafa;
        }
        .card-custom {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            transition: 0.3s ease-in-out;
        }
        .card-custom:hover {
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        .list-group-item {
            border: none;
            border-bottom: 1px solid #eee;
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
        .backlink-list a {
            color: #007bff;
            word-break: break-all;
        }
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        body.dark-mode .card-custom {
            background-color: #1f1f1f;
            color: #e0e0e0;
        }
        body.dark-mode .list-group-item {
            background-color: transparent;
            border-bottom: 1px solid #333;
        }
        body.dark-mode .ad-space {
            border: 2px dashed #444;
            background-color: #1f1f1f;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="mb-3">Advanced Backlink Checker</h2>
        <p class="lead">Analyze backlinks, linking domains, and domain rating easily.</p>
        <button onclick="toggleDarkMode()" class="btn btn-outline-dark btn-sm mt-2">Toggle Dark Mode</button>
    </div>

    <form method="POST" class="card p-4 card-custom mb-5">
        <div class="mb-3">
            <input type="url" name="url" class="form-control form-control-lg" placeholder="Enter Website URL (https://example.com)" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 btn-lg">Analyze Now</button>
    </form>

    <!-- Ad space -->
    <div class="ad-space">
        <p>Advertisement Space</p>
    </div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
    
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo "<div class='alert alert-danger'>Invalid URL. Please enter a valid URL.</div>";
    } else {
        echo "<div class='alert alert-info text-center mb-4'>Analyzing backlinks for: <strong>$url</strong></div>";

        $html = @file_get_contents($url);
        if ($html === FALSE) {
            echo "<div class='alert alert-danger'>Failed to fetch website content.</div>";
        } else {
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $links = $dom->getElementsByTagName('a');

            $backlinks = [];
            $domains = [];
            $dofollowCount = 0;
            $nofollowCount = 0;

            foreach ($links as $link) {
                $href = $link->getAttribute('href');
                $rel = strtolower($link->getAttribute('rel'));
                
                if (!empty($href) && (strpos($href, 'http') === 0 || strpos($href, 'https') === 0)) {
                    $host = parse_url($href, PHP_URL_HOST);
                    if ($host && strpos($href, $url) === false) { // External links
                        $backlinks[] = $href;
                        $domains[] = $host;

                        if (strpos($rel, 'nofollow') !== false) {
                            $nofollowCount++;
                        } else {
                            $dofollowCount++;
                        }
                    }
                }
            }

            $totalBacklinks = count($backlinks);
            $uniqueDomains = count(array_unique($domains));

            // Simulated Domain Rating (Fake Calculation)
            $domainRating = min(100, ($uniqueDomains * 2) + ($dofollowCount * 0.5));

            $dofollowPercentage = $totalBacklinks > 0 ? round(($dofollowCount / $totalBacklinks) * 100, 2) : 0;
            $nofollowPercentage = $totalBacklinks > 0 ? round(($nofollowCount / $totalBacklinks) * 100, 2) : 0;

            echo "
            <div class='card card-custom p-4 mb-5'>
                <h4 class='mb-4'>Summary Report</h4>
                <ul class='list-group'>
                    <li class='list-group-item'>Total Backlinks: <strong>$totalBacklinks</strong></li>
                    <li class='list-group-item'>Linking Websites: <strong>$uniqueDomains</strong></li>
                    <li class='list-group-item'>Domain Rating (Estimated): <strong>$domainRating%</strong></li>
                    <li class='list-group-item'>DoFollow Links: <strong>$dofollowCount</strong> ($dofollowPercentage%)</li>
                    <li class='list-group-item'>NoFollow Links: <strong>$nofollowCount</strong> ($nofollowPercentage%)</li>
                </ul>
            </div>";

            if ($totalBacklinks > 0) {
                echo "<div class='card card-custom p-4 mb-5'>";
                echo "<h4 class='mb-4'>Detailed Backlink List</h4>";
                echo "<ul class='list-group backlink-list'>";
                foreach (array_unique($backlinks) as $backlink) {
                    echo "<li class='list-group-item'><a href='$backlink' target='_blank'>$backlink</a></li>";
                }
                echo "</ul></div>";
            } else {
                echo "<div class='alert alert-warning'>No backlinks found.</div>";
            }
        }
    }
}
?>

</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Dark mode toggle -->
<script>
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
}
</script>

</body>
</html>
