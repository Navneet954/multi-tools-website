<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Counter Tool</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            padding: 40px 0;
        }
        
        .container {
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            margin-top: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        .btn-count {
            background-color: #007bff;
            color: #fff;
        }

        .btn-count:hover {
            background-color: #0056b3;
        }

        .preview {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            min-height: 150px;
            background-color: #f1f1f1;
            font-size: 16px;
            word-wrap: break-word;
        }

        .word-count {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Word Counter Tool</h1>
        <p class="text-center text-muted">Type or paste your text below to count words and characters.</p>

        <!-- Text Area for Input -->
        <div class="mb-4">
            <label for="inputText" class="form-label">Enter Text</label>
            <textarea id="inputText" class="form-control" rows="6" placeholder="Type or paste your text here..."></textarea>
        </div>

        <!-- Button to Count Words -->
        <div class="d-flex justify-content-center">
            <button id="countWordsBtn" class="btn btn-count">Count Words</button>
        </div>

        <!-- Word Count Result -->
        <div class="card mt-4">
            <div class="card-header">
                Word Count Result
            </div>
            <div class="card-body">
                <p class="word-count">
                    Words: <span id="wordCount">0</span> | Characters: <span id="charCount">0</span>
                </p>
                <p class="text-muted">Preview of your text:</p>
                <div class="preview" id="textPreview"></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Function to count words and characters
        function countWordsAndChars() {
            const text = document.getElementById("inputText").value;

            // Count words
            const wordCount = text.trim().split(/\s+/).filter(function(word) {
                return word.length > 0;
            }).length;

            // Count characters
            const charCount = text.length;

            // Update the word and character count
            document.getElementById("wordCount").textContent = wordCount;
            document.getElementById("charCount").textContent = charCount;

            // Show text preview
            document.getElementById("textPreview").textContent = text;
        }

        // Event listener for the Count Words button
        document.getElementById("countWordsBtn").addEventListener("click", function() {
            countWordsAndChars();
        });
    </script>

</body>
</html>
