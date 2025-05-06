<?php
// Handle table data submission
$tableData = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate_table'])) {
    $rows = (int)$_POST['rows'];
    $cols = (int)$_POST['cols'];
    if ($rows > 0 && $cols > 0) {
        $tableData = ['rows' => $rows, 'cols' => $cols];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dynamic HTML Table Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .ad-space {
            background-color: #e9ecef;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: bold;
            color: #6c757d;
        }
        .preview-table {
            margin-top: 30px;
        }
        table {
            background: #fff;
        }
    </style>
</head>
<body>

<!-- Top Ad Space -->
<div class="container mt-4">
    <div class="ad-space">
        Top Advertisement Space
    </div>
</div>

<div class="container mt-3 mb-5">
    <h2 class="text-center mb-4">Dynamic HTML Table Generator</h2>

    <!-- Table Dimension Form -->
    <form method="POST" class="row g-3 justify-content-center">
        <div class="col-md-3">
            <label for="rows" class="form-label">Number of Rows</label>
            <input type="number" min="1" class="form-control" id="rows" name="rows" required>
        </div>
        <div class="col-md-3">
            <label for="cols" class="form-label">Number of Columns</label>
            <input type="number" min="1" class="form-control" id="cols" name="cols" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" name="generate_table" class="btn btn-primary w-100">Generate Table</button>
        </div>
    </form>

    <?php if (!empty($tableData)): ?>
    <form id="dataForm" class="mt-5">
        <h4 class="mb-3">Enter Table Data</h4>
        <div id="tableInputs"></div>
        <button type="button" class="btn btn-success mt-3" onclick="generatePreview()">Preview Table</button>
    </form>

    <!-- Table Preview -->
    <div id="tablePreview" class="preview-table mt-5"></div>

    <script>
        const rows = <?= $tableData['rows'] ?>;
        const cols = <?= $tableData['cols'] ?>;
        const tableInputs = document.getElementById('tableInputs');

        // Create input fields dynamically
        for (let i = 0; i < rows; i++) {
            const rowDiv = document.createElement('div');
            rowDiv.className = "row mb-2";
            for (let j = 0; j < cols; j++) {
                const colDiv = document.createElement('div');
                colDiv.className = "col";
                colDiv.innerHTML = `<input type="text" class="form-control" name="cell_${i}_${j}" placeholder="Row ${i+1} Col ${j+1}">`;
                rowDiv.appendChild(colDiv);
            }
            tableInputs.appendChild(rowDiv);
        }

        // Generate table preview
        function generatePreview() {
            let tableHTML = `<table class="table table-bordered table-striped text-center"><thead><tr>`;
            for (let j = 0; j < cols; j++) {
                tableHTML += `<th>Column ${j+1}</th>`;
            }
            tableHTML += `</tr></thead><tbody>`;

            for (let i = 0; i < rows; i++) {
                tableHTML += `<tr>`;
                for (let j = 0; j < cols; j++) {
                    const value = document.querySelector(`[name="cell_${i}_${j}"]`).value || "-";
                    tableHTML += `<td>${value}</td>`;
                }
                tableHTML += `</tr>`;
            }
            tableHTML += `</tbody></table>`;

            document.getElementById('tablePreview').innerHTML = tableHTML;
        }
    </script>
    <?php endif; ?>
</div>

<!-- Bottom Ad Space -->
<div class="container">
    <div class="ad-space">
        Bottom Advertisement Space
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
