<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Intersection Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .result-box {
            min-height: 50px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Set Intersection Calculator</h2>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form id="intersectionForm">
                            <div class="mb-3">
                                <label for="set1" class="form-label">Set A (comma-separated values)</label>
                                <input type="text" class="form-control" id="set1" placeholder="Example: 1,2,3,4">
                            </div>
                            <div class="mb-3">
                                <label for="set2" class="form-label">Set B (comma-separated values)</label>
                                <input type="text" class="form-control" id="set2" placeholder="Example: 3,4,5,6">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Calculate Intersection</button>
                            </div>
                        </form>

                        <div class="result-box mt-4">
                            <h5>Result:</h5>
                            <div id="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('intersectionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get input values and convert to arrays
            const set1 = document.getElementById('set1').value
                .split(',')
                .map(item => item.trim())
                .filter(item => item !== '');
                
            const set2 = document.getElementById('set2').value
                .split(',')
                .map(item => item.trim())
                .filter(item => item !== '');

            // Calculate intersection
            const intersection = set1.filter(item => set2.includes(item));

            // Display results
            const resultDiv = document.getElementById('result');
            if (intersection.length > 0) {
                resultDiv.innerHTML = `
                    <p>Set A: {${set1.join(', ')}}</p>
                    <p>Set B: {${set2.join(', ')}}</p>
                    <p>A ∩ B = {${intersection.join(', ')}}</p>
                `;
            } else {
                resultDiv.innerHTML = `
                    <p>Set A: {${set1.join(', ')}}</p>
                    <p>Set B: {${set2.join(', ')}}</p>
                    <p>A ∩ B = ∅ (Empty Set)</p>
                `;
            }
        });
    </script>
</body>
</html>
