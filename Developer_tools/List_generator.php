<?php
// No server processing needed; pure frontend interaction
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dynamic HTML List Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 100px;
        }
        .main-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 40px;
        }
        .ad-space {
            background: #e9ecef;
            height: 90px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #6c757d;
            font-size: 1.2rem;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        #previewArea {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px dashed #ccc;
            min-height: 100px;
        }
        .remove-btn {
            cursor: pointer;
            color: red;
            font-weight: bold;
        }
        .remove-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Top Ad Space -->
    <div class="ad-space mb-5">
        Top Ad Space 728x90
    </div>

    <!-- Main List Generator Card -->
    <div class="main-card">
        <h2 class="text-center mb-4">HTML List Generator</h2>

        <!-- Select List Type -->
        <div class="mb-3">
            <label for="listType" class="form-label">Select List Type:</label>
            <select class="form-select" id="listType">
                <option value="ul">Unordered List (ul)</option>
                <option value="ol">Ordered List (ol)</option>
            </select>
        </div>

        <!-- List Items Input Area -->
        <div id="listItemsContainer">
            <div class="input-group mb-3">
                <input type="text" class="form-control list-item" placeholder="Enter list item">
                <button class="btn btn-danger remove-btn" onclick="removeItem(this)">Remove</button>
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-2 mb-4">
            <button class="btn btn-primary" onclick="addItem()">Add Another Item</button>
            <button class="btn btn-success" onclick="generateList()">Generate List</button>
            <button class="btn btn-secondary" onclick="resetForm()">Reset</button>
        </div>

        <!-- Preview Area -->
        <h5>Live Preview:</h5>
        <div id="previewArea" class="mt-3"></div>
    </div>

    <!-- Bottom Ad Space -->
    <div class="ad-space">
        Bottom Ad Space 728x90
    </div>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript Functionality -->
<script>
    // Add new input field
    function addItem() {
        const container = document.getElementById('listItemsContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-3';
        div.innerHTML = `
            <input type="text" class="form-control list-item" placeholder="Enter list item">
            <button class="btn btn-danger remove-btn" onclick="removeItem(this)">Remove</button>
        `;
        container.appendChild(div);
    }

    // Remove input field
    function removeItem(button) {
        button.parentElement.remove();
    }

    // Generate HTML List
    function generateList() {
        const listType = document.getElementById('listType').value;
        const items = document.querySelectorAll('.list-item');
        let output = `<${listType}>`;

        items.forEach(item => {
            if (item.value.trim() !== '') {
                output += `<li>${item.value.trim()}</li>`;
            }
        });

        output += `</${listType}>`;

        document.getElementById('previewArea').innerHTML = output;
    }

    // Reset form
    function resetForm() {
        document.getElementById('listItemsContainer').innerHTML = `
            <div class="input-group mb-3">
                <input type="text" class="form-control list-item" placeholder="Enter list item">
                <button class="btn btn-danger remove-btn" onclick="removeItem(this)">Remove</button>
            </div>
        `;
        document.getElementById('previewArea').innerHTML = '';
        document.getElementById('listType').value = 'ul';
    }
</script>

</body>
</html>
