<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Color Analyzer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .color-box {
            width: 100px;
            height: 100px;
            margin: 10px;
            border: 1px solid #ddd;
            display: inline-block;
        }
        #imagePreview {
            max-width: 100%;
            max-height: 400px;
            margin: 20px 0;
        }
        .color-info {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Image Color Analyzer</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="imageInput" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="imageInput" accept="image/*">
                        </div>
                        
                        <div class="text-center">
                            <img id="imagePreview" class="d-none">
                        </div>
                        
                        <div id="colorResults" class="text-center mt-4">
                            <h3>Dominant Colors</h3>
                            <div id="dominantColors"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.getElementById('imagePreview');
                    img.src = event.target.result;
                    img.classList.remove('d-none');
                    
                    // Create a temporary canvas to analyze the image
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    
                    img.onload = function() {
                        canvas.width = img.width;
                        canvas.height = img.height;
                        ctx.drawImage(img, 0, 0);
                        
                        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
                        const colorMap = {};
                        
                        // Analyze colors
                        for (let i = 0; i < imageData.length; i += 4) {
                            const r = imageData[i];
                            const g = imageData[i + 1];
                            const b = imageData[i + 2];
                            const rgb = `rgb(${r},${g},${b})`;
                            
                            colorMap[rgb] = (colorMap[rgb] || 0) + 1;
                        }
                        
                        // Get top 5 dominant colors
                        const dominantColors = Object.entries(colorMap)
                            .sort((a, b) => b[1] - a[1])
                            .slice(0, 5);
                            
                        // Display results
                        const container = document.getElementById('dominantColors');
                        container.innerHTML = '';
                        
                        dominantColors.forEach(([color, count]) => {
                            const percentage = ((count / (imageData.length / 4)) * 100).toFixed(2);
                            const div = document.createElement('div');
                            div.className = 'color-info';
                            div.innerHTML = `
                                <div class="color-box" style="background-color: ${color}"></div>
                                <div>${color}</div>
                                <div>${percentage}%</div>
                            `;
                            container.appendChild(div);
                        });
                    };
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
