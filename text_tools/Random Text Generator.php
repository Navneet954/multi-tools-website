<?php
// PHP part: predefined random texts
$randomTexts = [
    "Success is not final, failure is not fatal: It is the courage to continue that counts.",
    "Dream big and dare to fail.",
    "Your time is limited, so don’t waste it living someone else’s life.",
    "Stay hungry, stay foolish.",
    "Believe you can and you're halfway there.",
    "Do what you can, with what you have, where you are.",
    "The best way to predict the future is to create it.",
    "It always seems impossible until it's done.",
    "Don't watch the clock; do what it does. Keep going.",
    "Everything you’ve ever wanted is on the other side of fear."
];

// Random text on PHP page load
$generatedText = $randomTexts[array_rand($randomTexts)];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Random Text Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #6f86d6, #48c6ef);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 600px;
            text-align: center;
            transition: 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }
        .generate-btn {
            background: #007bff;
            color: #fff;
            border-radius: 30px;
            padding: 10px 30px;
            font-size: 18px;
            margin-top: 20px;
            transition: 0.3s;
        }
        .generate-btn:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
        .random-text {
            margin-top: 20px;
            font-size: 20px;
            color: #333;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="card">
    <h2 class="mb-4">🎲 Random Text Generator</h2>
    
    <div class="random-text" id="textDisplay">
        <?php echo htmlspecialchars($generatedText); ?>
    </div>

    <button class="btn generate-btn" onclick="generateRandomText()">Generate New Text</button>
</div>

<!-- JavaScript for Random Text Generation -->
<script>
    const texts = <?php echo json_encode($randomTexts); ?>;

    function generateRandomText() {
        const randomIndex = Math.floor(Math.random() * texts.length);
        document.getElementById('textDisplay').innerText = texts[randomIndex];
    }
</script>

</body>
</html>
