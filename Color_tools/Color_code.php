<?php
// Color Picker Page (color-picker.php)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Professional Color Code Picker - Multi-Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Professional color picker tool with hex code display">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Inter', sans-serif;
            padding-top: 80px;
            padding-bottom: 80px;
            min-height: 100vh;
        }

        .color-picker-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
        }

        .color-input {
            width: 150px;
            height: 150px;
            border: none;
            cursor: pointer;
            border-radius: 50%;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .color-input:hover {
            transform: scale(1.05);
        }

        .preview-box {
            margin-top: 35px;
            height: 220px;
            width: 100%;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.75rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .ads-space {
            background: #ffffff;
            height: 100px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-weight: 500;
            border-radius: 12px;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        h2 {
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 1.5rem;
        }

        .form-control {
            font-size: 1.1rem;
            padding: 0.75rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-family: 'Inter', monospace;
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        }
    </style>
</head>

<body>

    <!-- Top Ads Space -->
    <div class="container">
        <div class="ads-space">
            Premium Advertisement Space
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="color-picker-container">
                    <h2>Professional Color Picker</h2>
                    <input type="color" id="colorPicker" class="color-input" value="#4a90e2">
                    <div class="mt-4">
                        <input type="text" id="colorCode" class="form-control text-center" readonly value="#4a90e2">
                    </div>
                    <div class="preview-box" id="previewBox" style="background-color: #4a90e2;">
                        #4A90E2
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Ads Space -->
    <div class="container mt-5">
        <div class="ads-space">
            Premium Advertisement Space
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Color Picker Script -->
    <script>
        const colorPicker = document.getElementById('colorPicker');
        const colorCode = document.getElementById('colorCode');
        const previewBox = document.getElementById('previewBox');

        colorPicker.addEventListener('input', function() {
            const selectedColor = this.value.toUpperCase();
            colorCode.value = selectedColor;
            previewBox.style.backgroundColor = selectedColor;
            previewBox.textContent = selectedColor;

            // Adjust text color based on background brightness
            const rgb = parseInt(selectedColor.substring(1), 16);
            const brightness = ((rgb >> 16) & 255) * 0.299 +
                ((rgb >> 8) & 255) * 0.587 +
                (rgb & 255) * 0.114;
            previewBox.style.color = brightness > 186 ? '#000000' : '#FFFFFF';
        });
    </script>

</body>

</html>