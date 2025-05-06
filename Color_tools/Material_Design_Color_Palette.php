<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Material Design Color Palette - Copy and use official Material Design colors">
    <title>Material Design Color Palette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --card-height: 100px;
            --hover-scale: 1.05;
            --transition-speed: 0.2s;
        }
        
        .color-card {
            height: var(--card-height);
            cursor: pointer;
            transition: all var(--transition-speed) ease-in-out;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
        }
        
        .color-card:hover {
            transform: scale(var(--hover-scale));
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .color-name {
            color: white;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            font-weight: bold;
        }
        
        .color-info {
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            opacity: 0;
            transition: opacity var(--transition-speed);
        }
        
        .color-card:hover .color-info {
            opacity: 1;
        }
        
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: rgba(33, 37, 41, 0.85);
            color: white;
        }
        
        .color-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        
        .section-title {
            color: #333;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-5">Material Design Color Palette</h1>
        <p class="text-center mb-4">Click on any color to copy its hex code to clipboard</p>
        
        <div class="row" id="colorPalette">
            <!-- Colors will be dynamically added here -->
        </div>
    </div>

    <!-- Toast for copy notification -->
    <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Color code copied to clipboard!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const materialColors = {
            'Red': ['#FFEBEE', '#FFCDD2', '#EF9A9A', '#E57373', '#EF5350', '#F44336', '#E53935', '#D32F2F', '#C62828', '#B71C1C'],
            'Pink': ['#FCE4EC', '#F8BBD0', '#F48FB1', '#F06292', '#EC407A', '#E91E63', '#D81B60', '#C2185B', '#AD1457', '#880E4F'],
            'Purple': ['#F3E5F5', '#E1BEE7', '#CE93D8', '#BA68C8', '#AB47BC', '#9C27B0', '#8E24AA', '#7B1FA2', '#6A1B9A', '#4A148C'],
            'Deep Purple': ['#EDE7F6', '#D1C4E9', '#B39DDB', '#9575CD', '#7E57C2', '#673AB7', '#5E35B1', '#512DA8', '#4527A0', '#311B92'],
            'Indigo': ['#E8EAF6', '#C5CAE9', '#9FA8DA', '#7986CB', '#5C6BC0', '#3F51B5', '#3949AB', '#303F9F', '#283593', '#1A237E'],
            'Blue': ['#E3F2FD', '#BBDEFB', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#1E88E5', '#1976D2', '#1565C0', '#0D47A1'],
            'Light Blue': ['#E1F5FE', '#B3E5FC', '#81D4FA', '#4FC3F7', '#29B6F6', '#03A9F4', '#039BE5', '#0288D1', '#0277BD', '#01579B'],
            'Cyan': ['#E0F7FA', '#B2EBF2', '#80DEEA', '#4DD0E1', '#26C6DA', '#00BCD4', '#00ACC1', '#0097A7', '#00838F', '#006064'],
            'Teal': ['#E0F2F1', '#B2DFDB', '#80CBC4', '#4DB6AC', '#26A69A', '#009688', '#00897B', '#00796B', '#00695C', '#004D40'],
            'Green': ['#E8F5E9', '#C8E6C9', '#A5D6A7', '#81C784', '#66BB6A', '#4CAF50', '#43A047', '#388E3C', '#2E7D32', '#1B5E20'],
            'Light Green': ['#F1F8E9', '#DCEDC8', '#C5E1A5', '#AED581', '#9CCC65', '#8BC34A', '#7CB342', '#689F38', '#558B2F', '#33691E'],
            'Lime': ['#F9FBE7', '#F0F4C3', '#E6EE9C', '#DCE775', '#D4E157', '#CDDC39', '#C0CA33', '#AFB42B', '#9E9D24', '#827717'],
            'Yellow': ['#FFFDE7', '#FFF9C4', '#FFF59D', '#FFF176', '#FFEE58', '#FFEB3B', '#FDD835', '#FBC02D', '#F9A825', '#F57F17'],
            'Amber': ['#FFF8E1', '#FFECB3', '#FFE082', '#FFD54F', '#FFCA28', '#FFC107', '#FFB300', '#FFA000', '#FF8F00', '#FF6F00'],
            'Orange': ['#FFF3E0', '#FFE0B2', '#FFCC80', '#FFB74D', '#FFA726', '#FF9800', '#FB8C00', '#F57C00', '#EF6C00', '#E65100'],
            'Deep Orange': ['#FBE9E7', '#FFCCBC', '#FFAB91', '#FF8A65', '#FF7043', '#FF5722', '#F4511E', '#E64A19', '#D84315', '#BF360C'],
            'Brown': ['#EFEBE9', '#D7CCC8', '#BCAAA4', '#A1887F', '#8D6E63', '#795548', '#6D4C41', '#5D4037', '#4E342E', '#3E2723'],
            'Grey': ['#FAFAFA', '#F5F5F5', '#EEEEEE', '#E0E0E0', '#BDBDBD', '#9E9E9E', '#757575', '#616161', '#424242', '#212121'],
            'Blue Grey': ['#ECEFF1', '#CFD8DC', '#B0BEC5', '#90A4AE', '#78909C', '#607D8B', '#546E7A', '#455A64', '#37474F', '#263238'],
            'Black': ['#000000'],
            'White': ['#FFFFFF'],
            'Transparent': ['transparent'],
            'Gold': ['#FFD700', '#FFC000', '#FFB300', '#FFA500'],
            'Silver': ['#C0C0C0', '#A9A9A9', '#808080'],
            'Bronze': ['#CD7F32', '#B87333', '#A67B5B'],
            'Rose Gold': ['#B76E79', '#E0BFB8', '#CE8F98', '#B76E79'],
            'Copper': ['#B87333', '#DA8A67', '#CB6D51'],
            'Steel': ['#71797E', '#798081', '#646B63'],
            'Gunmetal': ['#2C3539', '#2B3856', '#434B4D']
        };

        function createColorPalette() {
            const container = document.getElementById('colorPalette');
            
            for (const [colorName, shades] of Object.entries(materialColors)) {
                const colorSection = document.createElement('div');
                colorSection.className = 'col-md-12 color-section';
                colorSection.innerHTML = `<h3 class="section-title">${colorName}</h3>`;
                
                const row = document.createElement('div');
                row.className = 'row g-3';
                
                shades.forEach((hexCode, index) => {
                    const card = document.createElement('div');
                    card.className = 'col-lg-1 col-md-2 col-sm-3 col-4';
                    
                    // Calculate contrast color for text
                    const rgb = hexToRgb(hexCode);
                    const textColor = getContrastColor(rgb.r, rgb.g, rgb.b);
                    
                    card.innerHTML = `
                        <div class="color-card d-flex align-items-center justify-content-center" 
                             style="background-color: ${hexCode}"
                             onclick="copyToClipboard('${hexCode}')">
                            <span class="color-name" style="color: ${textColor}">${index * 100}</span>
                            <div class="color-info">
                                <small style="color: ${textColor}">${hexCode}</small>
                            </div>
                        </div>
                    `;
                    row.appendChild(card);
                });
                
                colorSection.appendChild(row);
                container.appendChild(colorSection);
            }
        }

        function hexToRgb(hex) {
            const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }

        function getContrastColor(r, g, b) {
            const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
            return luminance > 0.5 ? '#000000' : '#FFFFFF';
        }

        async function copyToClipboard(text) {
            try {
                await navigator.clipboard.writeText(text);
                const toast = new bootstrap.Toast(document.querySelector('.toast'));
                toast.show();
            } catch (err) {
                console.error('Failed to copy text: ', err);
            }
        }

        // Initialize the color palette when the page loads
        document.addEventListener('DOMContentLoaded', createColorPalette);
    </script>
</body>
</html>
