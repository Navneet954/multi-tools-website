<?php
// PHP Age Calculator Logic
$ageResult = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dob = $_POST['dob'] ?? '';
    if (!empty($dob)) {
        $birthDate = new DateTime($dob);
        $today = new DateTime('today');
        $age = $birthDate->diff($today);

        $ageResult = "You are <strong>{$age->y}</strong> years, <strong>{$age->m}</strong> months, and <strong>{$age->d}</strong> days old.";
    } else {
        $ageResult = "<span class='text-danger'>Please select your Date of Birth!</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Age Calculator - Multi-Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        .btn-custom {
            background: #6a11cb;
            color: #fff;
            border-radius: 50px;
            padding: 10px 30px;
            font-size: 18px;
        }
        .btn-custom:hover {
            background: #2575fc;
        }
        .result-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
            font-size: 20px;
            text-align: center;
        }
        h1 {
            color: #fff;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h1 class="text-center">Age Calculator</h1>
            <div class="card p-4">
                <form method="POST" id="ageForm">
                    <div class="mb-3">
                        <label for="dob" class="form-label">Select Your Date of Birth:</label>
                        <input type="date" id="dob" name="dob" class="form-control form-control-lg" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Calculate Age</button>
                    </div>
                </form>

                <?php if (!empty($ageResult)): ?>
                    <div class="result-box mt-4">
                        <?php echo $ageResult; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Add client-side live calculation with JavaScript -->
<script>
    document.getElementById('ageForm').addEventListener('submit', function(event) {
        const dob = document.getElementById('dob').value;
        if (!dob) {
            alert('Please select a valid Date of Birth!');
            event.preventDefault();
        }
    });
</script>

</body>
</html>
