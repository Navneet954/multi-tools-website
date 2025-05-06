<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Strength Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .strength-meter {
            height: 20px;
            background: #ddd;
            border-radius: 3px;
            margin: 10px 0;
        }
        .strength-meter div {
            height: 100%;
            border-radius: 3px;
            transition: width 0.5s ease-in-out;
        }
        .ad-space {
            background: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Top Ad Space -->
                <div class="ad-space">
                    Advertisement Space
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Password Strength Checker</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="password">Enter Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Type your password">
                        </div>
                        
                        <div class="strength-meter mt-3">
                            <div id="strength-bar"></div>
                        </div>
                        
                        <div id="strength-text" class="mt-2"></div>
                        
                        <ul class="list-group mt-3">
                            <li class="list-group-item" id="length">At least 8 characters</li>
                            <li class="list-group-item" id="uppercase">Contains uppercase letter</li>
                            <li class="list-group-item" id="lowercase">Contains lowercase letter</li>
                            <li class="list-group-item" id="number">Contains number</li>
                            <li class="list-group-item" id="special">Contains special character</li>
                        </ul>
                    </div>
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
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Check length
            if(password.length >= 8) {
                strength += 20;
                document.getElementById('length').classList.add('list-group-item-success');
            } else {
                document.getElementById('length').classList.remove('list-group-item-success');
            }
            
            // Check uppercase
            if(/[A-Z]/.test(password)) {
                strength += 20;
                document.getElementById('uppercase').classList.add('list-group-item-success');
            } else {
                document.getElementById('uppercase').classList.remove('list-group-item-success');
            }
            
            // Check lowercase
            if(/[a-z]/.test(password)) {
                strength += 20;
                document.getElementById('lowercase').classList.add('list-group-item-success');
            } else {
                document.getElementById('lowercase').classList.remove('list-group-item-success');
            }
            
            // Check numbers
            if(/[0-9]/.test(password)) {
                strength += 20;
                document.getElementById('number').classList.add('list-group-item-success');
            } else {
                document.getElementById('number').classList.remove('list-group-item-success');
            }
            
            // Check special characters
            if(/[^A-Za-z0-9]/.test(password)) {
                strength += 20;
                document.getElementById('special').classList.add('list-group-item-success');
            } else {
                document.getElementById('special').classList.remove('list-group-item-success');
            }
            
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');
            
            strengthBar.style.width = strength + '%';
            
            if(strength <= 20) {
                strengthBar.style.backgroundColor = '#dc3545';
                strengthText.innerHTML = '<span class="text-danger">Very Weak</span>';
            } else if(strength <= 40) {
                strengthBar.style.backgroundColor = '#ffc107';
                strengthText.innerHTML = '<span class="text-warning">Weak</span>';
            } else if(strength <= 60) {
                strengthBar.style.backgroundColor = '#fd7e14';
                strengthText.innerHTML = '<span class="text-warning">Medium</span>';
            } else if(strength <= 80) {
                strengthBar.style.backgroundColor = '#20c997';
                strengthText.innerHTML = '<span class="text-success">Strong</span>';
            } else {
                strengthBar.style.backgroundColor = '#198754';
                strengthText.innerHTML = '<span class="text-success">Very Strong</span>';
            }
        });
    </script>
</body>
</html>
