<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character Counter with Preview</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin-top: 50px;
        }
        .container {
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .preview-box {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .counter {
            font-weight: bold;
            color: #007bff;
        }
        textarea {
            resize: none;
            width: 100%;
            min-height: 150px;
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>

</head>
<body>
    <div class="container">
        <h2 class="text-center">Character Counter with Live Preview</h2>
        
        <!-- Textarea for input -->
        <div class="mb-4">
            <label for="textInput" class="form-label">Enter Your Text:</label>
            <textarea id="textInput" class="form-control" placeholder="Start typing..."></textarea>
        </div>

        <!-- Character Counter and Preview -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span><span class="counter" id="charCount">0</span> Characters</span>
            <span><span class="counter" id="wordCount">0</span> Words</span>
        </div>

        <!-- Live Preview Box -->
        <div class="preview-box">
            <h5>Live Preview</h5>
            <p id="livePreview">Your text will appear here...</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2025 Your Website. All Rights Reserved.</p>
        </div>
    </div>

    <!-- Bootstrap and JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript to update character count and live preview
        document.getElementById('textInput').addEventListener('input', function() {
            let text = this.value;
            let charCount = text.length;
            let wordCount = text.trim() ? text.trim().split(/\s+/).length : 0;

            // Update character count
            document.getElementById('charCount').textContent = charCount;

            // Update word count
            document.getElementById('wordCount').textContent = wordCount;

            // Update live preview
            document.getElementById('livePreview').textContent = text || "Your text will appear here...";
        });
    </script>

</body>
</html>
