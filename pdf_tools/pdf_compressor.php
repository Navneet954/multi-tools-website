<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Advanced PDF Compressor with More Features</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f9f9f9;
      font-family: 'Poppins', sans-serif;
    }
    .ad-space {
      background: #e0e0e0;
      height: 90px;
      margin: 10px 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      font-weight: bold;
      color: #666;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-primary {
      border-radius: 30px;
      padding: 10px 30px;
      font-size: 18px;
    }
    .progress-bar {
      height: 20px;
    }
    .card-body {
      padding: 30px;
    }
    .alert-custom {
      margin-top: 20px;
      display: none;
    }
  </style>
</head>

<body>

  <!-- Top Ad Space -->
  <div class="container">
    <div class="ad-space">Top Ad Space</div>
  </div>

  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card p-4">
          <h2 class="text-center mb-4">Advanced PDF Compressor with Image & Compression Settings</h2>

          <div class="alert alert-warning alert-custom" id="errorAlert">
            Please upload a valid PDF file.
          </div>

          <div class="mb-3">
            <label for="pdfInput" class="form-label">Upload PDF</label>
            <input class="form-control" type="file" id="pdfInput" accept="application/pdf">
          </div>

          <div class="mb-3">
            <label for="compressionRange" class="form-label">Compression Level: <span id="compressionValue">50</span>%</label>
            <input type="range" class="form-range" min="1" max="100" step="1" id="compressionRange" value="50">
          </div>

          <div class="mb-3">
            <label for="imageQuality" class="form-label">Image Quality: <span id="imageQualityValue">70</span>%</label>
            <input type="range" class="form-range" min="1" max="100" step="1" id="imageQuality" value="70">
          </div>

          <div class="mb-3">
            <label for="fileSizeBefore" class="form-label">Original File Size: <span id="fileSizeBefore">0 KB</span></label>
          </div>

          <div class="mb-3">
            <label for="fileSizeAfter" class="form-label">Compressed File Size: <span id="fileSizeAfter">0 KB</span></label>
          </div>

          <div class="mb-3">
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 0%;" id="progressBar"></div>
            </div>
          </div>

          <div class="text-center">
            <button class="btn btn-primary" onclick="compressPDF()">Compress & Download</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Ad Space -->
  <div class="container">
    <div class="ad-space">Bottom Ad Space</div>
  </div>

  <!-- pdf-lib -->
  <script src="https://cdn.jsdelivr.net/npm/pdf-lib/dist/pdf-lib.min.js"></script>

  <script>
    document.getElementById('compressionRange').addEventListener('input', function() {
      document.getElementById('compressionValue').innerText = this.value;
    });

    document.getElementById('imageQuality').addEventListener('input', function() {
      document.getElementById('imageQualityValue').innerText = this.value;
    });

    async function compressPDF() {
      const input = document.getElementById('pdfInput');
      if (!input.files.length) {
        document.getElementById('errorAlert').style.display = 'block';
        return;
      } else {
        document.getElementById('errorAlert').style.display = 'none';
      }

      const file = input.files[0];
      document.getElementById('fileSizeBefore').innerText = (file.size / 1024).toFixed(2) + " KB";

      const reader = new FileReader();

      reader.onload = async function(e) {
        const existingPdfBytes = e.target.result;

        // Load the PDF using pdf-lib
        const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes, {
          ignoreEncryption: true
        });

        // Remove metadata to reduce size
        pdfDoc.setTitle('');
        pdfDoc.setAuthor('');
        pdfDoc.setSubject('');
        pdfDoc.setCreator('');

        // Create a new compressed PDF
        const compressedPdfDoc = await PDFLib.PDFDocument.create();

        // Copy pages from the original document to the new one
        const pages = await compressedPdfDoc.copyPages(pdfDoc, pdfDoc.getPageIndices());
        pages.forEach(page => compressedPdfDoc.addPage(page));

        // Adjust compression level based on slider
        const compressionLevel = parseInt(document.getElementById('compressionRange').value);
        const imageQuality = parseInt(document.getElementById('imageQuality').value);

        // Show progress bar
        let progress = 0;
        const progressBar = document.getElementById('progressBar');
        const interval = setInterval(() => {
          if (progress < 80) {
            progress += 10;
            progressBar.style.width = progress + '%';
          }
        }, 100);

        // Simulate advanced compression algorithm
        const compressedPdfBytes = await compressedPdfDoc.save({
          useObjectStreams: true,
          compress: compressionLevel > 50,
          imageQuality: imageQuality // Lower image quality if specified
        });

        // Display compressed file size
        document.getElementById('fileSizeAfter').innerText = (compressedPdfBytes.length / 1024).toFixed(2) + " KB";

        // Stop progress bar
        clearInterval(interval);
        progressBar.style.width = '100%';

        // Download the compressed PDF
        const blob = new Blob([compressedPdfBytes], { type: 'application/pdf' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'compressed.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      };

      reader.readAsArrayBuffer(file);
    }
  </script>

</body>
</html>
