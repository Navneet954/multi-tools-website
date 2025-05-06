<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF Splitter App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      padding-top: 20px;
      padding-bottom: 20px;
    }
    .ad-space {
      background: #e0e0e0;
      height: 100px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 20px;
      color: #555;
      border-radius: 8px;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .btn-primary {
      border-radius: 30px;
      padding-left: 20px;
      padding-right: 20px;
    }
    .footer-ad {
      margin-top: 30px;
    }
  </style>
</head>

<body>

<div class="container">
  <!-- Top Ad Space -->
  <div class="ad-space">
    Top Ad Space
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4">
        <h2 class="text-center mb-4">PDF Splitter</h2>

        <div class="mb-3">
          <label for="pdfFile" class="form-label">Choose a PDF file</label>
          <input class="form-control" type="file" id="pdfFile" accept="application/pdf">
        </div>

        <div class="mb-3">
          <label for="pageNumber" class="form-label">Page Number to Extract</label>
          <input type="number" class="form-control" id="pageNumber" placeholder="Enter page number (e.g., 1)">
        </div>

        <div class="d-grid gap-2">
          <button class="btn btn-primary" onclick="splitPDF()">Split PDF</button>
        </div>

        <div id="downloadLink" class="mt-4 text-center"></div>
      </div>
    </div>
  </div>

  <!-- Bottom Ad Space -->
  <div class="ad-space footer-ad">
    Bottom Ad Space
  </div>
</div>

<!-- PDF-lib JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>

<script>
  async function splitPDF() {
    const fileInput = document.getElementById('pdfFile');
    const pageInput = document.getElementById('pageNumber');
    const downloadLink = document.getElementById('downloadLink');

    if (!fileInput.files.length) {
      alert('Please select a PDF file!');
      return;
    }

    if (!pageInput.value || pageInput.value <= 0) {
      alert('Please enter a valid page number!');
      return;
    }

    const file = fileInput.files[0];
    const pageNum = parseInt(pageInput.value);

    const arrayBuffer = await file.arrayBuffer();
    const pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);

    if (pageNum > pdfDoc.getPageCount()) {
      alert('Page number exceeds total pages!');
      return;
    }

    const newPdf = await PDFLib.PDFDocument.create();
    const [copiedPage] = await newPdf.copyPages(pdfDoc, [pageNum - 1]);
    newPdf.addPage(copiedPage);

    const pdfBytes = await newPdf.save();
    const blob = new Blob([pdfBytes], { type: 'application/pdf' });

    const url = URL.createObjectURL(blob);
    downloadLink.innerHTML = `
      <a href="${url}" class="btn btn-success" download="split_page.pdf">Download Split Page</a>
    `;
  }
</script>

</body>
</html>
