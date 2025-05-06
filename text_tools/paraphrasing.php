<?php
// Initialize $inputText to avoid undefined variable warning
$inputText = "";

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input text from the form
    $inputText = trim($_POST['inputText']);
    
    // Check if the input text is not empty
    if (!empty($inputText)) {
        // Example paraphrasing logic: this can be replaced with a more complex logic or API
        $paraphrasedText = str_replace("good", "great", $inputText); // Simple word replacement
    } else {
        $paraphrasedText = "Please enter some text to paraphrase.";
    }
} else {
    // If the form was not submitted, set the paraphrased text to an empty string
    $paraphrasedText = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paraphrasing Tool</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .header, .footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .container {
            margin-top: 40px;
        }
        .input-text, .output-text {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            width: 100%;
            font-size: 1rem;
            height: 150px;
        }
        .btn-paraphrase {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .btn-paraphrase:hover {
            background-color: #0056b3;
        }
        .ad-space {
            background-color: #e9ecef;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.2rem;
            color: #333;
        }
        .ad-space a {
            color: #007bff;
            text-decoration: none;
        }
        /* Loading Spinner */
        .loader {
            display: none;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <!-- Ad Space Top -->
    <div class="ad-space">
        <p>Ad space at the top. <a href="#">Click here for an awesome deal!</a></p>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Paraphrasing Tool</h2>

                <!-- Input Section -->
                <form method="POST">
                    <textarea class="input-text" id="inputText" name="inputText" placeholder="Enter the text you want to paraphrase..."><?php echo htmlspecialchars($inputText); ?></textarea>
                    <button class="btn-paraphrase" type="submit">Paraphrase</button>
                </form>
                
                <div id="loading" class="loader"></div>

                <!-- Output Section -->
                <h4>Preview:</h4>
                <textarea class="output-text" id="outputText" readonly><?php echo htmlspecialchars($paraphrasedText); ?></textarea>
            </div>
        </div>
    </div>

    <!-- Ad Space Bottom -->
    <div class="ad-space">
        <p>Ad space at the bottom. <a href="#">Visit our sponsor for great offers!</a></p>
    </div>

    <!-- JavaScript Section -->
    <script>
        function paraphraseText() {
            var inputText = document.getElementById('inputText').value;
            
            if (inputText.trim() == "") {
                alert("Please enter some text to paraphrase.");
                return;
            }

            document.getElementById('loading').style.display = 'inline-block'; // Show loading spinner

            // Simulate a delay (use API for real paraphrasing)
            setTimeout(function() {
                // Example paraphrasing logic: replacing 'good' with 'great'
                var outputText = inputText.replace(/good/g, "great");
                document.getElementById('outputText').value = outputText;
                document.getElementById('loading').style.display = 'none'; // Hide loading spinner
            }, 1500); // 1.5 seconds delay for demo
        }

        // Update preview instantly as user types
        function updatePreview() {
            var inputText = document.getElementById('inputText').value;
            var outputText = inputText.replace(/good/g, "great");
            document.getElementById('outputText').value = outputText;
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
