<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Cropper with Free Transform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cropper.js CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        #ad-top, #ad-bottom {
            height: 90px;
            background: #ddd;
            color: #555;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 10px;
        }
        #preview {
            max-width: 100%;
            max-height: 70vh;
            margin: 10px 0;
            border: 1px solid #ccc;
        }
        .btn-group {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<!-- Ad Space Top -->
<div id="ad-top">Ad Space Top</div>

<div class="container text-center">
    <h1 class="my-4">PDF Cropper with Free Transform</h1>

    <div class="mb-3">
        <input type="file" id="pdfUpload" accept="application/pdf" class="form-control">
    </div>

    <canvas id="preview" class="border"></canvas>

    <div class="btn-group">
        <button class="btn btn-success" id="downloadBtn" disabled>Download Cropped PDF</button>
    </div>
</div>

<!-- Ad Space Bottom -->
<div id="ad-bottom">Ad Space Bottom</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script>
    let cropper;
    const pdfUpload = document.getElementById('pdfUpload');
    const previewCanvas = document.getElementById('preview');
    const downloadBtn = document.getElementById('downloadBtn');

    pdfUpload.addEventListener('change', async (e) => {
        const file = e.target.files[0];
        if (file && file.type === "application/pdf") {
            const fileReader = new FileReader();
            fileReader.onload = async function() {
                const pdfData = new Uint8Array(this.result);
                const pdf = await pdfjsLib.getDocument({ data: pdfData }).promise;
                const page = await pdf.getPage(1);

                const viewport = page.getViewport({ scale: 2 });
                const context = previewCanvas.getContext('2d');
                previewCanvas.width = viewport.width;
                previewCanvas.height = viewport.height;

                await page.render({
                    canvasContext: context,
                    viewport: viewport
                }).promise;

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(previewCanvas, {
                    viewMode: 0, // Free transform
                    autoCropArea: 0.8,
                    responsive: true,
                    movable: true,
                    zoomable: true,
                    rotatable: true,
                    scalable: true,
                    background: true,
                });

                downloadBtn.disabled = false;
            };
            fileReader.readAsArrayBuffer(file);
        } else {
            alert("Please upload a valid PDF file.");
        }
    });

    downloadBtn.addEventListener('click', () => {
        if (!cropper) return;

        const croppedCanvas = cropper.getCroppedCanvas({
            fillColor: '#fff',
        });

        const croppedImageDataURL = croppedCanvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;

        const pdf = new jsPDF({
            orientation: croppedCanvas.width > croppedCanvas.height ? "l" : "p",
            unit: "px",
            format: [croppedCanvas.width, croppedCanvas.height]
        });

        pdf.addImage(croppedImageDataURL, 'PNG', 0, 0, croppedCanvas.width, croppedCanvas.height);
        pdf.save('cropped.pdf');
    });
</script>

</body>
</html>
