<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSS Animation Generator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles for Animation Generator */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .container {
            max-width: 800px;
        }

        .preview-box {
            width: 100px;
            height: 100px;
            background-color: #007bff;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            transition: all 0.5s ease-in-out;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .ad-space {
            background-color: #e9ecef;
            height: 100px;
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            color: #495057;
        }

        .btn-generate {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Advertisement Space (Top) -->
    <div class="ad-space">
        <span>Ad Space - Top</span>
    </div>

    <div class="container">
        <h2 class="text-center mb-4">CSS Animation Generator</h2>

        <!-- Form to select animation parameters -->
        <div class="form-group">
            <label for="animationType">Select Animation</label>
            <select class="form-select" id="animationType">
                <option value="bounce">Bounce</option>
                <option value="shake">Shake</option>
                <option value="fadeIn">Fade In</option>
                <option value="zoomIn">Zoom In</option>
            </select>
        </div>

        <div class="form-group">
            <label for="duration">Duration (s)</label>
            <input type="number" class="form-control" id="duration" placeholder="Enter duration in seconds" value="1" min="0.1" step="0.1">
        </div>

        <div class="form-group">
            <label for="timingFunction">Timing Function</label>
            <select class="form-select" id="timingFunction">
                <option value="ease">Ease</option>
                <option value="linear">Linear</option>
                <option value="ease-in">Ease In</option>
                <option value="ease-out">Ease Out</option>
                <option value="ease-in-out">Ease In-Out</option>
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-generate w-100" id="generateAnimation">Generate Animation</button>
        </div>

        <!-- Preview Box -->
        <div class="preview-box" id="previewBox">Preview</div>

    </div>

    <!-- Advertisement Space (Bottom) -->
    <div class="ad-space">
        <span>Ad Space - Bottom</span>
    </div>

    <!-- JavaScript to handle animation generation -->
    <script>
        document.getElementById('generateAnimation').addEventListener('click', function () {
            // Get the selected animation and properties
            var animationType = document.getElementById('animationType').value;
            var duration = document.getElementById('duration').value;
            var timingFunction = document.getElementById('timingFunction').value;

            // Prepare the CSS animation rule
            var animationRule = `${animationType} ${duration}s ${timingFunction}`;

            // Apply the animation to the preview box
            var previewBox = document.getElementById('previewBox');
            previewBox.style.animation = animationRule;

            // Preview box animation logic
            previewBox.classList.remove('bounce', 'shake', 'fadeIn', 'zoomIn');
            previewBox.classList.add(animationType);
        });

        // Example animations using CSS keyframes
        const styleSheet = document.styleSheets[0];
        styleSheet.insertRule(`
            @keyframes bounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-30px); }
            }
        `, styleSheet.cssRules.length);

        styleSheet.insertRule(`
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-10px); }
                50% { transform: translateX(10px); }
                75% { transform: translateX(-10px); }
            }
        `, styleSheet.cssRules.length);

        styleSheet.insertRule(`
            @keyframes fadeIn {
                0% { opacity: 0; }
                100% { opacity: 1; }
            }
        `, styleSheet.cssRules.length);

        styleSheet.insertRule(`
            @keyframes zoomIn {
                0% { transform: scale(0); }
                100% { transform: scale(1); }
            }
        `, styleSheet.cssRules.length);
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
