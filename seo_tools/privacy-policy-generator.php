<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = htmlspecialchars($_POST['company_name']);
    $company_address = htmlspecialchars($_POST['company_address']);
    $email = htmlspecialchars($_POST['email']);
    $services = htmlspecialchars($_POST['services']);
    $third_party = htmlspecialchars($_POST['third_party']);
    $cookies = htmlspecialchars($_POST['cookies']);
    $policy_date = date("F j, Y");

    $privacy_policy = "
    <h2>Privacy Policy for $company_name</h2>
    <p>Effective Date: $policy_date</p>

    <h4>Introduction</h4>
    <p>At $company_name, accessible from yourwebsite.com, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by $company_name and how we use it.</p>

    <h4>Information We Collect</h4>
    <p>We collect the following information:</p>
    <ul>
        <li><strong>Personal Information</strong>: Name, email address, contact details, etc.</li>
        <li><strong>Usage Data</strong>: Information about how you use our website and services.</li>
        <li><strong>Cookies</strong>: We may use cookies to enhance user experience (for details, refer to our Cookies Policy).</li>
    </ul>

    <h4>How We Use Your Information</h4>
    <p>The information we collect from you may be used in the following ways:</p>
    <ul>
        <li>To personalize your experience</li>
        <li>To improve our website and services</li>
        <li>To communicate with you regarding services</li>
    </ul>

    <h4>Third-party Services</h4>
    <p>$company_name does / does not share your data with third-party services, except as mentioned below:</p>
    <ul>
        <li>$third_party</li>
    </ul>

    <h4>Cookies</h4>
    <p>We use cookies to store your preferences and personalize your browsing experience. You may choose to disable cookies in your browser settings.</p>
    <p><strong>Cookies we use:</strong> $cookies</p>

    <h4>Data Security</h4>
    <p>Your data security is important to us, and we implement reasonable measures to protect your information. However, no method of transmission over the internet is 100% secure, so we cannot guarantee absolute security.</p>

    <h4>Contact Us</h4>
    <p>If you have any questions about this Privacy Policy, please contact us at: $email.</p>
    ";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Privacy Policy Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .form-section {
            margin-top: 50px;
        }
        .generated-policy {
            margin-top: 30px;
        }
        .dark-mode body {
            background-color: #121212;
            color: white;
        }
        .dark-mode .form-control {
            background-color: #333;
            color: white;
        }
        .dark-mode .btn {
            background-color: #444;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h2 class="text-center">Privacy Policy Generator</h2>
            <form method="POST" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <input type="text" name="company_name" class="form-control" placeholder="Company Name" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="company_address" class="form-control" placeholder="Company Address" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Company Email" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="services" class="form-control" placeholder="Services Provided (separated by commas)" required>
                </div>
                <div class="mb-3">
                    <textarea name="third_party" class="form-control" placeholder="Third Party Services (if any)" required></textarea>
                </div>
                <div class="mb-3">
                    <textarea name="cookies" class="form-control" placeholder="Cookies Used (if any)" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Generate Privacy Policy</button>
            </form>
        </div>

        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
            <div class="generated-policy card p-4 mt-5">
                <h4>Your Generated Privacy Policy:</h4>
                <div class="policy-content mt-4">
                    <?php echo $privacy_policy; ?>
                </div>
                <button class="btn btn-success mt-4" onclick="window.print()">Print Privacy Policy</button>
            </div>
        <?php } ?>
    </div>

   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
