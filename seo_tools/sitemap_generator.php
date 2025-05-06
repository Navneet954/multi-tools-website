<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sitemap Generator Tool</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            transition: background-color 0.3s, color 0.3s;
        }
        .dark-mode {
            background-color: #121212;
            color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        h2 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .ad-space {
            min-height: 90px;
            background-color: #f4f7fa;
            border: 1px dashed #ddd;
            text-align: center;
            line-height: 90px;
            margin-top: 30px;
            color: #777;
        }

        .list-group-item a {
            color: #007bff;
            text-decoration: none;
        }

        .list-group-item a:hover {
            text-decoration: underline;
        }

        .dark-mode .btn-dark {
            background-color: #424242;
            border-color: #666;
        }

        .dark-mode .btn-dark:hover {
            background-color: #333;
        }

        .toggle-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">🗺️ Sitemap Generator</h2>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <input type="url" name="url" class="form-control" placeholder="Enter Website URL (https://example.com)" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Generate Sitemap</button>
    </form>

    <!-- Ad Space -->
    <div class="ad-space my-4">
        <!-- Placeholder for advertisements -->
        <b>Ad Space</b>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $website = filter_var($_POST['url'], FILTER_SANITIZE_URL);

        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            echo "<div class='alert alert-danger mt-4'>Invalid URL entered!</div>";
        } else {
            echo "<div class='alert alert-info mt-4'>Generating sitemap for: <strong>$website</strong></div>";

            $html = @file_get_contents($website);

            if ($html === false) {
                echo "<div class='alert alert-danger mt-3'>Failed to fetch website content.</div>";
            } else {
                // Load HTML into DOM
                $dom = new DOMDocument();
                @$dom->loadHTML($html);
                $links = $dom->getElementsByTagName('a');

                $sitemapUrls = [];

                foreach ($links as $link) {
                    $href = $link->getAttribute('href');
                    if (!empty($href)) {
                        if (strpos($href, 'http') === 0) {
                            $sitemapUrls[] = $href;
                        } elseif ($href[0] == '/') {
                            $sitemapUrls[] = rtrim($website, '/') . $href;
                        }
                    }
                }

                $sitemapUrls = array_unique($sitemapUrls);

                if (count($sitemapUrls) > 0) {
                    echo "<div class='card p-3 mt-4'>";
                    echo "<h5>Sitemap URLs (" . count($sitemapUrls) . ")</h5>";
                    echo "<ul class='list-group mt-3'>";
                    foreach ($sitemapUrls as $url) {
                        echo "<li class='list-group-item'><a href='$url' target='_blank'>$url</a></li>";
                    }
                    echo "</ul>";
                    echo "</div>";

                    // Option to download sitemap
                    $sitemapContent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
                    $sitemapContent .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
                    foreach ($sitemapUrls as $url) {
                        $sitemapContent .= "  <url>\n";
                        $sitemapContent .= "    <loc>$url</loc>\n";
                        $sitemapContent .= "  </url>\n";
                    }
                    $sitemapContent .= "</urlset>";

                    file_put_contents("sitemap.xml", $sitemapContent);

                    echo '<div class="text-center mt-4">';
                    echo '<a href="sitemap.xml" download class="btn btn-custom">Download XML Sitemap</a>';
                    echo '</div>';
                } else {
                    echo "<div class='alert alert-warning mt-4'>No URLs found to generate sitemap!</div>";
                }
            }
        }
    }
    ?>
</div>

<!-- Dark Mode Toggle Button -->
<div class="toggle-btn">
    <button onclick="toggleDarkMode()" class="btn btn-dark btn-sm">🌓 Dark Mode</button>
</div>

<script>
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
    