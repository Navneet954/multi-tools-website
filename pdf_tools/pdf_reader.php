<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Reader App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jsPDF Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
        }
        .content-area {
            padding: 20px;
            background-color: #f7f7f7;
            min-height: 70vh;
            border-radius: 8px;
        }
        .ad-space {
            background-color: #e1e1e1;
            height: 80px;
            text-align: center;
            line-height: 80px;
            font-weight: bold;
            color: #333;
        }
        .pdf-container {
            text-align: center;
            margin-top: 20px;
        }
        .pdf-file-input {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <!-- Top Ad Space -->
    <div class="ad-space">
        Top Ad Space (Could be an Ad banner)
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <!-- File Input to Load PDF -->
                <div class="pdf-file-input">
                    <input type="file" id="pdf-file" class="form-control" accept=".pdf">
                </div>
                
                <div class="content-area">
                    <div class="pdf-container">
                        <canvas id="pdf-render"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Ad Space -->
    <div class="ad-space">
        Bottom Ad Space (Could be another Ad banner)
    </div>

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to Render PDF
        const renderPDF = (url) => {
            const canvas = document.getElementById('pdf-render');
            const ctx = canvas.getContext('2d');
            const loadingTask = window.pdfjsLib.getDocument(url);
            
            loadingTask.promise.then((pdf) => {
                pdf.getPage(1).then((page) => {
                    const viewport = page.getViewport({ scale: 1 });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    page.render(renderContext);
                });
            });
        };

        // Handle File Input Change (PDF)
        document.getElementById('pdf-file').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = function (event) {
                const pdfData = event.target.result;
                renderPDF(pdfData);
            };
            reader.readAsArrayBuffer(file);
        });

        // Load PDF.js Library
        if (typeof pdfjsLib === 'undefined') {
            const script = document.createElement('script');
            script.src = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js";
            document.head.appendChild(script);
        }
    </script>

</body>
</html>
