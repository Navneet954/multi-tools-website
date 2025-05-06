<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get CSS input from the form
    $css_input = $_POST['css_input'];

    // Function to minify CSS
    function minifyCSS($css) {
        // Remove comments and whitespace
        $css = preg_replace('/\s+/', ' ', $css);  // Remove extra spaces
        $css = preg_replace('/\s*([{}|:;,])\s*/', '$1', $css); // Remove space around CSS symbols
        return $css;
    }

    // Minify the CSS input
    $minified_css = minifyCSS($css_input);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Minifier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 50px;
        }

        .section-header {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .ad-space {
            background-color: #e3e3e3;
            height: 100px;
            text-align: center;
            line-height: 100px;
            margin: 20px 0;
        }

        .result-box {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            margin-top: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
            background: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }

        .preview-box {
            margin-top: 30px;
        }

        .output-preview {
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-top: 20px;
        }

        .output-preview .output-preview-content {
            padding: 10px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <!-- Top Ad Space -->
    <div class="ad-space">
        <h5>Advertisement</h5>
        <p>Ad Space</p>
    </div>

    <div class="container">
        <h1 class="section-header">CSS Minifier with Preview</h1>
        <form method="post">
            <div class="mb-3">
                <label for="css_input" class="form-label">Enter Your CSS Code</label>
                <textarea id="css_input" name="css_input" rows="10" class="form-control" placeholder="Paste your CSS here..."><?php echo isset($css_input) ? $css_input : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Minify CSS</button>
        </form>

        <?php if (isset($minified_css)): ?>
        <div class="result-box">
            <h4>Minified CSS Output:</h4>
            <pre><?php echo htmlspecialchars($minified_css); ?></pre>
        </div>

        <div class="preview-box">
            <h4>CSS Preview:</h4>
            <div class="output-preview">
                <div class="output-preview-content" style="<?php echo $minified_css; ?>">
                    <p>This is the preview of your CSS changes.</p>
                    <p>Modify this paragraph to see the effects.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Bottom Ad Space -->
    <div class="ad-space">
        <h5>Advertisement</h5>
        <p>Ad Space</p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
