<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Union Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .result-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Set Union Calculator</h1>
        
        <!-- Ad Space Top -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <div class="ad-space p-3 bg-light">
                    <!-- Ad Code Here -->
                    Advertisement Space
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form id="unionForm">
                            <div class="mb-3">
                                <label for="set1" class="form-label">Set A (comma separated numbers)</label>
                                <input type="text" class="form-control" id="set1" placeholder="Example: 1,2,3,4">
                            </div>
                            <div class="mb-3">
                                <label for="set2" class="form-label">Set B (comma separated numbers)</label>
                                <input type="text" class="form-control" id="set2" placeholder="Example: 3,4,5,6">
                            </div>
                            <button type="submit" class="btn btn-primary">Calculate Union</button>
                        </form>

                        <div id="result" class="result-box mt-4" style="display: none;">
                            <h5>Result:</h5>
                            <p id="unionResult"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ad Space Bottom -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <div class="ad-space p-3 bg-light">
                    <!-- Ad Code Here -->
                    Advertisement Space
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('unionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get input values
            let set1 = document.getElementById('set1').value.split(',').map(num => num.trim());
            let set2 = document.getElementById('set2').value.split(',').map(num => num.trim());
            
            // Perform union operation
            let unionSet = [...new Set([...set1, ...set2])].sort((a,b) => a-b);
            
            // Display result
            document.getElementById('result').style.display = 'block';
            document.getElementById('unionResult').textContent = 
                `A ∪ B = {${unionSet.join(', ')}}`;
        });
    </script>

    <?php
    // PHP processing if needed
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['set1']) && isset($_POST['set2'])) {
            $set1 = array_map('trim', explode(',', $_POST['set1']));
            $set2 = array_map('trim', explode(',', $_POST['set2']));
            
            $union = array_unique(array_merge($set1, $set2));
            sort($union);
            
            echo json_encode(['result' => $union]);
        }
    }
    ?>
</body>
</html>
