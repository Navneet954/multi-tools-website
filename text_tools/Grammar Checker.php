<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grammar Checker</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding-top: 50px;
        }
        .container {
            max-width: 800px;
        }
        .preview {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: red;
            background-color: #ffdddd;
            text-decoration: underline;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">Grammar Checker</h1>
    
    <!-- Text Area for input -->
    <div class="form-group">
        <label for="text-input">Enter Text:</label>
        <textarea id="text-input" class="form-control" rows="6" placeholder="Write or paste your text here"></textarea>
    </div>
    
    <!-- Check Button -->
    <div class="text-center mt-3">
        <button id="check-grammar" class="btn btn-custom">Check Grammar</button>
    </div>

    <!-- Preview Section -->
    <div id="preview" class="preview mt-4">
        <h4>Preview:</h4>
        <div id="preview-text"></div>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        $('#check-grammar').click(function () {
            let text = $('#text-input').val();
            if (text.trim() === "") {
                alert("Please enter some text to check.");
                return;
            }
            
            // LanguageTool API for grammar checking
            $.ajax({
                url: 'https://api.languagetool.org/v2/check',
                type: 'POST',
                data: {
                    text: text,
                    language: 'en',
                    enabledOnly: false
                },
                success: function (response) {
                    let resultText = text;
                    
                    // Highlight errors
                    let matches = response.matches;
                    matches.forEach(function(match) {
                        let errorText = match.context.text.substring(match.offset, match.offset + match.length);
                        resultText = resultText.replace(errorText, `<span class="error">${errorText}</span>`);
                    });
                    
                    // Display preview with highlighted errors
                    $('#preview-text').html(resultText);
                },
                error: function () {
                    alert("Error occurred while checking grammar.");
                }
            });
        });
    });
</script>

</body>
</html>
