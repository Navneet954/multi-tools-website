<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Table Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .math-table {
            width: 100%;
            border-collapse: collapse;
        }
        .math-table th, .math-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Math Table Generator</h2>
                <div class="form-group mb-3">
                    <label for="number">Enter a number:</label>
                    <input type="number" class="form-control" id="number" min="1" max="100">
                </div>
                <div class="form-group mb-3">
                    <label for="range">Enter range:</label>
                    <input type="number" class="form-control" id="range" min="1" max="50" value="10">
                </div>
                <button class="btn btn-primary w-100" onclick="generateTable()">Generate Table</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <div class="table-container">
                    <div id="tableOutput"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function generateTable() {
            const number = parseInt(document.getElementById('number').value);
            const range = parseInt(document.getElementById('range').value);
            
            if (!number || !range) {
                alert('Please enter valid numbers');
                return;
            }

            let tableHTML = '<table class="math-table table table-striped">';
            tableHTML += '<thead><tr><th>Multiplication</th><th>Result</th></tr></thead><tbody>';

            for (let i = 1; i <= range; i++) {
                tableHTML += `<tr>
                    <td>${number} × ${i}</td>
                    <td>${number * i}</td>
                </tr>`;
            }

            tableHTML += '</tbody></table>';
            document.getElementById('tableOutput').innerHTML = tableHTML;
        }
    </script>
</body>
</html>
