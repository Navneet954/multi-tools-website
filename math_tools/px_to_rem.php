<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PX to REM Converter</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .preview-box {
            background-color: #e2e2e2;
            border-radius: 5px;
            padding: 20px;
            font-size: 1.2rem;
            margin-top: 20px;
            text-align: center;
        }

        .result {
            font-size: 1.5rem;
            font-weight: 600;
            color: #007bff;
        }

        .ads-space {
            background-color: #ddd;
            height: 50px;
            margin: 20px 0;
        }

        .ads-space img {
            max-width: 100%;
            height: auto;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <!-- Ad space at the top -->
    <div class="ads-space">
        <img src="https://via.placeholder.com/1000x50.png?text=Your+Ad+Here" alt="Ad">
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Card for the converter -->
                <div class="card p-4">
                    <h2 class="text-center mb-4">PX to REM Converter</h2>

                    <!-- Converter Form -->
                    <div class="mb-3">
                        <label for="pxValue" class="form-label">Enter Value in PX</label>
                        <input type="number" class="form-control" id="pxValue" placeholder="Enter pixel value">
                    </div>
                    <div class="mb-3">
                        <label for="baseValue" class="form-label">Enter Base Font Size (in PX)</label>
                        <input type="number" class="form-control" id="baseValue" value="16" placeholder="Enter base font size">
                    </div>
                    <button class="btn btn-primary w-100" onclick="convertToRem()">Convert to REM</button>
                </div>

                <!-- Preview Box -->
                <div id="previewBox" class="preview-box mt-4">
                    <p>Converted Value: <span id="remResult" class="result">0 REM</span></p>
                    <p>Preview (Font Size in REM): <span id="previewText">The result will appear here...</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ad space at the bottom -->
    <div class="ads-space">
        <img src="https://via.placeholder.com/1000x50.png?text=Your+Ad+Here" alt="Ad">
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 PX to REM Converter. All Rights Reserved.</p>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for PX to REM conversion -->
    <script>
        function convertToRem() {
            // Get the input values
            var pxValue = parseFloat(document.getElementById("pxValue").value);
            var baseValue = parseFloat(document.getElementById("baseValue").value);

            // Validate the inputs
            if (isNaN(pxValue) || isNaN(baseValue) || baseValue <= 0) {
                alert("Please enter valid numeric values!");
                return;
            }

            // Calculate REM value
            var remValue = pxValue / baseValue;

            // Display the result
            document.getElementById("remResult").textContent = remValue.toFixed(4) + " REM";
            document.getElementById("previewText").style.fontSize = remValue + "rem";
        }
    </script>

</body>

</html>
