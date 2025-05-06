<?php
// Handle duplicate removal
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['text_data']) && !empty($_POST['text_data'])) {
        // If text input is provided
        $input_text = $_POST['text_data'];
        $lines = explode("\n", $input_text); // Split text into lines
        $unique_lines = array_unique($lines); // Remove duplicates
        $result = implode("\n", $unique_lines);
    } elseif (isset($_FILES['file_data']) && $_FILES['file_data']['error'] == 0) {
        // If file is uploaded
        $file_content = file_get_contents($_FILES['file_data']['tmp_name']);
        $lines = explode("\n", $file_content);
        $unique_lines = array_unique($lines);
        $result = implode("\n", $unique_lines);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duplicate Remover Tool</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 60px;
        }
        .advertisement {
            background-color: #f1f1f1;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .result-textarea {
            width: 100%;
            height: 200px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .form-control {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<!-- Advertisement Space (Top) -->
<div class="advertisement">
    <h4>Advertise Here</h4>
    <p>Place your ad here for better reach!</p>
</div>

<div class="container">
    <h2 class="text-center mb-4">Duplicate Remover Tool</h2>

    <!-- Form for Text Input and File Upload -->
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Text Area for Input Data -->
        <div class="mb-3">
            <label for="text_data" class="form-label">Enter Text or List (One entry per line)</label>
            <textarea class="form-control" id="text_data" name="text_data" rows="6"><?php echo isset($input_text) ? htmlspecialchars($input_text) : ''; ?></textarea>
        </div>

        <!-- File Upload -->
        <div class="mb-3">
            <label for="file_data" class="form-label">Or Upload a File</label>
            <input class="form-control" type="file" id="file_data" name="file_data">
        </div>

        <button type="submit" class="btn btn-custom w-100">Remove Duplicates</button>
    </form>

    <!-- Preview Section -->
    <?php if (isset($result)): ?>
    <h3 class="mt-4">Preview Result</h3>
    <textarea class="form-control result-textarea" readonly><?php echo htmlspecialchars($result); ?></textarea>

    <div class="mt-3">
        <button class="btn btn-success" id="copy-btn">Copy Result</button>
        <button class="btn btn-info" id="download-btn">Download Result</button>
    </div>
    <?php endif; ?>
</div>

<!-- Advertisement Space (Bottom) -->
<div class="advertisement">
    <h4>Advertise Here</h4>
    <p>Place your ad here for better reach!</p>
</div>

<!-- JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Copy to clipboard functionality
    $('#copy-btn').click(function () {
        var text = $('textarea.result-textarea').val();
        navigator.clipboard.writeText(text).then(function () {
            alert("Copied to clipboard!");
        });
    });

    // Download result functionality
    $('#download-btn').click(function () {
        var text = $('textarea.result-textarea').val();
        var blob = new Blob([text], { type: 'text/plain' });
        var link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'result.txt';
        link.click();
    });
</script>

</body>
</html>
