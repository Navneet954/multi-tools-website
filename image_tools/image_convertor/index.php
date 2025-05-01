<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Image Tools</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      padding-top: 30px;
    }
    .card-img-top {
      max-height: 200px;
      object-fit: cover;
    }
    .card-body {
      text-align: center;
    }
    .card-title {
      font-size: 1.25rem;
      font-weight: bold;
    }
    .card-text {
      font-size: 1rem;
      margin-bottom: 1.5rem;
    }
    .btn-tools {
      background-color: #007bff;
      color: #fff;
      border-radius: 5px;
      padding: 10px 20px;
      text-transform: uppercase;
    }
    .btn-tools:hover {
      background-color: #0056b3;
    }
    .icon-wrapper {
      font-size: 50px;
      color: #007bff;
      margin-bottom: 15px;
      text-align: center
    }
  </style>
</head>
<body>

<div class="container">
  <h1 class="text-center mb-5">Image Tools</h1>

  <!-- Bootstrap Grid for Image Tools Cards -->
  <div class="row">

    <!-- JPG to PNG Tool Card -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-filetype-jpg"></i> <i class="bi bi-arrow-right text-center"></i> <i class="bi bi-filetype-png"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">JPG to PNG</h5>
          <p class="card-text">Easily convert your JPG images into transparent or high-quality PNG files.</p>
          <a href="jpg2png.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>

    <!-- PNG to JPG Tool Card -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-filetype-png"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-jpg"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">PNG to JPG</h5>
          <p class="card-text">Convert PNG images into lightweight JPG format quickly and easily.</p>
          <a href="png2jpg.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>

    <!-- JPG to BMP Tool Card -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-filetype-jpg"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-file-earmark-image"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">JPG to BMP</h5>
          <p class="card-text">Convert JPG files to BMP format for uncompressed high-quality images.</p>
          <a href="jpg2bmp.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>

    <!-- BMP to JPG Tool Card -->
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-file-earmark-image"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-jpg"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">BMP to JPG</h5>
          <p class="card-text">Convert large BMP images into smaller JPG files without losing much quality.</p>
          <a href="bmp2jpg.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-file-earmark-image"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-png"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">BMP to PNG</h5>
          <p class="card-text">Convert large BMP images into smaller JPG files without losing much quality.</p>
          <a href="bmp2png.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-file-earmark-image"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-png"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">JPG to Gif</h5>
          <p class="card-text">Convert large BMP images into smaller JPG files without losing much quality.</p>
          <a href="jpg2gif.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-filetype-png"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-gif"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">PNG to GIF</h5>
          <p class="card-text">Convert large BMP images into smaller JPG files without losing much quality.</p>
          <a href="png2gif.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-filetype-png"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-gif"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">JPG to Webp</h5>
          <p class="card-text">Convert large BMP images into smaller JPG files without losing much quality.</p>
          <a href="jpg2webp.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-filetype-png"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-gif"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">Webp to JPG</h5>
          <p class="card-text">Convert large BMP images into smaller JPG files without losing much quality.</p>
          <a href="webp2jpg.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-filetype-png"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-gif"></i>
        </div>
        <div class="card-body">
          <h5 class="card-title">Webp to PNG</h5>
          <p class="card-text">Convert large BMP images into smaller JPG files without losing much quality.</p>
          <a href="webp2png.php" class="btn btn-tools">Use Tool</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
        <div class="icon-wrapper mt-4">
          <i class="bi bi-filetype-png"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-gif"></i>
        </div>
        <div class="card-body">
            <h5 class="card-title">PNG to Webp</h5>
            <p class="card-text">Convert large BMP images into smaller JPG files without losing much quality.</p>
            <a href="pngtowebp.php" class="btn btn-tools">Use Tool</a>
        </div>
    </div>
</div>
<div class="col-md-4 mb-4">
  <div class="card">
    <div class="icon-wrapper mt-4">
      <i class="bi bi-filetype-png"></i> <i class="bi bi-arrow-right"></i> <i class="bi bi-filetype-gif"></i>
    </div>
    <div class="card-body">
      <h5 class="card-title">Image 2 Base64</h5>
      <p class="card-text">Convert large BMP images into smaller JPG files without losing much quality.</p>
      <a href="image2Base64.php" class="btn btn-tools">Use Tool</a>
    </div>
  </div>
</div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
