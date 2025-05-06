<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Picker Tool</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .color-picker-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }

        .color-display {
            width: 300px;
            height: 300px;
            border: 2px solid #ccc;
            margin: 20px 0;
        }

        .color-inputs {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .color-values {
            margin: 20px 0;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 5px;
        }

        .ad-space {
            width: 100%;
            min-height: 90px;
            background: #f0f0f0;
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px dashed #999;
        }

        .color-code {
            font-family: monospace;
            padding: 5px 10px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Top Ad Space -->
        <div class="ad-space">
            Advertisement Space
        </div>

        <h1>Color Picker Tool</h1>
        
        <div class="color-picker-section">
            <div>
                <div class="color-display" id="colorDisplay"></div>
                <div class="color-values">
                    <p>HEX: <span class="color-code" id="hexValue" onclick="copyToClipboard(this)">#000000</span></p>
                    <p>RGB: <span class="color-code" id="rgbValue" onclick="copyToClipboard(this)">rgb(0, 0, 0)</span></p>
                    <p>HSL: <span class="color-code" id="hslValue" onclick="copyToClipboard(this)">hsl(0, 0%, 0%)</span></p>
                </div>
            </div>
            
            <div class="color-inputs">
                <label>
                    Color Picker:
                    <input type="color" id="colorPicker" value="#000000">
                </label>
                
                <label>
                    Red (0-255):
                    <input type="number" id="redInput" min="0" max="255" value="0">
                </label>
                
                <label>
                    Green (0-255):
                    <input type="number" id="greenInput" min="0" max="255" value="0">
                </label>
                
                <label>
                    Blue (0-255):
                    <input type="number" id="blueInput" min="0" max="255" value="0">
                </label>
            </div>
        </div>

        <!-- Bottom Ad Space -->
        <div class="ad-space">
            Advertisement Space
        </div>
    </div>

    <script>
        const colorPicker = document.getElementById('colorPicker');
        const redInput = document.getElementById('redInput');
        const greenInput = document.getElementById('greenInput');
        const blueInput = document.getElementById('blueInput');
        const colorDisplay = document.getElementById('colorDisplay');
        const hexValue = document.getElementById('hexValue');
        const rgbValue = document.getElementById('rgbValue');
        const hslValue = document.getElementById('hslValue');

        function updateColor() {
            const r = parseInt(redInput.value);
            const g = parseInt(greenInput.value);
            const b = parseInt(blueInput.value);
            
            const hex = rgbToHex(r, g, b);
            const hsl = rgbToHsl(r, g, b);
            
            colorDisplay.style.backgroundColor = `rgb(${r}, ${g}, ${b})`;
            colorPicker.value = hex;
            hexValue.textContent = hex;
            rgbValue.textContent = `rgb(${r}, ${g}, ${b})`;
            hslValue.textContent = `hsl(${Math.round(hsl.h)}, ${Math.round(hsl.s)}%, ${Math.round(hsl.l)}%)`;
        }

        function rgbToHex(r, g, b) {
            return '#' + [r, g, b].map(x => {
                const hex = x.toString(16);
                return hex.length === 1 ? '0' + hex : hex;
            }).join('');
        }

        function rgbToHsl(r, g, b) {
            r /= 255;
            g /= 255;
            b /= 255;

            const max = Math.max(r, g, b);
            const min = Math.min(r, g, b);
            let h, s, l = (max + min) / 2;

            if (max === min) {
                h = s = 0;
            } else {
                const d = max - min;
                s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

                switch (max) {
                    case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                    case g: h = (b - r) / d + 2; break;
                    case b: h = (r - g) / d + 4; break;
                }

                h /= 6;
            }

            return {
                h: h * 360,
                s: s * 100,
                l: l * 100
            };
        }

        function hexToRgb(hex) {
            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }

        function copyToClipboard(element) {
            navigator.clipboard.writeText(element.textContent)
                .then(() => {
                    const originalText = element.textContent;
                    element.textContent = 'Copied!';
                    setTimeout(() => {
                        element.textContent = originalText;
                    }, 1000);
                })
                .catch(err => console.error('Failed to copy:', err));
        }

        colorPicker.addEventListener('input', (e) => {
            const rgb = hexToRgb(e.target.value);
            redInput.value = rgb.r;
            greenInput.value = rgb.g;
            blueInput.value = rgb.b;
            updateColor();
        });

        [redInput, greenInput, blueInput].forEach(input => {
            input.addEventListener('input', updateColor);
        });

        // Initialize with black color
        updateColor();
    </script>
</body>
</html>
