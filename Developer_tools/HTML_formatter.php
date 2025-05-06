<?php
// PHP part: Format HTML (Basic Formatting)
function format_html($html) {
    // Remove extra whitespace
    $html = preg_replace('/\s+/', ' ', $html);

    // Remove spaces between tags and newlines
    $html = preg_replace('/> </', '><', $html);

    // Apply simple indentation
    $html = preg_replace('/<\/([a-z]+)>/', "\n</$1>", $html);
    $html = preg_replace('/<([a-z]+)>/', "\n<$1>", $html);

    // Return the formatted HTML
    return $html;
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $input_html = $_POST['html_code'];
    $formatted_html = format_html($input_html);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Formatter</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styling */
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .preview-box {
            background-color: #f7f7f7;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            min-height: 200px;
            font-family: 'Courier New', Courier, monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
            margin-top: 20px;
        }
        .preview-title {
            font-size: 1.2rem;
            margin-bottom: 15px;
            font-weight: bold;
        }
        textarea {
            min-height: 200px;
            font-family: 'Courier New', Courier, monospace;
        }
        .output-section {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">HTML Formatter with Preview</h1>

    <form method="POST">
        <div class="form-group">
            <label for="html_code">Enter Your HTML Code</label>
            <textarea id="html_code" name="html_code" class="form-control" rows="10" placeholder="Paste your HTML code here..."><?= isset($input_html) ? htmlspecialchars($input_html) : ''; ?></textarea>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary mt-3">Format HTML</button>
    </form>

    <!-- Formatted HTML Preview -->
    <div class="output-section mt-5">
        <h3 class="preview-title">Formatted HTML Preview</h3>
        <div class="preview-box" id="formatted-preview">
            <?php if (isset($formatted_html)) {
                echo nl2br(htmlspecialchars($formatted_html));
            } ?>
        </div>
    </div>

    <!-- Live HTML Preview -->
    
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Live preview functionality
    document.getElementById('html_code').addEventListener('input', function() {
        const livePreviewBox = document.getElementById('live-preview');
        const userInput = document.getElementById('html_code').value;

        // Show live HTML content
        livePreviewBox.innerHTML = userInput;
    });
</script>
</body>
</html>
