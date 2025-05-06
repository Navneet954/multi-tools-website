<?php
// This PHP script will handle the JSON formatting

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['jsonInput'])) {
    $jsonInput = $_POST['jsonInput'];
    $formattedJson = json_encode(json_decode($jsonInput), JSON_PRETTY_PRINT);
} else {
    $formattedJson = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Formatter</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 40px;
        }

        .json-preview {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-top: 30px;
            min-height: 200px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .json-input {
            min-height: 150px;
            resize: vertical;
        }

        .heading {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
        }

        .btn-format {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn-format:hover {
            background-color: #0056b3;
        }

        .ads {
            background-color: #ddd;
            text-align: center;
            padding: 20px;
            margin: 20px 0;
            font-size: 1.2rem;
        }

        /* Responsive Layout */
        @media (max-width: 768px) {
            .container {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Top Ads Space -->
    <div class="ads">
        <p>Top Ad Space - Your Ad Here</p>
    </div>

    <div class="container">
        <h1 class="heading text-center">JSON Formatter</h1>

        <!-- JSON Input Form -->
        <form method="POST" action="" class="mb-4">
            <div class="form-group">
                <label for="jsonInput">Enter JSON:</label>
                <textarea name="jsonInput" id="jsonInput" class="form-control json-input" placeholder="Paste your raw JSON here..."></textarea>
            </div>
            <button type="submit" class="btn btn-format mt-3 w-100">Format JSON</button>
        </form>

        <!-- JSON Preview Section -->
        <?php if (!empty($formattedJson)): ?>
            <div class="json-preview">
                <h4>Formatted JSON Preview</h4>
                <pre><?= htmlspecialchars($formattedJson) ?></pre>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bottom Ads Space -->
    <div class="ads">
        <p>Bottom Ad Space - Your Ad Here</p>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
