<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slug Generator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin-top: 80px;
        }

        .slug-preview {
            font-size: 1.5rem;
            color: #333;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            word-break: break-all;
        }

        .input-container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .input-container input {
            width: 100%;
            font-size: 1.2rem;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .ad-space {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }

        .ad-space p {
            color: #6c757d;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<!-- Ad Space Top -->
<div class="ad-space">
    <p>Advertisement Space (Top)</p>
</div>

<!-- Main Container -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="input-container">
                <h3 class="text-center mb-4">Slug Generator</h3>

                <!-- Input Field -->
                <input type="text" id="inputText" class="form-control" placeholder="Enter text to generate slug" onkeyup="generateSlug()" />
                
                <!-- Preview Area -->
                <div class="mt-3">
                    <label for="slugPreview" class="form-label">Slug Preview:</label>
                    <div id="slugPreview" class="slug-preview">-</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ad Space Bottom -->
<div class="ad-space">
    <p>Advertisement Space (Bottom)</p>
</div>

<!-- Bootstrap and JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Slug Generator JavaScript -->
<script>
    function generateSlug() {
        // Get the input value
        let inputText = document.getElementById("inputText").value;

        // Convert to lowercase
        let slug = inputText.toLowerCase();

        // Replace spaces with hyphens
        slug = slug.replace(/\s+/g, '-');

        // Remove special characters except for hyphens
        slug = slug.replace(/[^\w\-]+/g, '');

        // Remove multiple hyphens
        slug = slug.replace(/\-+/g, '-');

        // Remove leading or trailing hyphens
        slug = slug.replace(/^-+|-+$/g, '');

        // Set the preview text
        document.getElementById("slugPreview").textContent = slug;
    }
</script>

</body>
</html>
