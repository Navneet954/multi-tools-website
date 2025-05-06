<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Palette Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .color-box {
            width: 100%;
            height: 150px;
            margin: 15px 0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: relative;
        }
        .color-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .color-code {
            text-align: center;
            margin-top: 10px;
            font-family: monospace;
            font-size: 1.1em;
            color: #333;
            padding: 5px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .ad-space {
            background: white;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .controls {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .btn-generate {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .btn-generate:hover {
            background: linear-gradient(45deg, #45a049, #4CAF50);
            transform: translateY(-2px);
        }
        .copy-tooltip {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            display: none;
        }
        .color-box:hover .copy-tooltip {
            display: block;
        }
        .saved-palette {
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }
        .saved-color {
            width: 30px;
            height: 30px;
            margin-right: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4" style="color: #333; font-weight: 700;">Color Palette Generator</h1>
        <p class="text-center mb-5" style="color: #666;">Click on any color to copy its hex code</p>
        
        <!-- Top Ad Space -->
        <div class="ad-space">
            <h5>Advertisement Space</h5>
            <!-- Add your ad code here -->
        </div>

        <div class="controls">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <button class="btn btn-generate btn-lg" onclick="generatePalette()">
                        <i class="fas fa-sync-alt me-2"></i>Generate New Palette
                    </button>
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-outline-secondary" onclick="savePalette()">
                        <i class="fas fa-save me-2"></i>Save Palette
                    </button>
                </div>
            </div>
        </div>

        <div class="row" id="palette-container">
            <?php
            function generateRandomColor() {
                return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            for($i = 0; $i < 5; $i++) {
                $color = generateRandomColor();
                echo '<div class="col-md-2 mb-4">';
                echo '<div class="color-box" style="background-color: ' . $color . '" onclick="copyToClipboard(\'' . $color . '\')">';
                echo '<div class="copy-tooltip">Click to copy</div>';
                echo '</div>';
                echo '<p class="color-code">' . $color . '</p>';
                echo '</div>';
            }
            ?>
        </div>

        <!-- Saved Palettes Section -->
        <div id="saved-palettes" class="mt-4">
            <h3>Saved Palettes</h3>
            <div id="saved-palettes-container"></div>
        </div>

        <!-- Side Ad Space -->
        <div class="row">
            <div class="col-md-3">
                <div class="ad-space">
                    <h5>Side Advertisement</h5>
                    <!-- Add your ad code here -->
                </div>
            </div>
        </div>

        <!-- Bottom Ad Space -->
        <div class="ad-space">
            <h5>Advertisement Space</h5>
            <!-- Add your ad code here -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function generatePalette() {
            location.reload();
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    title: 'Copied!',
                    text: 'Color code ' + text + ' has been copied to clipboard',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }

        function getCurrentPalette() {
            const colors = [];
            document.querySelectorAll('.color-code').forEach(code => {
                colors.push(code.textContent);
            });
            return colors;
        }

        function displaySavedPalettes() {
            const savedPalettes = JSON.parse(localStorage.getItem('savedPalettes') || '[]');
            const container = document.getElementById('saved-palettes-container');
            container.innerHTML = '';

            savedPalettes.forEach((palette, index) => {
                const paletteDiv = document.createElement('div');
                paletteDiv.className = 'saved-palette';
                
                palette.forEach(color => {
                    const colorDiv = document.createElement('div');
                    colorDiv.className = 'saved-color';
                    colorDiv.style.backgroundColor = color;
                    paletteDiv.appendChild(colorDiv);
                });

                const deleteBtn = document.createElement('button');
                deleteBtn.className = 'btn btn-sm btn-danger ms-2';
                deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
                deleteBtn.onclick = () => deletePalette(index);
                
                paletteDiv.appendChild(deleteBtn);
                container.appendChild(paletteDiv);
            });
        }

        function deletePalette(index) {
            const savedPalettes = JSON.parse(localStorage.getItem('savedPalettes') || '[]');
            savedPalettes.splice(index, 1);
            localStorage.setItem('savedPalettes', JSON.stringify(savedPalettes));
            displaySavedPalettes();
        }

        function savePalette() {
            const currentPalette = getCurrentPalette();
            const savedPalettes = JSON.parse(localStorage.getItem('savedPalettes') || '[]');
            
            savedPalettes.push(currentPalette);
            localStorage.setItem('savedPalettes', JSON.stringify(savedPalettes));
            
            Swal.fire({
                title: 'Success!',
                text: 'Palette has been saved',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });

            displaySavedPalettes();
        }

        // Display saved palettes on page load
        document.addEventListener('DOMContentLoaded', displaySavedPalettes);
    </script>
</body>
</html>
