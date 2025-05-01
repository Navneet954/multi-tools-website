<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML to Markdown Converter</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }
        .container {
            margin-top: 50px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .converter-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .converter-container textarea {
            width: 100%;
            height: 300px;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }
        .preview-container {
            width: 100%;
            padding: 15px;
            border-radius: 5px;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .preview-container h3 {
            text-align: center;
        }
        .ad-space {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .ad-space p {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Ad Space on Top -->
    <div class="ad-space">
        <p>Advertisement Space - Top</p>
    </div>

    <div class="container">
        <div class="header">
            <h1>HTML to Markdown Converter</h1>
            <p>Convert HTML to Markdown with live preview</p>
        </div>

        <div class="converter-container">
            <!-- HTML Input Section -->
            <div class="col-6">
                <h4>Enter HTML</h4>
                <textarea id="htmlInput" placeholder="Enter HTML here..." oninput="convertToMarkdown()"></textarea>
            </div>

            <!-- Preview Section -->
            <div class="col-5">
                <div class="preview-container">
                    <h3>Markdown Preview</h3>
                    <div id="markdownPreview" style="white-space: pre-wrap;"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- Ad Space on Bottom -->
    <div class="ad-space">
        <p>Advertisement Space - Bottom</p>
    </div>

    <!-- JavaScript to Convert HTML to Markdown -->
    <script>
        function convertToMarkdown() {
            var htmlInput = document.getElementById("htmlInput").value;

            // Use JavaScript to convert HTML to Markdown (Basic Implementation)
            var markdown = htmlInput
                .replace(/<\/h1>/g, '# ').replace(/<h1>/g, '').replace(/\n/g, '\n\n') // Heading 1
                .replace(/<\/h2>/g, '## ').replace(/<h2>/g, '') // Heading 2
                .replace(/<\/h3>/g, '### ').replace(/<h3>/g, '') // Heading 3
                .replace(/<\/p>/g, '\n').replace(/<p>/g, '') // Paragraph
                .replace(/<\/ul>/g, '').replace(/<ul>/g, '').replace(/<\/li>/g, '\n').replace(/<li>/g, '- ') // List items
                .replace(/<\/b>/g, '**').replace(/<b>/g, '') // Bold
                .replace(/<\/i>/g, '_').replace(/<i>/g, '') // Italic
                .replace(/<\/a>/g, '](link)').replace(/<a href="(.*?)">/g, '[ ').replace(/<\/img>/g, ')') // Hyperlink
                .replace(/<\/strong>/g, '**').replace(/<strong>/g, ''); // Strong text

            // Set the converted markdown to preview
            document.getElementById("markdownPreview").innerText = markdown;
        }
    </script>

    <!-- Bootstrap JS (Optional, for Bootstrap features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
