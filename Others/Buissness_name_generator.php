<?php
// Business Name Generator PHP Logic
$generatedName = '';
if (isset($_POST['generate'])) {
    $adjectives = ['Smart', 'Bright', 'Creative', 'Fast', 'Bold', 'Epic', 'NextGen', 'Prime', 'Fresh', 'Elite'];
    $nouns = ['Solutions', 'Enterprises', 'Technologies', 'Studios', 'Concepts', 'Dynamics', 'Ventures', 'Works', 'Minds', 'Creations'];

    $adjective = $adjectives[array_rand($adjectives)];
    $noun = $nouns[array_rand($nouns)];
    $number = rand(10, 99);

    $generatedName = "$adjective $noun $number";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Business Name Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f8;
            font-family: 'Poppins', sans-serif;
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .main-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px;
            margin-top: 30px;
        }
        .generated-name {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
            margin-top: 20px;
        }
        .ad-space {
            background: #e0e0e0;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            font-size: 1.2rem;
            color: #666;
        }
        button {
            font-size: 1.2rem;
            padding: 10px 30px;
            border-radius: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Top Ad Space -->
    <div class="ad-space mb-4">
        <p>Top Advertisement Space</p>
    </div>

    <!-- Business Name Generator Card -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="main-card text-center">
                <h1 class="mb-4">Business Name Generator</h1>

                <form method="POST" id="nameForm">
                    <button type="submit" name="generate" class="btn btn-primary">Generate Name</button>
                </form>

                <!-- PHP Preview -->
                <?php if (!empty($generatedName)) : ?>
                    <div class="generated-name"><?php echo htmlspecialchars($generatedName); ?></div>
                <?php endif; ?>

                <!-- Live Preview from JavaScript -->
                <div id="jsPreview" class="generated-name"></div>
            </div>
        </div>
    </div>

    <!-- Bottom Ad Space -->
    <div class="ad-space mt-5">
        <p>Bottom Advertisement Space</p>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
// JavaScript Name Generator (Live Preview without refresh)
const adjectives = ['Smart', 'Bright', 'Creative', 'Fast', 'Bold', 'Epic', 'NextGen', 'Prime', 'Fresh', 'Elite'];
const nouns = ['Solutions', 'Enterprises', 'Technologies', 'Studios', 'Concepts', 'Dynamics', 'Ventures', 'Works', 'Minds', 'Creations'];

document.getElementById('nameForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent form from submitting

    const adjective = adjectives[Math.floor(Math.random() * adjectives.length)];
    const noun = nouns[Math.floor(Math.random() * nouns.length)];
    const number = Math.floor(Math.random() * 90) + 10;

    const generated = adjective + " " + noun + " " + number;
    document.getElementById('jsPreview').textContent = generated;
});
</script>

</body>
</html>
