<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Converter Tool</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for styling -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            padding-top: 50px;
        }

        .container {
            max-width: 600px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .preview {
            padding: 15px;
            margin-top: 20px;
            background-color: #e9ecef;
            border: 1px solid #ccc;
            border-radius: 5px;
            word-wrap: break-word;
        }

        .btn-custom {
            width: 100%;
            margin-top: 15px;
        }

        .form-control {
            height: 100px;
        }

        .dropdown-toggle::after {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Case Converter Tool</h1>

        <!-- Text input area -->
        <div class="mb-3">
            <label for="inputText" class="form-label">Enter Text</label>
            <textarea id="inputText" class="form-control" rows="5" onkeyup="updatePreview()"></textarea>
        </div>

        <!-- Dropdown for case conversion options -->
        <div class="mb-3">
            <label for="caseType" class="form-label">Select Conversion Type</label>
            <select id="caseType" class="form-select" onchange="updatePreview()">
                <option value="uppercase">Uppercase</option>
                <option value="lowercase">Lowercase</option>
                <option value="capitalize">Capitalize</option>
                <option value="togglecase">Toggle Case</option>
            </select>
        </div>

        <!-- Converted text preview -->
        <div class="preview" id="previewText">Your converted text will appear here...</div>

        <!-- Convert button -->
        <button id="convertBtn" class="btn btn-primary btn-custom" onclick="convertText()">Convert</button>
    </div>

    <!-- Bootstrap JS, Popper.js, and custom script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript to handle case conversion -->
    <script>
        function updatePreview() {
            let inputText = document.getElementById('inputText').value;
            let selectedCase = document.getElementById('caseType').value;
            let previewText = document.getElementById('previewText');

            if (selectedCase == "uppercase") {
                previewText.textContent = inputText.toUpperCase();
            } else if (selectedCase == "lowercase") {
                previewText.textContent = inputText.toLowerCase();
            } else if (selectedCase == "capitalize") {
                previewText.textContent = inputText.replace(/\b\w/g, char => char.toUpperCase());
            } else if (selectedCase == "togglecase") {
                previewText.textContent = inputText.split('').map(c => {
                    if (c === c.toUpperCase()) return c.toLowerCase();
                    return c.toUpperCase();
                }).join('');
            }
        }

        function convertText() {
            let inputText = document.getElementById('inputText').value;
            let selectedCase = document.getElementById('caseType').value;
            let outputText;

            if (selectedCase == "uppercase") {
                outputText = inputText.toUpperCase();
            } else if (selectedCase == "lowercase") {
                outputText = inputText.toLowerCase();
            } else if (selectedCase == "capitalize") {
                outputText = inputText.replace(/\b\w/g, char => char.toUpperCase());
            } else if (selectedCase == "togglecase") {
                outputText = inputText.split('').map(c => {
                    if (c === c.toUpperCase()) return c.toLowerCase();
                    return c.toUpperCase();
                }).join('');
            }

            alert("Converted Text: \n\n" + outputText);
        }
    </script>
</body>

</html>
