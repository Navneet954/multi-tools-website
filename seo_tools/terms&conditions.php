<?php
// Check if form is submitted and handle logic for T&C generation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect input values
    $company_name = htmlspecialchars($_POST['company_name']);
    $website_name = htmlspecialchars($_POST['website_name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $effective_date = htmlspecialchars($_POST['effective_date']);
    
    // Template for Terms & Conditions
    $terms_conditions = "
    <h3>Terms and Conditions</h3>
    <p>Last Updated: <strong>$effective_date</strong></p>
    <h4>1. Introduction</h4>
    <p>Welcome to $website_name! These Terms and Conditions govern your use of this website and the services provided by $company_name. By accessing this website, you agree to abide by these Terms.</p>
    
    <h4>2. Intellectual Property</h4>
    <p>All content, graphics, trademarks, and logos on this website are owned by $company_name and are protected by intellectual property laws.</p>
    
    <h4>3. Usage of Website</h4>
    <p>You are granted a limited, non-exclusive, non-transferable license to access and use the website for personal, non-commercial purposes only. Any illegal or prohibited use of the website is strictly prohibited.</p>
    
    <h4>4. User Responsibility</h4>
    <p>By using this website, you agree to provide accurate information and maintain the confidentiality of your account details. You are responsible for all activity that occurs under your account.</p>
    
    <h4>5. Limitation of Liability</h4>
    <p>$company_name is not liable for any damages, including but not limited to direct, indirect, incidental, or consequential damages, arising from your use of the website.</p>
    
    <h4>6. Privacy Policy</h4>
    <p>By using this website, you agree to our <a href='#'>Privacy Policy</a>.</p>
    
    <h4>7. Contact Information</h4>
    <p>If you have any questions regarding these Terms and Conditions, please contact us at: <strong>$email</strong> or at the following address: <strong>$address</strong></p>
    
    <h4>8. Governing Law</h4>
    <p>These Terms are governed by the laws of your jurisdiction and any dispute will be resolved in the courts of your location.</p>
    ";

    // Display the generated Terms & Conditions
    echo "<div class='container my-5'>
        <h2 class='text-center mb-4'>Generated Terms & Conditions</h2>
        <div class='bg-light p-4 rounded'>
            $terms_conditions
        </div>
    </div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .form-control {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Terms & Conditions Generator</h2>
        <form method="POST" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter your company name" required>
            </div>

            <div class="mb-3">
                <label for="website_name" class="form-label">Website Name</label>
                <input type="text" name="website_name" id="website_name" class="form-control" placeholder="Enter your website name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Company Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your company email" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Company Address</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Enter your company address" required>
            </div>

            <div class="mb-3">
                <label for="effective_date" class="form-label">Effective Date</label>
                <input type="date" name="effective_date" id="effective_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Generate Terms & Conditions</button>
        </form>

        <!-- Ad Space -->
        <div class="ad-space my-4 bg-light text-center p-3">
            <!-- You can add a real advertisement here -->
            <p>Ad Space</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
