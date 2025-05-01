<?php
// barcode_generator.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barcode Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .preview-box {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        canvas, svg {
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-5">Advanced Barcode Generator</h1>

    <div class="row">
        <div class="col-md-5">
            <form id="barcodeForm" class="bg-white p-4 rounded shadow">
                <div class="mb-3">
                    <label class="form-label">Text / Number</label>
                    <input type="text" class="form-control" id="text" value="HelloWorld123" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Barcode Type</label>
                    <select class="form-select" id="type">
                        <option value="CODE128">Code128</option>
                        <option value="EAN13">EAN13</option>
                        <option value="UPC">UPC</option>
                        <option value="QR">QR Code</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Primary Color</label>
                    <input type="color" class="form-control form-control-color" id="color" value="#000000">
                </div>

                <div class="mb-3" id="eyeOptions" style="display:none;">
                    <label class="form-label">QR Eye Shape</label>
                    <select class="form-select" id="eyeShape">
                        <option value="square">Square</option>
                        <option value="circle">Circle</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>

        <div class="col-md-7">
            <div class="preview-box text-center">
                <h5 class="mb-3">Live Preview</h5>
                <div id="previewArea">
                    <svg id="barcode"></svg>
                    <canvas id="qrcode" style="display:none;"></canvas>
                </div>
                <div class="d-grid gap-2 d-md-block mt-3">
                    <button class="btn btn-success" id="downloadQR" style="display:none;">Download QR Code</button>
                    <button class="btn btn-success" id="downloadBarcode" style="display:none;">Download Barcode</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JsBarcode -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<!-- QRCode.js -->
<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

<script>
document.getElementById('barcodeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    let text = document.getElementById('text').value;
    let type = document.getElementById('type').value;
    let color = document.getElementById('color').value;
    let eyeShape = document.getElementById('eyeShape').value;

    if (type === "QR") {
        document.getElementById('barcode').style.display = 'none';
        document.getElementById('qrcode').style.display = 'block';
        document.getElementById('downloadQR').style.display = 'inline-block';
        document.getElementById('downloadBarcode').style.display = 'none';
        
        let qrContainer = document.getElementById('qrcode');
        qrContainer.innerHTML = "";

        new QRCode(qrContainer, {
            text: text,
            width: 250,
            height: 250,
            colorDark : color,
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    } else {
        document.getElementById('barcode').style.display = 'block';
        document.getElementById('qrcode').style.display = 'none';
        document.getElementById('downloadQR').style.display = 'none';
        document.getElementById('downloadBarcode').style.display = 'inline-block';
        
        JsBarcode("#barcode", text, {
            format: type,
            lineColor: color,
            width: 2,
            height: 100,
            displayValue: true
        });
    }
});

// Show Eye Shape only for QR code
document.getElementById('type').addEventListener('change', function() {
    if(this.value === 'QR') {
        document.getElementById('eyeOptions').style.display = 'block';
    } else {
        document.getElementById('eyeOptions').style.display = 'none';
    }
});

// Download QR Code
document.getElementById('downloadQR').addEventListener('click', function() {
    let canvas = document.querySelector('#qrcode canvas');
    let link = document.createElement('a');
    link.download = 'QRCode.png';
    link.href = canvas.toDataURL();
    link.click();
});

// Download Barcode
document.getElementById('downloadBarcode').addEventListener('click', function() {
    let svg = document.getElementById('barcode');
    let svgData = new XMLSerializer().serializeToString(svg);
    let canvas = document.createElement('canvas');
    let ctx = canvas.getContext('2d');

    let img = new Image();
    img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0);

        let link = document.createElement('a');
        link.download = 'Barcode.png';
        link.href = canvas.toDataURL();
        link.click();
    };

    img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
});
</script>

</body>
</html>
