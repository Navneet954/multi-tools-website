<?php
// This is the PHP file, but for this scenario, we can leave PHP functions empty since the main logic will be in the front-end code.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emoji Keyboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for styling -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 100px;
        }

        .emoji-btn {
            font-size: 24px;
            padding: 10px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .emoji-btn:hover {
            background-color: #007bff;
            color: white;
        }

        .emoji-preview {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            border: 1px solid #ddd;
            min-height: 80px;
            margin-top: 20px;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .emoji-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .ad-space {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            margin: 20px 0;
        }

        .ad-space p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .emoji-btn {
                font-size: 18px;
                padding: 8px;
            }

            .emoji-preview {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<!-- Ad Space at the Top -->
<div class="ad-space">
    <p>🧠 Your Ad Here: Best deals on tech gadgets!</p>
</div>

<!-- Main Container -->
<div class="container">
    <h2 class="text-center">Emoji Keyboard</h2>

    <!-- Preview Section -->
    <div class="emoji-preview" id="emojiPreview">
        <span>Select an emoji</span>
    </div>

    <!-- Emoji Button Grid -->
    <div class="emoji-container">
        <!-- Emojis list -->
        <button class="emoji-btn" onclick="addEmoji('😀')">😀</button>
        <button class="emoji-btn" onclick="addEmoji('😂')">😂</button>
        <button class="emoji-btn" onclick="addEmoji('😍')">😍</button>
        <button class="emoji-btn" onclick="addEmoji('🥺')">🥺</button>
        <button class="emoji-btn" onclick="addEmoji('😎')">😎</button>
        <button class="emoji-btn" onclick="addEmoji('😜')">😜</button>
        <button class="emoji-btn" onclick="addEmoji('😭')">😭</button>
        <button class="emoji-btn" onclick="addEmoji('😏')">😏</button>
        <button class="emoji-btn" onclick="addEmoji('😈')">😈</button>
        <button class="emoji-btn" onclick="addEmoji('🤩')">🤩</button>
        <button class="emoji-btn" onclick="addEmoji('😇')">😇</button>
        <button class="emoji-btn" onclick="addEmoji('💩')">💩</button>
        <button class="emoji-btn" onclick="addEmoji('🤔')">🤔</button>
        <button class="emoji-btn" onclick="addEmoji('😜')">😜</button>
        <button class="emoji-btn" onclick="addEmoji('❤️')">❤️</button>
        <button class="emoji-btn" onclick="addEmoji('💀')">💀</button>
        <button class="emoji-btn" onclick="addEmoji('🌸')">🌸</button>
        <button class="emoji-btn" onclick="addEmoji('🌈')">🌈</button>
    </div>
</div>

<!-- Ad Space at the Bottom -->
<div class="ad-space">
    <p>🧠 Your Ad Here: Get a 50% discount on your first order!</p>
</div>

<!-- JavaScript -->
<script>
    function addEmoji(emoji) {
        const preview = document.getElementById('emojiPreview');
        preview.textContent += emoji;
    }
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
