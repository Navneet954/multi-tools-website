<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EM to PX Converter</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 80px;
        }

        .container {
            margin-top: 50px;
        }

        .preview-box {
            border: 2px solid #ddd;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
            font-size: 1.5em;
            background-color: #fff;
        }

        .ad-space {
            height: 60px;
            background-color: #d1d8e0;
            margin: 20px 0;
            text-align: center;
            line-height: 60px;
            font-size: 1.2em;
            color: #333;
            font-weight: bold;
        }

        .converter-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .converter-form h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .result-text {
            font-size: 1.5em;
            color: #007bff;
        }
    </style>
</head>

<body>

    <!-- Top Ad Space -->
    <div class="ad-space">
        Top Ad Space
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="converter-form">
                    <h2 class="text-center">EM to PX Converter</h2>
                    <form id="emToPxForm">
                        <div class="mb-3">
                            <label for="emValue" class="form-label">Enter Value in EM:</label>
                            <input type="number" class="form-control" id="emValue" placeholder="Enter value in EM">
                        </div>
                        <div class="mb-3">
                            <label for="baseFontSize" class="form-label">Base Font Size (in PX):</label>
                            <input type="number" class="form-control" id="baseFontSize" value="16" placeholder="Base Font Size (default 16px)">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Convert</button>
                    </form>

                    <div class="preview-box" id="previewBox">
                        <p>Preview of the text with converted font size.</p>
                    </div>

                    <div class="mt-3">
                        <p class="result-text" id="resultText"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Ad Space -->
    <div class="ad-space">
        Bottom Ad Space
    </div>

    <!-- Bootstrap JS and Custom JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // EM to PX Conversion Logic
        document.getElementById("emToPxForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent form from reloading the page

            // Get input values
            const emValue = parseFloat(document.getElementById("emValue").value);
            const baseFontSize = parseFloat(document.getElementById("baseFontSize").value);

            if (isNaN(emValue) || isNaN(baseFontSize)) {
                alert("Please enter valid numeric values.");
                return;
            }

            // Convert EM to PX
            const pxValue = emValue * baseFontSize;

            // Display the result
            document.getElementById("resultText").textContent = `Converted Value: ${pxValue.toFixed(2)} PX`;

            // Update the preview box with the converted font size
            document.getElementById("previewBox").style.fontSize = pxValue + "px";
        });
    </script>

</body>

</html>
