<?php
// No server-side logic needed anymore (full JS based dynamic generation)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modern Lottery Number Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #ece9e6, #ffffff);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .ad-space {
            background: #f1f1f1;
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            font-weight: 600;
            color: #666;
            margin: 20px 0;
        }
        .lottery-card {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            transition: 0.4s;
        }
        .lottery-card:hover {
            transform: translateY(-5px);
        }
        .lottery-number {
            display: inline-block;
            margin: 10px;
            width: 70px;
            height: 70px;
            line-height: 70px;
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(135deg, #007bff, #00d4ff);
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.6);
            animation: glow 1s ease-in-out infinite alternate;
        }
        @keyframes glow {
            from {
                box-shadow: 0 0 10px #007bff;
            }
            to {
                box-shadow: 0 0 20px #00d4ff;
            }
        }
        .btn-generate {
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 30px;
            transition: 0.3s;
        }
        .btn-generate:hover {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            color: #fff;
            transform: scale(1.05);
        }
        footer {
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>

<body>

    <!-- Top Ad Space -->
    <div class="container mt-4">
        <div class="ad-space">Top Ad Space (Your Ads Here)</div>
    </div>

    <!-- Main Generator Section -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="lottery-card">
                    <h1 class="mb-4">🎲 Lottery Number Generator</h1>
                    <div id="numbersArea" class="mb-4">
                        <!-- Lottery numbers will appear here -->
                    </div>
                    <button onclick="generateNumbers()" class="btn btn-primary btn-generate">Generate Numbers</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Ad Space -->
    <div class="container mb-4">
        <div class="ad-space">Bottom Ad Space (Your Ads Here)</div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Lottery Generator | Powered by PHP & Bootstrap
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        function generateNumbers() {
            const area = document.getElementById('numbersArea');
            area.innerHTML = ''; // Clear previous numbers
            let numbers = [];
            
            while (numbers.length < 6) {
                let num = Math.floor(Math.random() * 49) + 1;
                if (!numbers.includes(num)) {
                    numbers.push(num);
                }
            }
            numbers.sort(function(a, b){return a - b;});

            numbers.forEach(function(number) {
                const div = document.createElement('div');
                div.className = 'lottery-number';
                div.innerText = number;
                div.style.background = randomGradient();
                area.appendChild(div);
            });
        }

        function randomGradient() {
            const colors = [
                ['#ff7e5f', '#feb47b'],
                ['#6a11cb', '#2575fc'],
                ['#ff6a00', '#ee0979'],
                ['#43cea2', '#185a9d'],
                ['#30cfd0', '#330867']
            ];
            const pair = colors[Math.floor(Math.random() * colors.length)];
            return `linear-gradient(135deg, ${pair[0]}, ${pair[1]})`;
        }
    </script>

</body>
</html>
