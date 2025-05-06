<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Border Radius Generator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Styling */
        .container {
            margin-top: 20px;
        }
        .border-preview {
            width: 200px;
            height: 200px;
            background-color: #3498db;
            margin: 20px auto;
            transition: all 0.3s ease;
        }
        .ad-space {
            height: 100px;
            background-color: #f4f4f4;
            text-align: center;
            line-height: 100px;
            margin: 20px 0;
            border: 1px dashed #ddd;
        }
        .ad-space p {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Top Ad Space -->
    <div class="ad-space">
        <p>Ad Space - Top (You can add your ads here)</p>
    </div>

    <div class="container">
        <h1 class="text-center mb-4">Border Radius Generator</h1>
        
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Input Form for Border Radius -->
                <div class="form-group">
                    <label for="topLeft">Top Left Radius:</label>
                    <input type="number" id="topLeft" class="form-control" placeholder="Enter top left radius (px)" value="0">
                </div>
                <div class="form-group">
                    <label for="topRight">Top Right Radius:</label>
                    <input type="number" id="topRight" class="form-control" placeholder="Enter top right radius (px)" value="0">
                </div>
                <div class="form-group">
                    <label for="bottomLeft">Bottom Left Radius:</label>
                    <input type="number" id="bottomLeft" class="form-control" placeholder="Enter bottom left radius (px)" value="0">
                </div>
                <div class="form-group">
                    <label for="bottomRight">Bottom Right Radius:</label>
                    <input type="number" id="bottomRight" class="form-control" placeholder="Enter bottom right radius (px)" value="0">
                </div>
            </div>
        </div>

        <!-- Preview Box -->
        <div class="text-center mt-4">
            <h4>Preview:</h4>
            <div class="border-preview" id="preview-box"></div>
        </div>
        
    </div>

    <!-- Bottom Ad Space -->
    <div class="ad-space">
        <p>Ad Space - Bottom (You can add your ads here)</p>
    </div>

    <!-- Bootstrap JS and JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS to Update Border Radius -->
    <script>
        // Function to update the border radius preview
        function updateBorderRadius() {
            var topLeft = document.getElementById("topLeft").value;
            var topRight = document.getElementById("topRight").value;
            var bottomLeft = document.getElementById("bottomLeft").value;
            var bottomRight = document.getElementById("bottomRight").value;

            // Update the preview box border radius style
            var previewBox = document.getElementById("preview-box");
            previewBox.style.borderTopLeftRadius = topLeft + "px";
            previewBox.style.borderTopRightRadius = topRight + "px";
            previewBox.style.borderBottomLeftRadius = bottomLeft + "px";
            previewBox.style.borderBottomRightRadius = bottomRight + "px";
        }

        // Attach event listeners to inputs
        document.getElementById("topLeft").addEventListener("input", updateBorderRadius);
        document.getElementById("topRight").addEventListener("input", updateBorderRadius);
        document.getElementById("bottomLeft").addEventListener("input", updateBorderRadius);
        document.getElementById("bottomRight").addEventListener("input", updateBorderRadius);

        // Initialize the preview with default values
        updateBorderRadius();
    </script>
</body>
</html>
