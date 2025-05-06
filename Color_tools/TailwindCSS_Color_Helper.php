<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TailwindCSS Color Helper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .color-box {
            width: 100px;
            height: 100px;
            margin: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .color-box:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-5">TailwindCSS Color Helper</h1>
        
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Color Picker</h5>
                    </div>
                    <div class="card-body">
                        <input type="color" id="colorPicker" class="form-control form-control-lg mb-3">
                        <div id="colorInfo" class="alert alert-info">
                            Select a color to see TailwindCSS equivalents
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">TailwindCSS Colors</h5>
                    </div>
                    <div class="card-body">
                        <div id="tailwindColors" class="d-flex flex-wrap justify-content-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const tailwindColors = {
            'red': ['50', '100', '200', '300', '400', '500', '600', '700', '800', '900'],
            'blue': ['50', '100', '200', '300', '400', '500', '600', '700', '800', '900'],
            'green': ['50', '100', '200', '300', '400', '500', '600', '700', '800', '900'],
            // Add more color families as needed
        };

        function initializeTailwindColors() {
            const container = document.getElementById('tailwindColors');
            
            for (const [color, shades] of Object.entries(tailwindColors)) {
                shades.forEach(shade => {
                    const colorBox = document.createElement('div');
                    colorBox.className = `color-box bg-${color}-${shade}`;
                    colorBox.setAttribute('data-color', `${color}-${shade}`);
                    colorBox.addEventListener('click', () => copyColorClass(color, shade));
                    container.appendChild(colorBox);
                });
            }
        }

        function copyColorClass(color, shade) {
            const className = `bg-${color}-${shade}`;
            navigator.clipboard.writeText(className);
            
            const alert = document.createElement('div');
            alert.className = 'alert alert-success position-fixed bottom-0 end-0 m-3';
            alert.textContent = `Copied: ${className}`;
            document.body.appendChild(alert);
            
            setTimeout(() => alert.remove(), 2000);
        }

        function findClosestTailwindColor(hex) {
            // Implementation to find closest Tailwind color
            // This would require a color distance calculation algorithm
            return {
                color: 'blue',
                shade: '500'
            };
        }

        document.getElementById('colorPicker').addEventListener('input', (e) => {
            const hex = e.target.value;
            const closest = findClosestTailwindColor(hex);
            
            document.getElementById('colorInfo').innerHTML = `
                <p>Selected Color: ${hex}</p>
                <p>Closest Tailwind Color: bg-${closest.color}-${closest.shade}</p>
            `;
        });

        initializeTailwindColors();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
