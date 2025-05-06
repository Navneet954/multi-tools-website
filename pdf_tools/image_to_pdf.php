<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image to PDF Converter</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    .container {
      margin-top: 50px;
    }

    .ad-banner {
      background-color: #f8f9fa;
      padding: 10px;
      text-align: center;
      margin-bottom: 30px;
    }

    .ad-banner-bottom {
      background-color: #f8f9fa;
      padding: 10px;
      text-align: center;
      margin-top: 30px;
    }

    .btn-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .btn-upload {
      margin-right: 10px;
    }

    .image-preview {
      margin-top: 20px;
      text-align: center;
    }

    img {
      max-width: 100%;
      max-height: 400px;
    }

    .footer {
      background-color: #212529;
      color: white;
      text-align: center;
      padding: 10px 0;
    }

  </style>
</head>

<body>

  <!-- Top Advertisement Banner -->
  <div class="ad-banner">
    <p><strong>Top Advertisement</strong>: Your ad space here</p>
  </div>

  <div class="container">
    <h2 class="text-center">Image to PDF Converter</h2>

    <!-- Image Upload Section -->
    <div class="btn-container">
      <input type="file" id="file-input" class="btn btn-primary btn-upload" accept="image/*">
      <button class="btn btn-success" id="generate-pdf">Generate PDF</button>
    </div>

    <!-- Image Preview Section -->
    <div class="image-preview" id="image-preview">
      <p>No image selected yet.</p>
    </div>

  </div>

  <!-- Bottom Advertisement Banner -->
  <div class="ad-banner-bottom">
    <p><strong>Bottom Advertisement</strong>: Your ad space here</p>
  </div>

  <!-- Footer Section -->
  <div class="footer">
    <p>&copy; 2025 Image to PDF Converter. All rights reserved.</p>
  </div>

  <script>
    document.getElementById('file-input').addEventListener('change', function (e) {
      const file = e.target.files[0];
      const reader = new FileReader();

      reader.onload = function (e) {
        const imgElement = document.createElement('img');
        imgElement.src = e.target.result;
        imgElement.onload = function () {
          const previewContainer = document.getElementById('image-preview');
          previewContainer.innerHTML = ''; // Clear previous preview
          previewContainer.appendChild(imgElement);
        };
      };

      reader.readAsDataURL(file);
    });

    document.getElementById('generate-pdf').addEventListener('click', function () {
      const imgElement = document.querySelector('#image-preview img');
      if (imgElement) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.addImage(imgElement, 'JPEG', 15, 40, 180, 160); // You can adjust these parameters
        doc.save('image-to-pdf.pdf');
      } else {
        alert('Please upload an image first.');
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
