<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screenshot to PDF Converter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- jsPDF Library -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            padding: 20px;
        }
        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin-top: 50px;
        }
        .preview-container {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            margin-top: 20px;
        }
        #preview {
            max-width: 100%;
            max-height: 300px;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #007bff;
            color: white;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Screenshot to PDF Converter</h2>
        
        <div class="form-group">
            <label for="imageInput">Upload Screenshot (JPG/PNG)</label>
            <input type="file" class="form-control" id="imageInput" accept="image/png, image/jpeg">
        </div>

        <!-- Image Preview Section -->
        <div class="preview-container">
            <img id="preview" src="" alt="Image Preview">
        </div>

        <!-- Convert to PDF Button -->
        <button id="convertBtn" class="btn btn-primary btn-block">Convert to PDF</button>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.getElementById('preview');
                imgElement.src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('convertBtn').addEventListener('click', function() {
            const imgElement = document.getElementById('preview');
            if (!imgElement.src) {
                alert('Please upload an image first!');
                return;
            }
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Image to PDF Conversion
            doc.addImage(imgElement.src, 'JPEG', 10, 10, 180, 160); // Adjust width & height as needed
            doc.save('screenshot.pdf');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
