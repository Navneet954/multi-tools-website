<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Grid Builder</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .ad-space {
            background-color: #ccc;
            height: 60px;
            margin-bottom: 20px;
            text-align: center;
            line-height: 60px;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .preview-section {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
        }
        .grid-item {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }
        .grid-item:hover {
            transform: scale(1.05);
        }
        .grid-builder {
            margin-bottom: 20px;
        }
        .card {
            border-radius: 10px;
        }
        .section-heading {
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: bold;
        }
        .help-text {
            font-size: 12px;
            color: #6c757d;
        }
        .btn-export {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn-export:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <!-- Ad Space Top -->
    <div class="ad-space">
        Ad Space (Top)
    </div>

    <div class="container">
        <h1 class="text-center">Bootstrap 5 Grid Builder</h1>

        <!-- Grid Builder Form -->
        <div class="grid-builder">
            <div class="card">
                <div class="card-body">
                    <form id="grid-builder-form">
                        <div class="mb-3">
                            <label for="rows" class="form-label">Number of Rows</label>
                            <input type="number" class="form-control" id="rows" value="3" min="1" max="5">
                            <small class="help-text">Choose the number of rows for your grid (1-5).</small>
                        </div>
                        <div class="mb-3">
                            <label for="columns" class="form-label">Number of Columns</label>
                            <input type="number" class="form-control" id="columns" value="3" min="1" max="12">
                            <small class="help-text">Choose the number of columns for your grid (1-12).</small>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="generateGrid()">Generate Grid</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview Section -->
        <div class="preview-section">
            <h4 class="text-center">Grid Preview</h4>
            <div id="grid-preview" class="row row-cols-1 row-cols-md-3">
                <!-- Grid Items will be inserted here dynamically -->
            </div>
        </div>

        <!-- Export Button -->
        <button class="btn btn-export" onclick="exportGrid()">Export Grid HTML</button>

    </div>

    <!-- Ad Space Bottom -->
    <div class="ad-space">
        Ad Space (Bottom)
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function generateGrid() {
            // Get user input values
            let rows = parseInt(document.getElementById('rows').value);
            let columns = parseInt(document.getElementById('columns').value);
            let gridPreview = document.getElementById('grid-preview');

            // Clear previous preview
            gridPreview.innerHTML = '';

            // Check for valid input values
            if (rows < 1 || columns < 1 || rows > 5 || columns > 12) {
                alert("Please enter valid numbers for rows (1-5) and columns (1-12).");
                return;
            }

            // Generate grid
            for (let i = 0; i < rows; i++) {
                let row = document.createElement('div');
                row.classList.add('row', 'g-3');

                // Create columns
                for (let j = 0; j < columns; j++) {
                    let col = document.createElement('div');
                    col.classList.add('col', `col-${12 / columns}`);
                    let gridItem = document.createElement('div');
                    gridItem.classList.add('grid-item');
                    gridItem.innerText = `Item ${i * columns + j + 1}`;
                    col.appendChild(gridItem);
                    row.appendChild(col);
                }

                gridPreview.appendChild(row);
            }
        }

        function exportGrid() {
            let gridPreview = document.getElementById('grid-preview');
            let gridHTML = gridPreview.outerHTML;
            let blob = new Blob([gridHTML], { type: 'text/html' });
            let link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'grid_layout.html';
            link.click();
        }

        // Initialize grid preview on page load
        generateGrid();
    </script>

</body>
</html>
