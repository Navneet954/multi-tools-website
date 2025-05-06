<?php
// Translator Tool - Single File
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Text Translator - 100 Languages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free online text translator supporting 100+ languages">
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(135deg, #f4f6f9 0%, #e9ecef 100%);
            font-family: 'Poppins', sans-serif;
            padding: 20px 0;
            min-height: 100vh;
        }
        .ad-space {
            background: #ffffff;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 10px;
            font-weight: 500;
            font-size: 1.2rem;
            color: #6c757d;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .translator-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            padding: 35px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .translator-card:hover {
            transform: translateY(-5px);
        }
        .btn-translate {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            border-radius: 50px;
            padding: 12px 35px;
            font-size: 1.2rem;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-translate:hover {
            background: linear-gradient(45deg, #0056b3, #004094);
            transform: scale(1.02);
            color: white;
        }
        .btn-translate:active {
            transform: scale(0.98);
        }
        .output-box {
            min-height: 150px;
            background: #f8f9fa;
            border: 2px dashed #ced4da;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        .output-box:hover {
            border-color: #007bff;
            background: #ffffff;
        }
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            padding: 12px;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.15);
        }
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }
        .loading::after {
            content: "⌛";
            animation: loading 1s infinite;
        }
        @keyframes loading {
            0% { content: "⌛"; }
            50% { content: "⏳"; }
        }
    </style>
</head>

<body>

<div class="container">
    <div class="ad-space">
        Advertisement Space (728x90)
    </div>

    <div class="translator-card">
        <h2 class="text-center mb-4">🌍 Text Translator - 100+ Languages</h2>

        <div class="row g-4">
            <div class="col-md-6">
                <label for="inputText" class="form-label fw-bold">Enter Text</label>
                <textarea id="inputText" class="form-control" rows="7" placeholder="Type or paste your text here..."></textarea>
                <div class="mt-2 text-end">
                    <small class="text-muted" id="charCount">0/5000 characters</small>
                </div>
            </div>

            <div class="col-md-6">
                <label for="languageSelect" class="form-label fw-bold">Select Target Language</label>
                <select id="languageSelect" class="form-select mb-3">
                    <!-- Language options added by JavaScript -->
                </select>

                <button class="btn btn-translate w-100" id="translateBtn" onclick="translateText()">
                    <span class="translate-text">Translate</span>
                    <div class="loading" id="loadingIndicator"></div>
                </button>

                <div class="output-box mt-4" id="outputText">
                    Your translation will appear here...
                </div>
            </div>
        </div>
    </div>

    <div class="ad-space">
        Advertisement Space (728x90)
    </div>
</div>

<!-- Bootstrap JS and Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Translator Logic -->
<script>
const languages = {
    "af": "Afrikaans", "ar": "Arabic", "bn": "Bengali",
    "zh-CN": "Chinese (Simplified)", "zh-TW": "Chinese (Traditional)",
    "cs": "Czech", "da": "Danish", "nl": "Dutch", "en": "English",
    "fi": "Finnish", "fr": "French", "de": "German", "el": "Greek",
    "gu": "Gujarati", "hi": "Hindi", "hu": "Hungarian", "id": "Indonesian",
    "it": "Italian", "ja": "Japanese", "jv": "Javanese", "kn": "Kannada",
    "ko": "Korean", "la": "Latin", "ml": "Malayalam", "mr": "Marathi",
    "ms": "Malay", "ne": "Nepali", "no": "Norwegian", "pa": "Punjabi",
    "pl": "Polish", "pt": "Portuguese", "ro": "Romanian", "ru": "Russian",
    "es": "Spanish", "sv": "Swedish", "ta": "Tamil", "te": "Telugu",
    "th": "Thai", "tr": "Turkish", "uk": "Ukrainian", "ur": "Urdu",
    "vi": "Vietnamese", "zu": "Zulu"
};

// Populate Language Dropdown
const languageSelect = document.getElementById('languageSelect');
Object.entries(languages)
    .sort((a, b) => a[1].localeCompare(b[1]))
    .forEach(([code, name]) => {
        const option = document.createElement('option');
        option.value = code;
        option.innerText = name;
        languageSelect.appendChild(option);
    });

// Character Counter
const inputText = document.getElementById('inputText');
const charCount = document.getElementById('charCount');
inputText.addEventListener('input', () => {
    const count = inputText.value.length;
    charCount.textContent = `${count}/5000 characters`;
    if (count > 5000) {
        charCount.style.color = 'red';
        inputText.value = inputText.value.slice(0, 5000);
    } else {
        charCount.style.color = '';
    }
});

async function translateText() {
    const text = inputText.value.trim();
    const lang = languageSelect.value;
    const translateBtn = document.getElementById('translateBtn');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const outputText = document.getElementById('outputText');

    if (!text) {
        outputText.innerHTML = '<span class="text-danger">Please enter some text to translate!</span>';
        return;
    }

    // Show loading state
    translateBtn.disabled = true;
    loadingIndicator.style.display = 'block';
    outputText.innerText = 'Translating...';

    try {
        const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=en|${lang}`;
        const response = await fetch(url);
        const data = await response.json();

        if (data.responseData?.translatedText) {
            outputText.innerText = data.responseData.translatedText;
        } else {
            outputText.innerHTML = '<span class="text-danger">Translation failed. Please try again!</span>';
        }
    } catch (error) {
        outputText.innerHTML = `<span class="text-danger">Error: ${error.message}</span>`;
    } finally {
        // Reset button state
        translateBtn.disabled = false;
        loadingIndicator.style.display = 'none';
    }
}
</script>

</body>
</html>
