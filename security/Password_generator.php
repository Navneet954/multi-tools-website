<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .password-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .ad-space {
            background: #e9ecef;
            padding: 15px;
            margin: 10px 0;
            text-align: center;
            border: 1px dashed #6c757d;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Top Ad Space -->
                <div class="ad-space">
                    Advertisement Space
                </div>

                <div class="password-container">
                    <h2 class="text-center mb-4">Password Generator</h2>
                    
                    <form id="passwordForm">
                        <div class="mb-3">
                            <label class="form-label">Password Length:</label>
                            <input type="number" class="form-control" id="passwordLength" value="12" min="8" max="50">
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="uppercase" checked>
                                <label class="form-check-label">Include Uppercase Letters</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lowercase" checked>
                                <label class="form-check-label">Include Lowercase Letters</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="numbers" checked>
                                <label class="form-check-label">Include Numbers</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="symbols">
                                <label class="form-check-label">Include Symbols</label>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-primary w-100" onclick="generatePassword()">Generate Password</button>
                        
                        <div class="mt-3">
                            <label class="form-label">Generated Password:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="generatedPassword" readonly>
                                <button class="btn btn-secondary" type="button" onclick="copyPassword()">Copy</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Bottom Ad Space -->
                <div class="ad-space">
                    Advertisement Space
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function generatePassword() {
            const length = document.getElementById('passwordLength').value;
            const useUpper = document.getElementById('uppercase').checked;
            const useLower = document.getElementById('lowercase').checked;
            const useNumbers = document.getElementById('numbers').checked;
            const useSymbols = document.getElementById('symbols').checked;

            let chars = '';
            if (useUpper) chars += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            if (useLower) chars += 'abcdefghijklmnopqrstuvwxyz';
            if (useNumbers) chars += '0123456789';
            if (useSymbols) chars += '!@#$%^&*()_+-=[]{}|;:,.<>?';

            if (chars === '') {
                alert('Please select at least one character type');
                return;
            }

            let password = '';
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * chars.length);
                password += chars[randomIndex];
            }

            document.getElementById('generatedPassword').value = password;
        }

        function copyPassword() {
            const passwordField = document.getElementById('generatedPassword');
            passwordField.select();
            document.execCommand('copy');
            alert('Password copied to clipboard!');
        }
    </script>

    <?php
    // PHP function to generate password (server-side alternative)
    function generateServerPassword($length, $useUpper, $useLower, $useNumbers, $useSymbols) {
        $chars = '';
        if ($useUpper) $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($useLower) $chars .= 'abcdefghijklmnopqrstuvwxyz';
        if ($useNumbers) $chars .= '0123456789';
        if ($useSymbols) $chars .= '!@#$%^&*()_+-=[]{}|;:,.<>?';
        
        $password = '';
        $charsLength = strlen($chars);
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, $charsLength - 1)];
        }
        
        return $password;
    }
    ?>
</body>
</html>
