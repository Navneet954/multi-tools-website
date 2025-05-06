<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SEO Tools - Meta Tag Analyzer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Styles */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .ad-space {
            min-height: 90px;
        }

        .tool-item .card {
            transition: transform 0.3s ease;
        }

        .tool-item .card:hover {
            transform: translateY(-10px);
        }

        /* Dark mode (optional) */
        body.dark-mode {
            background: #121212;
            color: #f0f0f0;
        }

        .loading {
            display: none;
        }

        .loading.show {
            display: block;
        }
    </style>
</head>
<body>
  <div class="container my-5">
    <h2 class="text-center">Meta Tag Analyzer</h2>

    <form method="POST" class="mt-4">
      <input type="url" name="url" class="form-control mb-3" placeholder="Enter Website URL" required>
      <button type="submit" class="btn btn-success w-100">Analyze</button>
    </form>

    <div class="loading text-center my-4">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <p>Analyzing the URL...</p>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            echo "<div class='alert alert-info mt-4'>Analyzing meta tags for: <strong>$url</strong></div>";

            // Function to get meta tags using cURL
            $metaTags = get_meta_tags($url);

            // Displaying the meta tags
            if ($metaTags) {
                echo "<div class='mt-4'>";
                echo "<h5>Meta Tags:</h5>";
                echo "<ul class='list-group'>";
                foreach ($metaTags as $name => $content) {
                    echo "<li class='list-group-item'><strong>$name</strong>: $content</li>";
                }
                echo "</ul></div>";
            } else {
                echo "<div class='alert alert-warning mt-4'>No meta tags found or unable to retrieve.</div>";
            }
        } else {
            echo "<div class='alert alert-danger mt-4'>Please enter a valid URL.</div>";
        }
    }
    ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Show loading spinner on form submission
    $('form').on('submit', function () {
      $('.loading').addClass('show');
    });
  </script>
</body>
</html>
