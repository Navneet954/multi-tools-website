<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGB to HEX Converter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .color-preview {
            width: 150px;
            height: 150px;
            border: 2px solid #ddd;
            margin: 20px auto;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center mb-0">RGB to HEX Converter</h3>
                    </div>
                    <div class="card-body">
                        <div class="color-preview" id="colorPreview"></div>
                        <div class="mb-3">
                            <label class="form-label">Red (0-255):</label>
                            <input type="number" class="form-control" id="red" min="0" max="255" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Green (0-255):</label>
                            <input type="number" class="form-control" id="green" min="0" max="255" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Blue (0-255):</label>
                            <input type="number" class="form-control" id="blue" min="0" max="255" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">HEX Color:</label>
                            <input type="text" class="form-control" id="hexOutput" readonly>
                        </div>
                        <button class="btn btn-primary w-100" onclick="convertToHex()">Convert</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function convertToHex() {
            const red = document.getElementById('red').value;
            const green = document.getElementById('green').value;
            const blue = document.getElementById('blue').value;

            // Validate input values
            if (red < 0 || red > 255 || green < 0 || green > 255 || blue < 0 || blue > 255) {
                alert('Please enter values between 0 and 255');
                return;
            }

            // Convert to hex
            const hexColor = '#' + 
                parseInt(red).toString(16).padStart(2, '0') +
                parseInt(green).toString(16).padStart(2, '0') +
                parseInt(blue).toString(16).padStart(2, '0');

            // Update output and preview
            document.getElementById('hexOutput').value = hexColor.toUpperCase();
            document.getElementById('colorPreview').style.backgroundColor = hexColor;
        }

        // Add event listeners for real-time conversion
        ['red', 'green', 'blue'].forEach(id => {
            document.getElementById(id).addEventListener('input', convertToHex);
        });

        // Initial conversion
        convertToHex();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
