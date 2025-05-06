<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF Watermark App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      padding-top: 20px;
    }
    .container {
      max-width: 900px;
      margin: 0 auto;
    }
    .header, .footer {
      background-color: #343a40;
      color: white;
      text-align: center;
      padding: 10px;
      margin-bottom: 20px;
    }
    .header h1, .footer p {
      margin: 0;
    }
    .main-content {
      padding: 30px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .file-upload input {
      margin-bottom: 20px;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #004085;
    }
    .footer {
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <div class="header">
    <h1>PDF Watermark App</h1>
  </div>

  <div class="container main-content">
    <div class="file-upload">
      <h3>Upload PDF</h3>
      <input type="file" id="pdf-upload" class="form-control" accept="application/pdf">
      <input type="text" id="watermark-text" class="form-control" placeholder="Enter watermark text" style="margin-top: 10px;">
      <button class="btn btn-primary" id="add-watermark">Add Watermark</button>
    </div>
    
    <div class="mt-4">
      <h3>Download PDF with Watermark</h3>
      <button class="btn btn-success" id="download-pdf" disabled>Download PDF</button>
    </div>
  </div>

  <div class="footer">
    <p>&copy; 2025 PDF Watermark App | <a href="#" class="text-white">Privacy Policy</a></p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
  <script>
    document.getElementById('add-watermark').addEventListener('click', async function() {
      const fileInput = document.getElementById('pdf-upload');
      const watermarkText = document.getElementById('watermark-text').value;

      if (!fileInput.files.length) {
        alert('Please upload a PDF first.');
        return;
      }

      if (!watermarkText) {
        alert('Please enter a watermark text.');
        return;
      }

      const file = fileInput.files[0];
      const reader = new FileReader();

      reader.onload = async function(e) {
        const pdfBytes = new Uint8Array(e.target.result);
        const pdfDoc = await PDFLib.PDFDocument.load(pdfBytes);
        
        // Adding watermark to each page
        const pages = pdfDoc.getPages();
        pages.forEach((page) => {
          const { width, height } = page.getSize();
          page.drawText(watermarkText, {
            x: width / 4,
            y: height / 2,
            size: 50,
            color: PDFLib.rgb(0.75, 0.75, 0.75),
            rotate: PDFLib.degrees(45),
          });
        });

        const modifiedPdfBytes = await pdfDoc.save();

        // Enable the download button after watermark is added
        document.getElementById('download-pdf').disabled = false;

        // Download the modified PDF
        document.getElementById('download-pdf').addEventListener('click', function() {
          const blob = new Blob([modifiedPdfBytes], { type: 'application/pdf' });
          const link = document.createElement('a');
          link.href = URL.createObjectURL(blob);
          link.download = 'watermarked.pdf';
          link.click();
        });
      };

      reader.readAsArrayBuffer(file);
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
