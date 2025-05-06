<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF to Word Converter</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      padding: 20px;
    }
    .ad-space {
      background: #ddd;
      text-align: center;
      padding: 20px;
      margin-bottom: 20px;
      font-size: 1.2rem;
      color: #555;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .btn-primary {
      border-radius: 30px;
      padding: 10px 30px;
    }
  </style>
</head>
<body>

<div class="ad-space">[Top Advertisement]</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4">
        <h2 class="text-center mb-4">PDF to Word Converter</h2>
        <div class="mb-3">
          <input type="file" id="pdfFile" accept="application/pdf" class="form-control">
        </div>
        <div class="d-grid gap-2">
          <button class="btn btn-primary" onclick="convertPDFtoWord()">Convert to Word</button>
        </div>
        <div id="output" class="mt-4 text-center"></div>
      </div>
    </div>
  </div>
</div>

<div class="ad-space mt-5">[Bottom Advertisement]</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<script>
  async function convertPDFtoWord() {
    const fileInput = document.getElementById('pdfFile');
    const output = document.getElementById('output');
    
    if (!fileInput.files.length) {
      output.innerHTML = '<div class="alert alert-warning">Please select a PDF file first.</div>';
      return;
    }
    
    const file = fileInput.files[0];
    const reader = new FileReader();
    
    reader.onload = async function(e) {
      const typedarray = new Uint8Array(e.target.result);
      
      const pdf = await pdfjsLib.getDocument({data: typedarray}).promise;
      let textContent = '';
      
      for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
        const page = await pdf.getPage(pageNum);
        const text = await page.getTextContent();
        const pageText = text.items.map(item => item.str).join(' ');
        textContent += pageText + '\n\n';
      }
      
      const blob = new Blob(["\ufeff" + textContent], {
        type: "application/msword"
      });

      saveAs(blob, "converted.doc");
      output.innerHTML = '<div class="alert alert-success">Word file has been downloaded!</div>';
    };
    
    reader.readAsArrayBuffer(file);
  }
</script>

</body>
</html>
