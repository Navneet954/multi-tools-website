<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PDF to Excel Converter</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
</head>
<body>

<div class="container my-5">
  <h2 class="text-center mb-4">Convert PDF to Excel</h2>

  <div class="text-center mb-4">
    <input type="file" id="pdf-file" class="form-control mb-3" accept="application/pdf">
    <button class="btn btn-primary" onclick="convertPDFToExcel()">Convert to Excel</button>
  </div>

  <div class="progress mb-4" style="height: 25px;">
    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="progress-bar" style="width: 0%;">0%</div>
  </div>

  <div id="excel-table-container"></div>

  <div class="text-center mt-3">
    <button class="btn btn-success" id="download-btn" style="display: none;" onclick="downloadExcel()">Download Excel</button>
  </div>
</div>

<script>
  function convertPDFToExcel() {
    const fileInput = document.getElementById('pdf-file');
    const file = fileInput.files[0];
    const progressBar = document.getElementById('progress-bar');
    const downloadBtn = document.getElementById('download-btn');

    if (!file) {
      alert('⚠️ Please select a PDF file first.');
      return;
    }

    progressBar.style.width = '30%';
    progressBar.innerHTML = '30%';

    const reader = new FileReader();
    reader.onload = function(e) {
      const arrayBuffer = e.target.result;
      const pdfData = new Uint8Array(arrayBuffer);

      progressBar.style.width = '50%';
      progressBar.innerHTML = '50%';

      pdfjsLib.getDocument({data: pdfData}).promise.then(pdf => {
        let pdfText = '';
        let numPages = pdf.numPages;
        let promises = [];

        for (let i = 1; i <= numPages; i++) {
          promises.push(pdf.getPage(i).then(page => {
            return page.getTextContent().then(textContent => {
              textContent.items.forEach(item => {
                pdfText += item.str + ' ';
              });
            });
          }));
        }

        Promise.all(promises).then(() => {
          progressBar.style.width = '80%';
          progressBar.innerHTML = '80%';
          displayExcelTable(pdfText);
          progressBar.style.width = '100%';
          progressBar.innerHTML = '100%';
          downloadBtn.style.display = 'inline-block'; // Show Download button
          setTimeout(() => {
            progressBar.style.width = '0%';
            progressBar.innerHTML = '0%';
          }, 800);
        });
      }).catch(error => {
        alert('❌ Error reading PDF: ' + error.message);
        progressBar.style.width = '0%';
        progressBar.innerHTML = '0%';
      });
    };

    reader.readAsArrayBuffer(file);
  }

  function displayExcelTable(pdfText) {
    const words = pdfText.trim().split(/\s+/);
    let tableHTML = '<div class="table-responsive"><table class="table table-striped table-bordered" id="excel-table"><thead class="thead-dark"><tr>';

    // Simulate 5 columns
    for (let i = 1; i <= 5; i++) {
      tableHTML += `<th>Column ${i}</th>`;
    }
    tableHTML += '</tr></thead><tbody><tr>';

    words.forEach((word, index) => {
      tableHTML += `<td>${word}</td>`;
      if ((index + 1) % 5 === 0) {
        tableHTML += '</tr><tr>';
      }
    });

    tableHTML += '</tr></tbody></table></div>';
    document.getElementById('excel-table-container').innerHTML = tableHTML;
  }

  function downloadExcel() {
    const table = document.getElementById('excel-table');
    let tableHTML = table.outerHTML.replace(/ /g, '%20');

    const filename = 'converted_table.xls';
    const downloadLink = document.createElement('a');
    document.body.appendChild(downloadLink);

    downloadLink.href = 'data:application/vnd.ms-excel,' + tableHTML;
    downloadLink.download = filename;
    downloadLink.click();
    document.body.removeChild(downloadLink);
  }
</script>

</body>
</html>
