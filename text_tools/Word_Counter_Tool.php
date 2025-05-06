<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Counter Tool</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1a73e8;
            --secondary-color: #f8f9fa;
            --text-color: #2c3e50;
            --border-color: #e0e0e0;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            padding: 40px 0;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        body.dark-mode {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .container {
            max-width: 1200px;
            background-color: #fff;
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .dark-mode .container {
            background-color: #2d2d2d;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        h1 {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 30px;
            grid-column: 1 / -1;
        }

        .dark-mode h1 {
            color: #4a9eff;
        }

        .toolbar {
            background-color: var(--secondary-color);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            grid-column: 1 / -1;
        }

        .dark-mode .toolbar {
            background-color: #3d3d3d;
        }

        .card {
            border: none;
            transition: all 0.4s ease;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .dark-mode .card {
            background-color: #3d3d3d;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: var(--secondary-color);
            border-bottom: 1px solid var(--border-color);
            padding: 15px;
            font-weight: 500;
        }

        .dark-mode .card-header {
            background-color: #4d4d4d;
            border-bottom: 1px solid #5a5a5a;
            color: #ffffff;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .stat-item {
            background: var(--secondary-color);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .dark-mode .stat-item {
            background: #4d4d4d;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-item i {
            font-size: 24px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .dark-mode .stat-item i {
            color: #4a9eff;
        }

        .preview {
            margin-top: 20px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 20px;
            background-color: var(--secondary-color);
            max-height: 200px;
            overflow-y: auto;
        }

        .dark-mode .preview {
            background-color: #4d4d4d;
            border-color: #5a5a5a;
        }

        textarea.form-control {
            height: 300px;
            resize: vertical;
            font-size: 16px;
            line-height: 1.6;
            padding: 15px;
        }

        .dark-mode textarea.form-control {
            background-color: #4d4d4d;
            color: #ffffff;
            border-color: #5a5a5a;
        }

        .word-frequency {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .badge {
            padding: 8px 12px;
            font-size: 14px;
        }

        .loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            display: none;
        }

        .dark-mode .loading {
            background: rgba(45, 45, 45, 0.9);
        }

        @media (max-width: 992px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .input-section, .results-section {
                grid-column: 1;
            }

            .container {
                padding: 20px;
                margin: 10px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .toolbar {
                flex-direction: column;
            }

            .toolbar button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center"><i class="fas fa-calculator"></i> Professional Word Counter</h1>
        
        <div class="toolbar">
            <button id="darkModeToggle" class="btn btn-secondary">
                <i class="fas fa-moon"></i> Dark Mode
            </button>
            <button id="clearText" class="btn btn-danger">
                <i class="fas fa-trash"></i> Clear
            </button>
            <button id="copyText" class="btn btn-success">
                <i class="fas fa-copy"></i> Copy
            </button>
            <button id="downloadText" class="btn btn-info">
                <i class="fas fa-download"></i> Download
            </button>
        </div>

        <div class="main-content">
            <div class="input-section">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-keyboard"></i> Input Text
                    </div>
                    <div class="card-body">
                        <textarea id="inputText" class="form-control" placeholder="Start typing or paste your text here..."></textarea>
                        <div class="d-flex justify-content-center mt-3">
                            <button id="countWordsBtn" class="btn btn-primary">
                                <i class="fas fa-calculator"></i> Analyze Text
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="results-section">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-pie"></i> Analysis Results
                    </div>
                    <div class="card-body">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <i class="fas fa-file-word"></i>
                                <h5>Words</h5>
                                <span id="wordCount" class="fs-4">0</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-font"></i>
                                <h5>Characters</h5>
                                <span id="charCount" class="fs-4">0</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-paragraph"></i>
                                <h5>Sentences</h5>
                                <span id="sentenceCount" class="fs-4">0</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-bars"></i>
                                <h5>Lines</h5>
                                <span id="lineCount" class="fs-4">0</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-book-reader"></i>
                                <h5>Reading Time</h5>
                                <span id="readTime" class="fs-4">0</span>s
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-microphone"></i>
                                <h5>Speaking Time</h5>
                                <span id="speakTime" class="fs-4">0</span>s
                            </div>
                        </div>

                        <div class="preview">
                            <h5><i class="fas fa-eye"></i> Text Preview</h5>
                            <div id="textPreview" class="mt-2"></div>
                        </div>

                        <div class="word-frequency">
                            <h5><i class="fas fa-chart-bar"></i> Most Common Words</h5>
                            <div id="wordFrequency" class="mt-2">N/A</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loading">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function countWordsAndChars() {
            const loading = document.querySelector('.loading');
            loading.style.display = 'block';

            setTimeout(() => {
                const text = document.getElementById("inputText").value;

                const words = text.trim().split(/\s+/).filter(function(word) {
                    return word.length > 0;
                });
                const wordCount = words.length;

                const charCount = text.length;
                const charCountNoSpaces = text.replace(/\s/g, '').length;
                const sentenceCount = text.split(/[.!?]+/).filter(Boolean).length;
                const lineCount = text.split('\n').length;
                const paragraphCount = text.split(/\n\s*\n/).filter(Boolean).length;
                const readTime = Math.ceil(wordCount / 200 * 60);
                const speakTime = Math.ceil(wordCount / 130 * 60);
                const wordFrequency = countWordFrequency(words);

                document.getElementById("wordCount").textContent = wordCount;
                document.getElementById("charCount").textContent = charCount;
                document.getElementById("sentenceCount").textContent = sentenceCount;
                document.getElementById("lineCount").textContent = lineCount;
                document.getElementById("readTime").textContent = readTime;
                document.getElementById("speakTime").textContent = speakTime;
                document.getElementById("wordFrequency").innerHTML = formatWordFrequency(wordFrequency);
                document.getElementById("textPreview").textContent = text.substring(0, 200) + (text.length > 200 ? '...' : '');

                loading.style.display = 'none';

                // Animate stats
                animateValue("wordCount", wordCount);
                animateValue("charCount", charCount);
                animateValue("sentenceCount", sentenceCount);
                animateValue("lineCount", lineCount);
            }, 300);
        }

        function animateValue(elementId, end) {
            const obj = document.getElementById(elementId);
            const start = parseInt(obj.innerHTML);
            const duration = 1000;
            const step = Math.ceil((end - start) / (duration / 10));
            
            let current = start;
            const timer = setInterval(function() {
                current += step;
                obj.innerHTML = current;
                if (current >= end) {
                    obj.innerHTML = end;
                    clearInterval(timer);
                }
            }, 10);
        }

        function countWordFrequency(words) {
            const frequency = {};
            const commonWords = new Set(['the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'i']);
            
            words.forEach(function(word) {
                word = word.toLowerCase().replace(/[^a-z0-9]/g, '');
                if (word && !commonWords.has(word)) {
                    frequency[word] = (frequency[word] || 0) + 1;
                }
            });
            return frequency;
        }

        function formatWordFrequency(frequency) {
            const sortedWords = Object.entries(frequency)
                .sort((a, b) => b[1] - a[1])
                .slice(0, 10);

            return sortedWords.map(([word, count]) => 
                `<span class="badge bg-primary me-2 mb-2">${word}: ${count}</span>`
            ).join('') || "No words found.";
        }

        function downloadText() {
            const text = document.getElementById("inputText").value;
            const blob = new Blob([text], { type: 'text/plain' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'word-count-text.txt';
            a.click();
            window.URL.revokeObjectURL(url);
        }

        // Event Listeners
        document.getElementById("inputText").addEventListener("input", countWordsAndChars);
        
        document.getElementById("darkModeToggle").addEventListener("click", function() {
            document.body.classList.toggle("dark-mode");
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-moon');
            icon.classList.toggle('fa-sun');
        });
        
        document.getElementById("clearText").addEventListener("click", function() {
            if (confirm("Are you sure you want to clear the text?")) {
                document.getElementById("inputText").value = "";
                countWordsAndChars();
            }
        });
        
        document.getElementById("copyText").addEventListener("click", function() {
            const text = document.getElementById("inputText").value;
            navigator.clipboard.writeText(text).then(() => {
                const btn = this;
                btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-copy"></i> Copy';
                }, 2000);
            });
        });
        
        document.getElementById("downloadText").addEventListener("click", downloadText);
        document.getElementById("countWordsBtn").addEventListener("click", countWordsAndChars);

        // Initialize
        countWordsAndChars();
    </script>
</body>
</html>
