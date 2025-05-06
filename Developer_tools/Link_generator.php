<?php
// link_generator.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Link Generator</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .ad-space {
            background-color: #e0e0e0;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px 0;
            font-weight: bold;
            color: #555;
            border-radius: 10px;
        }
        .preview-box {
            background-color: #ffffff;
            border: 1px dashed #007bff;
            padding: 20px;
            border-radius: 10px;
            min-height: 100px;
            text-align: center;
            transition: all 0.3s ease-in-out;
        }
        .form-control, .form-select {
            margin-bottom: 15px;
        }
        .generated-code {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
        }
    </style>
</head>
<body>

    <!-- Top Ad Space -->
    <div class="container">
        <div class="ad-space">Top Advertisement</div>
    </div>

    <!-- Main Container -->
    <div class="container my-5">
        <h1 class="text-center mb-4">HTML Link Generator</h1>

        <div class="row">
            <div class="col-md-6">
                <!-- Form -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form id="linkForm">
                            <div class="form-group">
                                <label for="linkText" class="form-label">Link Text</label>
                                <input type="text" id="linkText" class="form-control" placeholder="Enter Link Text" required>
                            </div>
                            <div class="form-group">
                                <label for="linkURL" class="form-label">Link URL</label>
                                <input type="url" id="linkURL" class="form-control" placeholder="https://example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="linkTarget" class="form-label">Open Link In</label>
                                <select id="linkTarget" class="form-select">
                                    <option value="_self">Same Tab</option>
                                    <option value="_blank">New Tab</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="linkColor" class="form-label">Link Color</label>
                                <input type="color" id="linkColor" class="form-control form-control-color" value="#007bff">
                            </div>
                            <div class="form-group">
                                <label for="linkFontSize" class="form-label">Font Size (px)</label>
                                <input type="number" id="linkFontSize" class="form-control" placeholder="Example: 16" min="8" max="72">
                            </div>
                            <button type="button" class="btn btn-primary w-100" onclick="generateLink()">Generate Link</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Preview -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Preview</h5>
                        <div id="preview" class="preview-box my-3">
                            <p>Generated link will appear here...</p>
                        </div>

                        <h5 class="card-title text-center mt-4">Generated HTML Code</h5>
                        <pre id="generatedCode" class="generated-code">&lt;a href="#"&gt;Link&lt;/a&gt;</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Ad Space -->
    <div class="container">
        <div class="ad-space">Bottom Advertisement</div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script -->
    <script>
        function generateLink() {
            var text = document.getElementById('linkText').value.trim();
            var url = document.getElementById('linkURL').value.trim();
            var target = document.getElementById('linkTarget').value;
            var color = document.getElementById('linkColor').value;
            var fontSize = document.getElementById('linkFontSize').value.trim();

            if (!text || !url) {
                alert('Please fill in both Link Text and URL.');
                return;
            }

            var style = "";
            if (color) {
                style += "color:" + color + ";";
            }
            if (fontSize) {
                style += "font-size:" + fontSize + "px;";
            }

            var linkHTML = `<a href="${url}" target="${target}" style="${style}">${text}</a>`;

            document.getElementById('preview').innerHTML = linkHTML;
            document.getElementById('generatedCode').textContent = linkHTML.replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }
    </script>
</body>
</html>
