<?php
// Initialize variables
$columns = isset($_POST['columns']) ? intval($_POST['columns']) : 3;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 3;
$gap = isset($_POST['gap']) ? intval($_POST['gap']) : 10;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSS Grid Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: #f8f9fa;
            padding-top: 20px;
            font-family: 'Segoe UI', sans-serif;
        }
        .ad-space {
            background: #e2e3e5;
            color: #6c757d;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px dashed #adb5bd;
            font-size: 1.2rem;
        }
        .grid-preview {
            display: grid;
            background: #fff;
            padding: 20px;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
        }
        .grid-item {
            background: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border-radius: 5px;
        }
        .form-label {
            font-weight: 500;
        }
        footer {
            margin-top: 40px;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Top Ad Space -->
    <div class="ad-space">
        Your Ad Here (Top)
    </div>

    <h1 class="text-center mb-4">🎨 CSS Grid Generator</h1>

    <form method="post" class="row g-3 mb-5">
        <div class="col-md-4">
            <label class="form-label">Columns</label>
            <input type="number" name="columns" class="form-control" min="1" max="12" value="<?php echo $columns; ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Rows</label>
            <input type="number" name="rows" class="form-control" min="1" max="12" value="<?php echo $rows; ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Gap (px)</label>
            <input type="number" name="gap" class="form-control" min="0" value="<?php echo $gap; ?>" required>
        </div>
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary px-5 mt-3">Generate Grid</button>
        </div>
    </form>

    <h3 class="text-center mb-3">Live Preview</h3>
    
    <div id="grid" class="grid-preview mb-5" 
        style="grid-template-columns: repeat(<?php echo $columns; ?>, 1fr); 
               grid-template-rows: repeat(<?php echo $rows; ?>, 100px); 
               gap: <?php echo $gap; ?>px;">
        <?php 
            $totalItems = $columns * $rows;
            for ($i = 1; $i <= $totalItems; $i++) {
                echo '<div class="grid-item">'.$i.'</div>';
            }
        ?>
    </div>

    <!-- Bottom Ad Space -->
    <div class="ad-space">
        Your Ad Here (Bottom)
    </div>

    <footer class="text-center py-3">
        © 2025 CSS Grid Generator | Made with ❤️
    </footer>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
