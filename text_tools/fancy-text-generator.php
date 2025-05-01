<?php
// fancy-text-generator.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fancy Text Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #acb6e5 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            margin-top: 60px;
        }
        .fancy-preview {
            margin-top: 20px;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            text-align: center;
            font-size: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            min-height: 150px;
            transition: all 0.3s;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        footer {
            margin-top: auto;
            background: #fff;
            padding: 10px 0;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }
        .customization-panel {
            background: #ffffffa8;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">Fancy Text Generator</a>
    </div>
</nav>

<div class="container">

    <!-- Customization Panel -->
    <div class="customization-panel">
        <h4 class="mb-3 text-center">Customization Options</h4>
        <div class="row g-3">
            <div class="col-md-3">
                <label for="textColor" class="form-label">Text Color</label>
                <input type="color" id="textColor" class="form-control form-control-color" value="#000000">
            </div>
            <div class="col-md-3">
                <label for="bgColor" class="form-label">Background Color</label>
                <input type="color" id="bgColor" class="form-control form-control-color" value="#ffffff">
            </div>
            <div class="col-md-3">
                <label for="fontSize" class="form-label">Font Size</label>
                <input type="number" id="fontSize" class="form-control" value="32" min="10" max="100">
            </div>
            <div class="col-md-3">
                <label for="fontFamily" class="form-label">Font Family</label>
                <select id="fontFamily" class="form-select">
                    <option value="'Poppins', sans-serif" selected>Poppins</option>
                    <option value="Arial, sans-serif">Arial</option>
                    <option value="Courier New, monospace">Courier New</option>
                    <option value="Georgia, serif">Georgia</option>
                    <option value="Times New Roman, serif">Times New Roman</option>
                    <option value="Verdana, sans-serif">Verdana</option>
                </select>
            </div>
            <div class="col-md-3">
            <label for="glowColor" class="form-label">Glow Color</label>
            <input type="color" id="glowColor" class="form-control form-control-color" value="#00f0ff">
        </div>
        </div>
    </div>

    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4">Create Your Fancy Text</h2>
        <form id="fancyForm">
            <div class="mb-3">
                <label for="inputText" class="form-label">Enter Your Text:</label>
                <input type="text" id="inputText" class="form-control" placeholder="Type something..." required>
            </div>

            <div class="mb-3">
                <label for="styleSelect" class="form-label">Select Style:</label>
                <select id="styleSelect" class="form-select">
                    <option value="normal" selected>Normal</option>
                    <option value="bold">Bold</option>
                    <option value="italic">Italic</option>
                    <option value="underline">Underline</option>
                    <option value="shadow">Shadow</option>
                    <option value="glow">Glow</option>
                    <option value="fancy">Fancy Letters</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5">Generate</button>
            </div>
        </form>

        <div class="fancy-preview mt-4" id="preview">
            Your fancy text will appear here...
        </div>
    </div>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> Fancy Text Generator | Made with ❤️
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script>
    const form = document.getElementById('fancyForm');
    const inputText = document.getElementById('inputText');
    const styleSelect = document.getElementById('styleSelect');
    const preview = document.getElementById('preview');
    const textColor = document.getElementById('textColor');
    const bgColor = document.getElementById('bgColor');
    const fontSize = document.getElementById('fontSize');
    const fontFamily = document.getElementById('fontFamily');
    const glowColor = document.getElementById('glowColor'); 

    function applyCustomizations() {
        preview.style.color = textColor.value;
        preview.style.backgroundColor = bgColor.value;
        preview.style.fontSize = fontSize.value + 'px';
        preview.style.fontFamily = fontFamily.value;
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let text = inputText.value;
        let style = styleSelect.value;

        if (style === 'normal') {
        preview.innerHTML = text;
        preview.style.fontWeight = 'normal';
        preview.style.fontStyle = 'normal';
        preview.style.textDecoration = 'none';
        preview.style.textShadow = 'none';
    } else if (style === 'bold') {
        preview.innerHTML = text;
        preview.style.fontWeight = 'bold';
        preview.style.fontStyle = 'normal';
        preview.style.textDecoration = 'none';
        preview.style.textShadow = 'none';
    } else if (style === 'italic') {
        preview.innerHTML = text;
        preview.style.fontStyle = 'italic';
        preview.style.fontWeight = 'normal';
        preview.style.textDecoration = 'none';
        preview.style.textShadow = 'none';
    } else if (style === 'underline') {
        preview.innerHTML = text;
        preview.style.textDecoration = 'underline';
        preview.style.fontWeight = 'normal';
        preview.style.fontStyle = 'normal';
        preview.style.textShadow = 'none';
    } else if (style === 'shadow') {
        preview.innerHTML = text;
        preview.style.textShadow = '2px 2px 5px rgba(0,0,0,0.5)';
        preview.style.fontWeight = 'normal';
        preview.style.fontStyle = 'normal';
        preview.style.textDecoration = 'none';
    } else if (style === 'glow') {
        preview.innerHTML = text;
        const color = glowColor.value; // Get selected glow color
        preview.style.textShadow = `0 0 5px ${color}, 0 0 10px ${color}, 0 0 20px ${color}`;
        preview.style.fontWeight = 'normal';
        preview.style.fontStyle = 'normal';
        preview.style.textDecoration = 'none';
    } else if (style === 'fancy') {
        preview.innerHTML = fancyText(text);
        preview.style.fontWeight = 'normal';
        preview.style.fontStyle = 'normal';
        preview.style.textDecoration = 'none';
        preview.style.textShadow = 'none';
    }

        applyCustomizations();
    });

    function fancyText(text) {
        const map = {
            'a': '𝒶', 'b': '𝒷', 'c': '𝒸', 'd': '𝒹', 'e': '𝑒',
            'f': '𝒻', 'g': '𝑔', 'h': '𝒽', 'i': '𝒾', 'j': '𝒿',
            'k': '𝓀', 'l': '𝓁', 'm': '𝓂', 'n': '𝓃', 'o': '𝑜',
            'p': '𝓅', 'q': '𝓆', 'r': '𝓇', 's': '𝓈', 't': '𝓉',
            'u': '𝓊', 'v': '𝓋', 'w': '𝓌', 'x': '𝓍', 'y': '𝓎', 'z': '𝓏',
            'A': '𝒜', 'B': '𝐵', 'C': '𝒞', 'D': '𝒟', 'E': '𝐸',
            'F': '𝐹', 'G': '𝒢', 'H': '𝐻', 'I': '𝐼', 'J': '𝒥',
            'K': '𝒦', 'L': '𝐿', 'M': '𝑀', 'N': '𝒩', 'O': '𝒪',
            'P': '𝒫', 'Q': '𝒬', 'R': '𝑅', 'S': '𝒮', 'T': '𝒯',
            'U': '𝒰', 'V': '𝒱', 'W': '𝒲', 'X': '𝒳', 'Y': '𝒴', 'Z': '𝒵'
        };
        return text.split('').map(char => map[char] || char).join('');
    }

    // Live Update on changing customization options
    [textColor, bgColor, fontSize, fontFamily].forEach(input => {
        input.addEventListener('input', applyCustomizations);
    });
</script>

</body>
</html>
