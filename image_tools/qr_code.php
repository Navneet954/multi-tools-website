<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Generator with Eye Shapes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 40px;
            background: #f8f9fa;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        #previewImg {
            max-width: 100%;
            height: auto;
            border: 1px solid #dee2e6;
            padding: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4 text-center">QR Code Generator with Eye Shapes</h2>
    
    <form id="qrForm">
        <div class="mb-3">
            <label for="qrtext" class="form-label">Text/URL</label>
            <input type="text" class="form-control" id="qrtext" name="qrtext" placeholder="Enter text or URL" required>
        </div>

        <div class="mb-3">
            <label for="size" class="form-label">Size (pixels)</label>
            <input type="number" class="form-control" id="size" name="size" value="300" min="100" max="1000" required>
        </div>

        <div class="mb-3">
            <label for="foreground" class="form-label">Foreground Color</label>
            <input type="color" class="form-control form-control-color" id="foreground" name="foreground" value="#000000">
        </div>

        <div class="mb-3">
            <label for="background" class="form-label">Background Color</label>
            <input type="color" class="form-control form-control-color" id="background" name="background" value="#ffffff">
        </div>

        <div class="mb-3">
            <label for="eyeShape" class="form-label">Eye Shape</label>
            <select name="eyeShape" id="eyeShape" class="form-select">
                <option value="">Default</option>
                <option value="rounded">Rounded</option>
                <option value="dot">Dots</option>
                <option value="square">Square</option>
            </select>
        </div>

        <div class="text-center mb-3">
            <button type="button" class="btn btn-primary" id="generateBtn">Generate QR Code</button>
        </div>
    </form>

    <div class="text-center">
        <img id="previewImg" src="" alt="QR Preview" class="mb-3" />
        <br>
        <a id="downloadBtn" href="#" download="qr-code.svg" class="btn btn-success">Download QR Code</a>
    </div>
</div>

<script>
document.getElementById('generateBtn').addEventListener('click', function() {
    const text = document.getElementById('qrtext').value || 'HelloWorld';
    const size = document.getElementById('size').value || '300';
    const color = document.getElementById('foreground').value.replace('#', '');
    const bgcolor = document.getElementById('background').value.replace('#', '');
    const eyeShape = document.getElementById('eyeShape').value;

    let format = 'png'; // Default format
    if (eyeShape === 'rounded' || eyeShape === 'dot' || eyeShape === 'square') {
        format = 'svg'; // Use SVG for better shape rendering
    }

    let previewUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(text)}&size=${size}x${size}&color=${color}&bgcolor=${bgcolor}&format=${format}`;

    document.getElementById('previewImg').src = previewUrl;
    document.getElementById('downloadBtn').href = previewUrl;
});

// Optional: Auto update preview when typing
document.getElementById('qrForm').addEventListener('input', function() {
    document.getElementById('generateBtn').click();
});
</script>

</body>
</html>
