<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF Merger App</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Style -->
  <style>
    body {
      background: #f2f6fc;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .container {
      flex: 1;
      max-width: 600px;
      margin-top: 30px;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 30px;
      background: white;
    }
    .ad-space {
      background: #e0e0e0;
      border-radius: 12px;
      height: 90px;
      margin: 15px 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #555;
    }
    .btn-primary {
      background: linear-gradient(45deg, #4e54c8, #8f94fb);
      border: none;
    }
    .btn-primary:hover {
      background: linear-gradient(45deg, #8f94fb, #4e54c8);
    }
    footer {
      text-align: center;
      padding: 15px;
      font-size: 14px;
      color: #777;
      background: #f8f9fa;
    }
  </style>
</head>

<body>

<div class="container text-center">
  
  <!-- Top Ad Space -->
  <div class="ad-space">Top Ad Space</div>

  <!-- Main Card -->
  <div class="card">
    <h2 class="mb-4">Merge PDF Files</h2>
    
    <div class="mb-3 text-start">
      <label for="pdfFiles" class="form-label">Select PDF Files</label>
      <input class="form-control" type="file" id="pdfFiles" accept="application/pdf" multiple>
    </div>

    <div class="d-grid gap-2">
      <button id="mergeBtn" class="btn btn-primary btn-lg">Merge PDFs</button>
    </div>

    <div id="downloadLink" class="mt-4"></div>
  </div>

  <!-- Bottom Ad Space -->
  <div class="ad-space">Bottom Ad Space</div>

</div>

<footer>
  &copy; 2025 PDF Merger App. All rights reserved.
</footer>

<!-- pdf-lib Library -->
<script src="https://cdn.jsdelivr.net/npm/pdf-lib/dist/pdf-lib.min.js"></script>

<!-- Script -->
<script>
  const mergeBtn = document.getElementById('mergeBtn');
  const pdfFiles = document.getElementById('pdfFiles');
  const downloadLink = document.getElementById('downloadLink');

  mergeBtn.addEventListener('click', async () => {
    const files = pdfFiles.files;
    if (files.length < 2) {
      alert('Please select at least two PDF files to merge.');
      return;
    }

    const mergedPdf = await PDFLib.PDFDocument.create();

    for (const file of files) {
      const bytes = await file.arrayBuffer();
      const pdf = await PDFLib.PDFDocument.load(bytes);
      const copiedPages = await mergedPdf.copyPages(pdf, pdf.getPageIndices());
      copiedPages.forEach(page => mergedPdf.addPage(page));
    }

    const mergedPdfFile = await mergedPdf.save();
    const blob = new Blob([mergedPdfFile], { type: 'application/pdf' });
    const url = URL.createObjectURL(blob);

    downloadLink.innerHTML = `
      <a href="${url}" download="merged.pdf" class="btn btn-success btn-lg mt-3">
        Download Merged PDF
      </a>
    `;
  });
</script>

</body>
</html>
