<?php
// Color Picker Page (color-picker.php)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Color Code Picker - Multi-Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f9f9f9;
            font-family: 'Arial', sans-serif;
            padding-top: 80px;
            padding-bottom: 80px;
        }
        .color-picker-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
        }
        .color-input {
            width: 120px;
            height: 120px;
            border: none;
            cursor: pointer;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .preview-box {
            margin-top: 30px;
            height: 200px;
            width: 100%;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .ads-space {
            background: #e0e0e0;
            height: 90px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            font-weight: bold;
            border-radius: 8px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    <!-- Top Ads Space -->
    <div class="container">
        <div class="ads-space">
            Top Advertisement Space
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="color-picker-container">
                    <h2 class="mb-4">Color Code Picker 🎨</h2>
                    <input type="color" id="colorPicker" class="color-input" value="#3498db">
                    <div class="mt-3">
                        <input type="text" id="colorCode" class="form-control text-center" readonly value="#3498db">
                    </div>
                    <div class="preview-box mt-4" id="previewBox">
                        #3498db
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Ads Space -->
    <div class="container mt-5">
        <div class="ads-space">
            Bottom Advertisement Space
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
            const selectedColor = this.value;
            colorCode.value = selectedColor;
            previewBox.style.backgroundColor = selectedColor;
            previewBox.textContent = selectedColor.toUpperCase();
        });
    </script>

</body>
</html>
