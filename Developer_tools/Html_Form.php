<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic HTML Form Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-builder {
            max-width: 1000px;
            margin: 30px auto;
            padding: 25px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .controls {
            margin-bottom: 25px;
            padding: 20px;
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .preview {
            padding: 25px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            background: white;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }
        .preview:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 6px;
            background: rgba(255,255,255,0.7);
        }
        .btn {
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 5px;
        }
        .btn-primary {
            background: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13,110,253,0.2);
        }
        .generated-code {
            background: #2b2b2b;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 25px;
            position: relative;
        }
        .generated-code pre {
            margin: 0;
            padding: 15px;
            background: #363636;
            border-radius: 6px;
            overflow-x: auto;
        }
        .form-control {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.25);
        }
        .field-controls {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 15px;
        }
        .section-title {
            color: #0d6efd;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .copy-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            background: #198754;
            color: white;
            border-radius: 5px;
            display: none;
            animation: fadeInOut 2s ease;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            20% { opacity: 1; transform: translateY(0); }
            80% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <div class="form-builder">
        <div class="controls">
            <h2 class="section-title">Form Builder Controls</h2>
            <div class="field-controls">
                <select id="fieldType" class="form-select">
                    <option value="text">Text Input</option>
                    <option value="textarea">Textarea</option>
                    <option value="select">Select Dropdown</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="radio">Radio Button</option>
                    <option value="email">Email Input</option>
                    <option value="number">Number Input</option>
                    <option value="date">Date Input</option>
                </select>
                <button onclick="addField()" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Field
                </button>
                <button onclick="clearForm()" class="btn btn-danger">
                    Clear Form
                </button>
            </div>
        </div>

        <div class="preview">
            <h3 class="section-title">Form Preview</h3>
            <form id="previewForm" class="needs-validation"></form>
        </div>

        <div class="generated-code">
            <h3 class="section-title text-white">Generated HTML Code</h3>
            <pre><code id="generatedCode"></code></pre>
            <button onclick="copyCode()" class="btn btn-success">
                <i class="fas fa-copy"></i> Copy Code
            </button>
        </div>
    </div>

    <div id="copyNotification" class="copy-notification">
        Code copied successfully!
    </div>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
    <script>
        let fieldCounter = 0;

        function addField() {
            const fieldType = document.getElementById('fieldType').value;
            const previewForm = document.getElementById('previewForm');
            fieldCounter++;

            let fieldHtml = '';
            const fieldId = `field_${fieldCounter}`;
            
            switch(fieldType) {
                case 'text':
                    fieldHtml = `
                        <div class="form-group">
                            <label for="${fieldId}" class="form-label">Text Field ${fieldCounter}:</label>
                            <input type="text" id="${fieldId}" name="${fieldId}" class="form-control" placeholder="Enter text">
                        </div>
                    `;
                    break;
                case 'textarea':
                    fieldHtml = `
                        <div class="form-group">
                            <label for="${fieldId}" class="form-label">Textarea ${fieldCounter}:</label>
                            <textarea id="${fieldId}" name="${fieldId}" class="form-control" rows="3" placeholder="Enter text here"></textarea>
                        </div>
                    `;
                    break;
                case 'select':
                    fieldHtml = `
                        <div class="form-group">
                            <label for="${fieldId}" class="form-label">Select ${fieldCounter}:</label>
                            <select id="${fieldId}" name="${fieldId}" class="form-select">
                                <option value="" selected disabled>Choose an option</option>
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>
                        </div>
                    `;
                    break;
                case 'checkbox':
                    fieldHtml = `
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" id="${fieldId}" name="${fieldId}" class="form-check-input">
                                <label class="form-check-label" for="${fieldId}">Checkbox ${fieldCounter}</label>
                            </div>
                        </div>
                    `;
                    break;
                case 'radio':
                    fieldHtml = `
                        <div class="form-group">
                            <label class="form-label">Radio ${fieldCounter}:</label>
                            <div class="form-check">
                                <input type="radio" name="${fieldId}" value="option1" class="form-check-input" id="${fieldId}_1">
                                <label class="form-check-label" for="${fieldId}_1">Option 1</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="${fieldId}" value="option2" class="form-check-input" id="${fieldId}_2">
                                <label class="form-check-label" for="${fieldId}_2">Option 2</label>
                            </div>
                        </div>
                    `;
                    break;
                case 'email':
                    fieldHtml = `
                        <div class="form-group">
                            <label for="${fieldId}" class="form-label">Email ${fieldCounter}:</label>
                            <input type="email" id="${fieldId}" name="${fieldId}" class="form-control" placeholder="Enter email">
                        </div>
                    `;
                    break;
                case 'number':
                    fieldHtml = `
                        <div class="form-group">
                            <label for="${fieldId}" class="form-label">Number ${fieldCounter}:</label>
                            <input type="number" id="${fieldId}" name="${fieldId}" class="form-control" placeholder="Enter number">
                        </div>
                    `;
                    break;
                case 'date':
                    fieldHtml = `
                        <div class="form-group">
                            <label for="${fieldId}" class="form-label">Date ${fieldCounter}:</label>
                            <input type="date" id="${fieldId}" name="${fieldId}" class="form-control">
                        </div>
                    `;
                    break;
            }

            previewForm.insertAdjacentHTML('beforeend', fieldHtml);
            updateGeneratedCode();
        }

        function clearForm() {
            document.getElementById('previewForm').innerHTML = '';
            updateGeneratedCode();
            fieldCounter = 0;
        }

        function updateGeneratedCode() {
            const formHtml = document.getElementById('previewForm').innerHTML;
            document.getElementById('generatedCode').textContent = formHtml.trim();
        }

        function copyCode() {
            const code = document.getElementById('generatedCode').textContent;
            navigator.clipboard.writeText(code).then(() => {
                const notification = document.getElementById('copyNotification');
                notification.style.display = 'block';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy code:', err);
            });
        }
    </script>
</body>
</html>
