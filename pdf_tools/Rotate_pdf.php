<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Rotation Tool</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <style>
        #pdfViewer {
            border: 1px solid #ddd;
            margin: 20px 0;
        }
        .rotation-controls {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">PDF Rotation Tool</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="pdfFile" class="form-label">Choose PDF File</label>
                            <input type="file" class="form-control" id="pdfFile" accept=".pdf">
                        </div>

                        <div class="rotation-controls text-center">
                            <button class="btn btn-primary me-2" onclick="rotatePDF(-90)">Rotate Left</button>
                            <button class="btn btn-primary" onclick="rotatePDF(90)">Rotate Right</button>
                        </div>

                        <canvas id="pdfViewer" class="w-100"></canvas>

                        <div class="text-center mt-3">
                            <button class="btn btn-success" onclick="savePDF()">Save Rotated PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>

    <script>
        let currentRotation = 0;
        let pdfDoc = null;
        let pageNum = 1;
        let canvas = document.getElementById('pdfViewer');
        let ctx = canvas.getContext('2d');

        document.getElementById('pdfFile').addEventListener('change', function(e) {
            let file = e.target.files[0];
            if (file.type !== 'application/pdf') {
                alert('Please select a PDF file');
                return;
            }

            let reader = new FileReader();
            reader.onload = function(event) {
                loadPDF(event.target.result);
            };
            reader.readAsArrayBuffer(file);
        });

        async function loadPDF(pdfData) {
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
            
            try {
                pdfDoc = await pdfjsLib.getDocument({data: pdfData}).promise;
                renderPage();
            } catch (error) {
                console.error('Error loading PDF:', error);
                alert('Error loading PDF file');
            }
        }

        async function renderPage() {
            if (!pdfDoc) return;

            const page = await pdfDoc.getPage(pageNum);
            const viewport = page.getViewport({scale: 1.5, rotation: currentRotation});

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };

            await page.render(renderContext);
        }

        function rotatePDF(degrees) {
            if (!pdfDoc) {
                alert('Please select a PDF file first');
                return;
            }
            currentRotation = (currentRotation + degrees) % 360;
            renderPage();
        }

        async function savePDF() {
            if (!pdfDoc) {
                alert('Please select a PDF file first');
                return;
            }

            try {
                const PDFLib = window.PDFLib;
                const existingPdfBytes = await fetch(pdfDoc.transport.source.url).then(res => res.arrayBuffer());
                const pdfDocument = await PDFLib.PDFDocument.load(existingPdfBytes);
                const pages = pdfDocument.getPages();
                
                pages[0].setRotation(PDFLib.degrees(currentRotation));
                
                const pdfBytes = await pdfDocument.save();
                const blob = new Blob([pdfBytes], {type: 'application/pdf'});

                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'rotated_document.pdf';
                link.click();
            } catch (error) {
                console.error('Error saving PDF:', error);
                alert('Error saving the rotated PDF');
            }
        }
    </script>
</body>
</html>
