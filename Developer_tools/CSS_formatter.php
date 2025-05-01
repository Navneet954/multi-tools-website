<?php
if (isset($_POST['submit'])) {
    $css_code = $_POST['css_code'];
    // Format CSS before displaying
    $formatted_css = formatCSS($css_code);

    // Optionally, you can save or process the CSS here using PHP
    // Example: Save to a file or database
    file_put_contents('formatted.css', $formatted_css);
}

function formatCSS($css_code) {
    // Simple formatting logic to indent CSS
    $css_code = preg_replace('/\s+/', ' ', $css_code); // Remove excess spaces
    $css_code = preg_replace('/\s?{\s?/', ' { ', $css_code); // Space around curly braces
    $css_code = preg_replace('/\s?}\s?/', ' } ', $css_code); // Space around closing curly braces
    $css_code = preg_replace('/\s?;\s?/', '; ', $css_code); // Ensure space after semicolons
    return $css_code;
}

function minifyCSS($css_code) {
    return preg_replace('/\s+/', ' ', $css_code); // Remove excess spaces and minify
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Formatter</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the formatter */
        body {
            font-family: Arial, sans-serif;
            padding-top: 60px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .formatter-textarea {
            width: 100%;
            height: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            font-family: monospace;
            font-size: 14px;
            transition: all 0.3s ease-in-out;
        }
        .btn-formatter {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        .alert {
            margin-top: 10px;
        }
        .card {
            margin-top: 20px;
        }
        .header-icons {
            text-align: right;
        }
        .header-icons i {
            font-size: 24px;
            margin: 0 10px;
            cursor: pointer;
        }
        .header-icons i:hover {
            color: #007bff;
        }
        .download-btn {
            margin-top: 10px;
            background-color: #28a745;
        }
        .save-btn {
            margin-top: 10px;
            background-color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">CSS Formatter</h1>

    <form method="post" action="">
        <!-- CSS Code Textarea -->
        <div class="form-group">
            <label for="css_code">Enter Your CSS Code:</label>
            <textarea id="css_code" class="formatter-textarea" name="css_code" placeholder="Enter your CSS code here"><?php echo isset($css_code) ? $css_code : ''; ?></textarea>
        </div>

        <!-- Format and Minify Button -->
        <button type="submit" name="submit" class="btn btn-primary btn-formatter">Format CSS</button>
        <button type="submit" name="submit" class="btn btn-success btn-formatter">Minify CSS</button>
    </form>

    <!-- Formatted CSS Output -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Formatted CSS Output</h5>
        </div>
        <div class="card-body">
            <textarea class="formatter-textarea" readonly><?php echo isset($formatted_css) ? $formatted_css : ''; ?></textarea>
        </div>
    </div>

    <!-- Success/Message alert -->
    <div id="alertBox" class="alert alert-success mt-3" style="display:none;">
        CSS Formatted Successfully!
    </div>

    <!-- Save and Download Buttons -->
    <form method="post" action="download.php">
        <button type="submit" class="btn download-btn btn-lg" name="download">Download Formatted CSS</button>
    </form>
</div>

<!-- Bootstrap JS & jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for formatting actions -->
<script>
    // Success message after submit
    <?php if (isset($formatted_css)): ?>
        var alertBox = document.getElementById("alertBox");
        alertBox.style.display = "block";
        setTimeout(function() {
            alertBox.style.display = "none";
        }, 2000);
    <?php endif; ?>

    // Option to Minify CSS
    document.querySelector('.btn-success').addEventListener('click', function () {
        var css_code = document.getElementById('css_code').value;
        var minified_css = css_code.replace(/\s+/g, ' ').trim();  // Minify by removing extra spaces
        document.querySelector('textarea[readonly]').value = minified_css;
    });
</script>

</body>
</html>
