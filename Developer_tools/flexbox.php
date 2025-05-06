<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Flexbox Generator</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom CSS for Flexbox preview */
        .flexbox-preview {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .flexbox-item {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            margin: 5px;
            border-radius: 5px;
        }

        /* Ad space styles */
        .ad-space {
            background-color: #eaeaea;
            text-align: center;
            padding: 20px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<!-- Advertisement Top Space -->
<div class="ad-space">
    <p>Top Ad Space - Place Your Ad Here</p>
</div>

<!-- Main Container -->
<div class="container mt-5">
    <h1 class="text-center mb-4">CSS Flexbox Generator</h1>

    <!-- Form for Flexbox Configuration -->
    <form id="flexbox-form">
        <div class="mb-3">
            <label for="flex-direction" class="form-label">Flex Direction</label>
            <select class="form-select" id="flex-direction">
                <option value="row">Row</option>
                <option value="column">Column</option>
                <option value="row-reverse">Row Reverse</option>
                <option value="column-reverse">Column Reverse</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="justify-content" class="form-label">Justify Content</label>
            <select class="form-select" id="justify-content">
                <option value="flex-start">Flex Start</option>
                <option value="flex-end">Flex End</option>
                <option value="center">Center</option>
                <option value="space-between">Space Between</option>
                <option value="space-around">Space Around</option>
                <option value="space-evenly">Space Evenly</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="align-items" class="form-label">Align Items</label>
            <select class="form-select" id="align-items">
                <option value="flex-start">Flex Start</option>
                <option value="flex-end">Flex End</option>
                <option value="center">Center</option>
                <option value="baseline">Baseline</option>
                <option value="stretch">Stretch</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="align-self" class="form-label">Align Self (Item)</label>
            <select class="form-select" id="align-self">
                <option value="auto">Auto</option>
                <option value="flex-start">Flex Start</option>
                <option value="flex-end">Flex End</option>
                <option value="center">Center</option>
                <option value="baseline">Baseline</option>
                <option value="stretch">Stretch</option>
            </select>
        </div>
    </form>

    <!-- Preview Area -->
    <div class="flexbox-preview" id="preview-box">
        <div class="flexbox-item">Item 1</div>
        <div class="flexbox-item">Item 2</div>
        <div class="flexbox-item">Item 3</div>
    </div>

</div>

<!-- Advertisement Bottom Space -->
<div class="ad-space mt-5">
    <p>Bottom Ad Space - Place Your Ad Here</p>
</div>

<!-- Bootstrap and jQuery JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Function to update the preview based on form selection
    function updateFlexboxPreview() {
        var flexDirection = document.getElementById('flex-direction').value;
        var justifyContent = document.getElementById('justify-content').value;
        var alignItems = document.getElementById('align-items').value;
        var alignSelf = document.getElementById('align-self').value;

        var previewBox = document.getElementById('preview-box');
        previewBox.style.flexDirection = flexDirection;
        previewBox.style.justifyContent = justifyContent;
        previewBox.style.alignItems = alignItems;

        // Apply the 'align-self' property to each item
        var items = previewBox.getElementsByClassName('flexbox-item');
        for (var i = 0; i < items.length; i++) {
            items[i].style.alignSelf = alignSelf;
        }
    }

    // Event listeners to trigger the update function on form change
    document.getElementById('flex-direction').addEventListener('change', updateFlexboxPreview);
    document.getElementById('justify-content').addEventListener('change', updateFlexboxPreview);
    document.getElementById('align-items').addEventListener('change', updateFlexboxPreview);
    document.getElementById('align-self').addEventListener('change', updateFlexboxPreview);

    // Initialize the preview on page load
    updateFlexboxPreview();
</script>

</body>
</html>
