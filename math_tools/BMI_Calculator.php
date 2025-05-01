<?php
// PHP BMI Calculation (optional fallback)
$bmiResult = '';
$category = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weight = $_POST['weight'] ?? 0;
    $height = $_POST['height'] ?? 0;

    if ($weight > 0 && $height > 0) {
        $heightMeter = $height / 100; // Convert cm to meters
        $bmi = $weight / ($heightMeter * $heightMeter);
        $bmiResult = number_format($bmi, 2);

        if ($bmi < 18.5) {
            $category = "Underweight";
        } elseif ($bmi < 24.9) {
            $category = "Normal weight";
        } elseif ($bmi < 29.9) {
            $category = "Overweight";
        } else {
            $category = "Obesity";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BMI Calculator - Multi-Tools Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            font-family: 'Poppins', sans-serif;
            margin-top: 80px;
        }
        .bmi-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: 0.3s ease;
        }
        .bmi-card:hover {
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        .btn-calc {
            background-color: #007bff;
            color: #fff;
            border-radius: 30px;
            padding: 10px 30px;
        }
        .btn-calc:hover {
            background-color: #0056b3;
        }
        .result-box {
            background: #f0f2f5;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
            text-align: center;
        }
        .result-value {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
        }
        .result-category {
            font-size: 20px;
            margin-top: 10px;
            color: #333;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Multi-Tools</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bmi-card">
                <h2 class="text-center mb-4">BMI Calculator</h2>
                <form method="POST" id="bmiForm">
                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" class="form-control" id="weight" name="weight" placeholder="Enter weight" value="<?php echo isset($_POST['weight']) ? htmlspecialchars($_POST['weight']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="height" class="form-label">Height (cm)</label>
                        <input type="number" class="form-control" id="height" name="height" placeholder="Enter height" value="<?php echo isset($_POST['height']) ? htmlspecialchars($_POST['height']) : ''; ?>" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-calc">Calculate BMI</button>
                    </div>
                </form>

                <!-- Result Section -->
                <div class="result-box mt-4" id="bmiResultBox" style="<?php echo $bmiResult ? '' : 'display:none;'; ?>">
                    <div class="result-value" id="bmiValue"><?php echo $bmiResult; ?></div>
                    <div class="result-category" id="bmiCategory"><?php echo $category; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for Live Calculation (Optional Enhancement) -->
<script>
    document.getElementById('bmiForm').addEventListener('submit', function(event) {
        // Client-side Calculation
        const weight = parseFloat(document.getElementById('weight').value);
        const height = parseFloat(document.getElementById('height').value);

        if (weight > 0 && height > 0) {
            const heightMeter = height / 100;
            const bmi = weight / (heightMeter * heightMeter);
            const bmiValue = bmi.toFixed(2);
            let category = '';

            if (bmi < 18.5) {
                category = "Underweight";
            } else if (bmi < 24.9) {
                category = "Normal weight";
            } else if (bmi < 29.9) {
                category = "Overweight";
            } else {
                category = "Obesity";
            }

            document.getElementById('bmiValue').innerText = bmiValue;
            document.getElementById('bmiCategory').innerText = category;
            document.getElementById('bmiResultBox').style.display = 'block';

            event.preventDefault(); // Prevent form submission (remove if you want PHP fallback)
        }
    });
</script>

</body>
</html>
