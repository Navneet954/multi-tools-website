<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradient Background Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #gradient-box {
            height: 300px;
            border-radius: 8px;
            margin: 20px 0;
            transition: background 0.3s ease;
        }
        .color-input {
            height: 40px;
            width: 100px;
            padding: 0 5px;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Gradient Background Generator</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="gradient-box" class="shadow"></div>
                
                <div class="row g-3 align-items-center">
                    <div class="col-md-3">
                        <input type="color" id="color1" value="#ff0000" class="color-input">
                    </div>
                    <div class="col-md-3">
                        <input type="color" id="color2" value="#00ff00" class="color-input">
                    </div>
                    <div class="col-md-3">
                        <select id="direction" class="form-select">
                            <option value="to right">Horizontal</option>
                            <option value="to bottom">Vertical</option>
                            <option value="to bottom right">Diagonal</option>
                            <option value="circle at center">Radial</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button onclick="copyCSS()" class="btn btn-primary w-100">Copy CSS</button>
                    </div>
                </div>
                
                <div class="mt-4">
                    <code id="css-code" class="bg-dark text-light p-3 d-block rounded"></code>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const color1Input = document.getElementById('color1');
        const color2Input = document.getElementById('color2');
        const directionSelect = document.getElementById('direction');
        const gradientBox = document.getElementById('gradient-box');
        const cssCode = document.getElementById('css-code');

        function updateGradient() {
            let gradientType = directionSelect.value.includes('circle') ? 'radial-gradient' : 'linear-gradient';
            let gradient = `${gradientType}(${directionSelect.value}, ${color1Input.value}, ${color2Input.value})`;
            gradientBox.style.background = gradient;
            cssCode.textContent = `background: ${gradient};`;
        }

        function copyCSS() {
            navigator.clipboard.writeText(cssCode.textContent)
                .then(() => alert('CSS copied to clipboard!'))
                .catch(err => console.error('Failed to copy:', err));
        }

        color1Input.addEventListener('input', updateGradient);
        color2Input.addEventListener('input', updateGradient);
        directionSelect.addEventListener('change', updateGradient);

        // Initialize gradient on page load
        updateGradient();
    </script>
</body>
</html>
