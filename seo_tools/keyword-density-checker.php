<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keyword Density Checker - Improved</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9f9f9;
        }
        .ad-space {
            min-height: 90px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }
        body.dark-mode {
            background: #121212;
            color: #f0f0f0;
        }
        body.dark-mode .table {
            color: #fff;
        }
        .keyword-strong {
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Keyword Density Checker</h2>

    <div class="text-end mb-3">
        <button onclick="toggleDarkMode()" class="btn btn-sm btn-secondary">Toggle Dark Mode</button>
    </div>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <textarea name="content" rows="7" class="form-control" placeholder="Paste your text content here..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Analyze</button>
    </form>

    <div class="ad-space mt-4">
        <span>Ad Space</span>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $content = strtolower(strip_tags($_POST['content'])); // Remove HTML tags and lower
        $words = str_word_count($content, 1);
        
        // Remove very small/common words
        $stopWords = ['a', 'an', 'the', 'in', 'on', 'of', 'for', 'and', 'to', 'with', 'by', 'is', 'at', 'it', 'this', 'that', 'be'];
        $filteredWords = array_filter($words, function($word) use ($stopWords) {
            return strlen($word) > 2 && !in_array($word, $stopWords);
        });

        $totalWords = count($filteredWords);
        $wordFrequency = array_count_values($filteredWords);
        arsort($wordFrequency); // Sort highest first

        if ($totalWords > 0) {
            echo "<div class='card mt-4 p-4'>";
            echo "<h5>Total Keywords Analyzed: $totalWords</h5>";

            echo "<div class='table-responsive mt-3'>";
            echo "<table class='table table-striped table-hover'>";
            echo "<thead class='table-dark'><tr><th>#</th><th>Keyword</th><th>Count</th><th>Density (%)</th></tr></thead><tbody>";

            $rank = 1;
            foreach ($wordFrequency as $word => $count) {
                $density = ($count / $totalWords) * 100;
                $highlight = ($rank <= 5) ? "keyword-strong" : "";
                echo "<tr>";
                echo "<td>$rank</td>";
                echo "<td class='$highlight'>" . htmlspecialchars($word) . "</td>";
                echo "<td>$count</td>";
                echo "<td>" . number_format($density, 2) . "%</td>";
                echo "</tr>";
                $rank++;
            }

            echo "</tbody></table>";
            echo "</div>";

            echo "</div>";
        } else {
            echo "<div class='alert alert-warning mt-4'>No valid keywords found in your content!</div>";
        }
    }
    ?>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Dark Mode Toggle
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
}
</script>

</body>
</html>
