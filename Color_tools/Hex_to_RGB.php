<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEX to RGB Converter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .color-preview {
            width: 100px;
            height: 100px;
            border: 2px solid #ddd;
            margin: 20px auto;
            border-radius: 8px;
        }
        .invalid-feedback {
            display: none;
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center mb-0">HEX to RGB Converter</h3>
                    </div>
                    <div class="card-body">
                        <div class="color-preview" id="colorPreview"></div>
                        <form id="converterForm" onsubmit="convertToRGB(event)">
                            <div class="mb-3">
                                <label for="hexInput" class="form-label">HEX Color Code:</label>
                                <div class="input-group">
                                    <span class="input-group-text">#</span>
                                    <input type="text" 
                                           class="form-control" 
                                           id="hexInput" 
                                           placeholder="Enter HEX code" 
                                           maxlength="6"
                                           pattern="^[0-9A-Fa-f]{6}$"
                                           required>
                                </div>
                                <div class="invalid-feedback" id="hexError">
                                    Please enter a valid 6-digit HEX color code (0-9, A-F)
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Convert to RGB</button>
                            <div class="mt-3">
                                <label class="form-label">RGB Values:</label>
                                <input type="text" class="form-control" id="rgbOutput" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function convertToRGB(event) {
            event.preventDefault();
            
            let hex = document.getElementById('hexInput').value;
            const errorElement = document.getElementById('hexError');
            
            // Remove # if present and convert to uppercase
            hex = hex.replace('#', '').toUpperCase();
            
            // Validate hex input
            if(!/^[0-9A-F]{6}$/.test(hex)) {
                errorElement.style.display = 'block';
                document.getElementById('rgbOutput').value = '';
                document.getElementById('colorPreview').style.backgroundColor = '#ffffff';
                return;
            }
            
            errorElement.style.display = 'none';
            
            // Convert hex to RGB
            const r = parseInt(hex.substring(0, 2), 16);
            const g = parseInt(hex.substring(2, 4), 16);
            const b = parseInt(hex.substring(4, 6), 16);
            
            // Update color preview
            document.getElementById('colorPreview').style.backgroundColor = '#' + hex;
            
            // Display RGB values
            document.getElementById('rgbOutput').value = `rgb(${r}, ${g}, ${b})`;
        }

        // Live preview as user types
        document.getElementById('hexInput').addEventListener('input', function(e) {
            let hex = e.target.value.replace('#', '');
            const errorElement = document.getElementById('hexError');
            
            if(hex.length === 6 && /^[0-9A-Fa-f]{6}$/.test(hex)) {
                document.getElementById('colorPreview').style.backgroundColor = '#' + hex;
                errorElement.style.display = 'none';
            } else {
                errorElement.style.display = 'block';
                if(hex.length === 0) {
                    errorElement.style.display = 'none';
                }
            }
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
