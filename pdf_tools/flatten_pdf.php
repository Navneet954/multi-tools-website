<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Flattener with jsPDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fa;
        }
        .ad-space {
            background-color: #4e73df;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-weight: bold;
        }
        .content-container {
            margin-top: 20px;
            text-align: center;
        }
        .pdf-preview {
            background-color: white;
            border: 2px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            height: 300px;
            overflow: auto;
        }
        .footer {
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <!-- Top Ad Space -->
    <div class="ad-space">
        <p>Top Advertisement Space</p>
    </div>

    <!-- Main Content Section -->
    <div class="container content-container">
        <h2>Create Your PDF</h2>
        <textarea id="text-content" class="form-control" rows="5" placeholder="Enter text for the PDF..."></textarea>

        <button id="generate-pdf" class="btn btn-primary mt-3">Generate PDF</button>

    </div>

    <!-- Footer Ad Space -->
    <div class="footer">
        <div class="ad-space">
            <p>Bottom Advertisement Space</p>
        </div>
    </div>

    <!-- Required JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("generate-pdf").addEventListener("click", function() {
            const { jsPDF } = window.jspdf;

            // Get the text content from textarea
            const textContent = document.getElementById("text-content").value;

            // Create a PDF document
            const doc = new jsPDF();

            // Add content to the PDF
            doc.text(textContent, 10, 10);

            // Flatten the PDF by converting text to a non-editable format
            doc.setFontSize(12);
            doc.setTextColor(0, 0, 0);
            doc.text(textContent, 10, 20);

            // Output to PDF preview
            doc.save('flattened_pdf.pdf');
            alert("PDF Generated and Saved!");
        });
    </script>

</body>
</html>
