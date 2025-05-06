<?php
// sql_formatter.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQL Formatter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 50px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        }
        .btn-format {
            background: #007bff;
            color: white;
            font-weight: bold;
        }
        .btn-format:hover {
            background: #0056b3;
        }
        .preview-box {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            min-height: 200px;
            overflow: auto;
            white-space: pre-wrap;
            font-family: monospace;
            border: 1px solid #ddd;
        }
        .section-title {
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
            color: #343a40;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <h1 class="text-center mb-4">🛠️ SQL Formatter Tool</h1>

            <div class="card p-4 mb-4">
                <h5 class="section-title">Enter your SQL Query</h5>

                <textarea id="sqlInput" class="form-control mb-3" rows="8" placeholder="Paste your SQL query here..."></textarea>

                <div class="d-grid">
                    <button class="btn btn-format" onclick="formatSQL()">Format SQL</button>
                </div>
            </div>

            <div class="card p-4">
                <h5 class="section-title">Formatted SQL Preview</h5>

                <div id="preview" class="preview-box"></div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS + dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Basic SQL Formatter
function formatSQL() {
    let sql = document.getElementById('sqlInput').value.trim();

    if (sql === '') {
        document.getElementById('preview').innerText = '⚠️ Please paste your SQL code above!';
        return;
    }

    // Make SQL keywords uppercase
    const keywords = [
        'select', 'from', 'where', 'and', 'or', 'insert', 'into', 'values', 'update', 'set', 'delete',
        'create', 'table', 'alter', 'drop', 'join', 'inner', 'left', 'right', 'on', 'group by', 'order by',
        'having', 'limit', 'offset', 'distinct'
    ];

    keywords.forEach(word => {
        const regex = new RegExp('\\b' + word + '\\b', 'gi');
        sql = sql.replace(regex, word.toUpperCase());
    });

    // Add line breaks for readability
    sql = sql.replace(/(SELECT|FROM|WHERE|AND|OR|INSERT INTO|VALUES|UPDATE|SET|DELETE FROM|CREATE TABLE|ALTER TABLE|DROP TABLE|JOIN|INNER JOIN|LEFT JOIN|RIGHT JOIN|ON|GROUP BY|ORDER BY|HAVING|LIMIT|OFFSET|DISTINCT)/g, '\n$1');

    // Clean up extra newlines
    sql = sql.replace(/\n+/g, '\n').trim();

    // Set the formatted SQL to preview
    document.getElementById('preview').innerText = sql;
}
</script>

</body>
</html>
