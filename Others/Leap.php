<?php
// Function to check if a year is leap year
function isLeapYear($year) {
    return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = isset($_POST['year']) ? (int)$_POST['year'] : 0;
    $result = '';
    
    if ($year >= 1 && $year <= 9999) {
        if (isLeapYear($year)) {
            $result = "<div class='alert alert-success'>
                        <h4 class='alert-heading'>Leap Year Found!</h4>
                        <p>$year is a leap year! This means it has 366 days instead of the usual 365.</p>
                      </div>";
        } else {
            $result = "<div class='alert alert-info'>
                        <h4 class='alert-heading'>Not a Leap Year</h4>
                        <p>$year is not a leap year. It has the standard 365 days.</p>
                      </div>";
        }
    } else {
        $result = "<div class='alert alert-danger'>Please enter a year between 1 and 9999</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Check if a year is a leap year with this simple tool">
    <title>Leap Year Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ad-space {
            background: #f8f9fa;
            border: 1px dashed #ccc;
            padding: 20px;
            margin: 15px 0;
            text-align: center;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-primary {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: scale(1.05);
        }
        #year {
            transition: border-color 0.3s ease;
        }
        #year:focus {
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.15);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="ad-space">
                    <!-- Ad Space Top -->
                    Advertisement Space
                </div>
                
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center mb-0">Leap Year Checker</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <label for="year" class="form-label">Enter Year:</label>
                                <input type="number" class="form-control" id="year" name="year" min="1" max="9999" placeholder="Enter a year between 1-9999" required>
                                <div class="form-text">Enter a valid year to check if it's a leap year</div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Check Year</button>
                        </form>
                        <div id="result" class="mt-4">
                            <?php if(isset($result)) echo $result; ?>
                        </div>
                    </div>
                </div>

                <div class="ad-space">
                    <!-- Ad Space Bottom -->
                    Advertisement Space
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
