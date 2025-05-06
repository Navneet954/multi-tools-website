<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF to Image Converter</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }
        .container {
            margin-top: 50px;
        }
        .ad-space {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 18px;
            margin: 20px 0;
        }
        .card {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .file-input {
            margin-top: 20px;
            text-align: center;
        }
        .output-image {
            display: block;
            margin: 20px auto;
            max-width: 100%;
        }
        .download-btn {
            display: block;
            margin: 10px auto;
            text-align: center;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
        }
    </style>
</head>
<body>

    <div class="ad-space">
        <p>Ad Space: Promote Your Product Here!</p>
    </div>

    <div class="container">
        <div class="text-center">
            <h1>PDF to Image Converter</h1>
            <p class="lead">Convert PDF pages into images instantly.</p>
        </div>

        <div class="card p-4">
            <div class="file-input">
                <input type="file" id="pdf-upload" accept="application/pdf" class="form-control-file">
                <button id="convert-btn" class="btn btn-primary mt-3">Convert to Image</button>
            </div>

            <div id="output" class="mt-4 text-center"></div>
        </div>
    </div>

    <div class="ad-space">
        <p>Ad Space: Your Ad Here!</p>
    </div>

    <footer>
        <p>Developed by Your Company &copy; 2025</p>
    </footer>

    <!-- Required JS Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

    <script>
        document.getElementById('convert-btn').addEventListener('click', function() {
            const fileInput = document.getElementById('pdf-upload');
            const file = fileInput.files[0];
            
            if (!file) {
                alert("Please select a PDF file.");
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(event) {
                const pdfData = new Uint8Array(event.target.result);
                
                pdfjsLib.getDocument(pdfData).promise.then(function(pdf) {
                    const numPages = pdf.numPages;
                    const outputDiv = document.getElementById('output');
                    outputDiv.innerHTML = ''; // Clear previous images

                    for (let i = 1; i <= numPages; i++) {
                        pdf.getPage(i).then(function(page) {
                            const scale = 1.5;
                            const viewport = page.getViewport({ scale: scale });
                            const canvas = document.createElement('canvas');
                            const context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            page.render({
                                canvasContext: context,
                                viewport: viewport
                            }).promise.then(function() {
                                const img = document.createElement('img');
                                img.src = canvas.toDataURL();
                                img.classList.add('output-image');
                                
                                const downloadBtn = document.createElement('button');
                                downloadBtn.textContent = "Download Image";
                                downloadBtn.classList.add('download-btn');
                                downloadBtn.onclick = function() {
                                    const link = document.createElement('a');
                                    link.href = img.src;
                                    link.download = `pdf_page_${i}.png`;
                                    link.click();
                                };

                                const div = document.createElement('div');
                                div.classList.add('mb-4');
                                div.appendChild(img);
                                div.appendChild(downloadBtn);

                                outputDiv.appendChild(div);
                            });
                        });
                    }
                }).catch(function(error) {
                    alert("Error loading PDF: " + error.message);
                });
            };

            reader.readAsArrayBuffer(file);
        });
    </script>

</body>
</html>
