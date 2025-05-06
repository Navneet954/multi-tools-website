<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .url-card {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .shortened-url {
            word-break: break-all;
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="url-card">
            <h2 class="text-center mb-4">URL Shortener</h2>
            <form id="urlForm" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="longUrl" class="form-label">Enter your long URL</label>
                    <input type="url" class="form-control" id="longUrl" placeholder="https://example.com" required>
                    <div class="invalid-feedback">
                        Please enter a valid URL
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Shorten URL</button>
            </form>
            
            <div id="result" class="shortened-url">
                <p class="mb-2">Shortened URL:</p>
                <div class="input-group">
                    <input type="text" id="shortUrl" class="form-control" readonly>
                    <button class="btn btn-outline-secondary" type="button" id="copyBtn">
                        Copy
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('urlForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const longUrl = document.getElementById('longUrl').value;
            if (!isValidUrl(longUrl)) {
                document.getElementById('longUrl').classList.add('is-invalid');
                return;
            }
            
            // For demonstration, using TinyURL API
            // In production, you might want to use your own backend service
            fetch(`https://tinyurl.com/api-create.php?url=${encodeURIComponent(longUrl)}`)
                .then(response => response.text())
                .then(shortUrl => {
                    document.getElementById('shortUrl').value = shortUrl;
                    document.getElementById('result').style.display = 'block';
                })
                .catch(error => {
                    alert('Error shortening URL: ' + error);
                });
        });

        document.getElementById('copyBtn').addEventListener('click', function() {
            const shortUrl = document.getElementById('shortUrl');
            shortUrl.select();
            document.execCommand('copy');
            
            this.textContent = 'Copied!';
            setTimeout(() => {
                this.textContent = 'Copy';
            }, 2000);
        });

        function isValidUrl(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
        }

        // Bootstrap form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
