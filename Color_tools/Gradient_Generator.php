<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradient Generator</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .container {
            margin-top: 50px;
        }

        .gradient-preview {
            width: 100%;
            height: 300px;
            border-radius: 10px;
            margin-top: 30px;
            border: 1px solid #ddd;
        }

        .gradient-form {
            margin-top: 20px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .gradient-form label {
            font-weight: bold;
        }

        .gradient-form input {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .gradient-form button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .gradient-form button:hover {
            background-color: #0056b3;
        }

        .ad-space {
            background-color: #f1f1f1;
            height: 100px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 18px;
            color: #007bff;
            font-weight: bold;
            line-height: 100px;
        }

        .color-codes {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            font-size: 18px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .gradient-preview {
                height: 250px;
            }
        }
    </style>
</head>

<body>
    <!-- Ad Space Top -->
    <div class="ad-space">
        Ad Space - Top (e.g., Banner Ad or Promotion)
    </div>

    <div class="container">
        <h1 class="text-center mb-4">Awesome Gradient Generator</h1>

        <div class="row">
            <!-- Gradient Form Section -->
            <div class="col-md-6">
                <div class="gradient-form">
                    <h4 class="text-center">Generate Your Gradient</h4>

                    <!-- Form for Gradient Generation -->
                    <form id="gradientForm">
                        <label for="color1">Color 1:</label>
                        <input type="color" id="color1" name="color1" value="#ff0000">

                        <label for="color2">Color 2:</label>
                        <input type="color" id="color2"  name="color2" value="#0000ff">

                        <label for="direction">Gradient Direction:</label>
                        <select id="direction" name="direction" class="form-select">
                            <option value="to right">Left to Right</option>
                            <option value="to bottom">Top to Bottom</option>
                            <option value="to left">Right to Left</option>
                            <option value="to top">Bottom to Top</option>
                        </select>
<div class="my-3"></div>
                        <button type="submit" class="btn btn-primary">Generate Gradient</button>
                    </form>
                </div>
            </div>

            <!-- Gradient Preview Section -->
            <div class="col-md-6">
                <!-- Color Codes Display -->
                <div class="color-codes">
                    <p>Color 1: <span id="color1Code">#ff0000</span> | Color 2: <span id="color2Code">#0000ff</span></p>
                </div>
                <div class="gradient-preview" id="gradientPreview">
                    <!-- Live Gradient Preview -->
                </div>
            </div>
        </div>
    </div>

    <!-- Ad Space Bottom -->
    <div class="ad-space">
        Ad Space - Bottom (e.g., Banner Ad or Promotion)
    </div>

    <!-- Include Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript for handling Gradient Generation
        document.getElementById('gradientForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Get values from form
            var color1 = document.getElementById('color1').value;
            var color2 = document.getElementById('color2').value;
            var direction = document.getElementById('direction').value;

            // Update the color codes display
            document.getElementById('color1Code').textContent = color1;
            document.getElementById('color2Code').textContent = color2;

            // Create the CSS gradient string
            var gradientStyle = `background: linear-gradient(${direction}, ${color1}, ${color2});`;

            // Set the gradient as background of the preview div
            document.getElementById('gradientPreview').style.cssText = gradientStyle;
        });
    </script>
</body>

</html>
