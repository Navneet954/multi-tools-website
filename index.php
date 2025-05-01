<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Multi-Tools Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'top_links.php'; ?> <!-- Link to your stylesheets and JS files -->
    <style>
    body {
        background: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    .section-heading {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: #333;
    }

    .category-title {
        font-size: 1.8rem;
        font-weight: 600;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
        color: #007bff;
        border-bottom: 2px solid #007bff;
        padding-bottom: 0.5rem;
    }

    .tool-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        padding: 30px 20px;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .tool-card a {
        font-size: 1.2rem;
        font-weight: 600;
        text-decoration: none;
        color: #343a40;
        transition: color 0.3s ease;
    }

    .tool-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #74ebd5 0%, #acb6e5 100%);
    }

    .tool-card:hover a {
        color: #ffffff;
    }

    #toolSearch {
        padding: 12px;
        font-size: 1.2rem;
        border-radius: 50px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        border: 1px solid #ccc;
        transition: all 0.3s ease;
    }

    #toolSearch:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }
</style>

</head>

<body>

<div class="row mb-4">
    <div class="col-md-6 offset-md-3">
        <input type="text" id="toolSearch" class="form-control my-5" placeholder="Search for a tool...">
    </div>
</div>

<div class="container mt-5" id="toolsContainer">
    <h3 class="text-center mb-5">Explore Tools by Categories</h3>

    <!-- Image Tools Section -->
    <h4 class="category-title">Image Tools</h4>
    <div class="row">
        <?php
        $image_tools = [
            "Image Resizer" => "image_tools/image_resizer/image-resizer.php",
            "Image Converter" => "image_tools/image_convertor/index.php",
            "Background Remover" => "image_tools/image_remover.php",
            "Image Cropper" => "image_tools/image_cropper.php",
            "Image Compressor" => "image_tools/image_compressor.php",
            "Image Filters" => "image_tools/image_filters.php",
            "QR Code Generator" => "image_tools/qr_code.php",
            "BarCode Generator" => "image_tools/barcode.php",
            "Screenshot to PDF" => "image_tools/Screenshot to PDF Converter.php"
        ];
        foreach ($image_tools as $name => $link) {
            echo '<div class="col-md-3 col-sm-6 mb-4">
                    <div class="tool-card">
                        <a href="' . $link . '">' . $name . '</a>
                    </div>
                  </div>';
        }
        ?>
    </div>

    <!-- Math Tools Section -->
    <h4 class="category-title">Math Tools</h4>
    <div class="row">
        <?php
        $math_tools = [
            "Percentage Converter" => "math_tools/Percentage Calculator.php",
            "Age Converter" => "math_tools/Age_Calculator.php",
            "EMI Calculator" => "math_tools/Loan_EMI_Calculator.php",
            "Scientific Calculator" => "math_tools/Scientific_Calculator.php",
            "Discount Calculator" => "math_tools/Discount_Calculator.php",
            "BMI Calculator" => "math_tools/BMI_Calculator.php",
            "Tip Calculator" => "math_tools/Tip_Calculator.php"
        ];
        foreach ($math_tools as $name => $link) {
            echo '<div class="col-md-3 col-sm-6 mb-4">
                    <div class="tool-card">
                        <a href="' . $link . '">' . $name . '</a>
                    </div>
                  </div>';
        }
        ?>
    </div>

    <!-- Text Tools Section -->
    <h4 class="category-title">Text Tools</h4>
    <div class="row">
        <?php
        $text_tools = [
            "Word Counter" => "text_tools/Word_Counter_Tool.php",
            "Character Counter" => "text_tools/Character_Counter.php",
            "Case Converter" => "text_tools/Case_Converter.php",
            "Grammar Checker" => "text_tools/Grammar Checker.php",
            "Text to Speech" => "text_tools/Text_to_Speech_Converter.php",
            "Fancy Text" => "text_tools/fancy-text-generator.php",
            "URL Encoder/Decoder" => "text_tools/url_encoder_decoder.php",
            "Remove Extra Spaces" => "text_tools/remove_spaces.php",
            "Plagiarism Checker" => "text_tools/Plagiarism Checker.php",
            "Random Text Generator" => "text_tools/Random Text Generator.php"
        ];
        foreach ($text_tools as $name => $link) {
            echo '<div class="col-md-3 col-sm-6 mb-4">
                    <div class="tool-card">
                        <a href="' . $link . '">' . $name . '</a>
                    </div>
                  </div>';
        }
        ?>
    </div>

    <!-- Binary Tools Section -->
    <h4 class="category-title">Binary Tools</h4>
    <div class="row">
        <?php
        $binary_tools = [
            "Binary to Decimal" => "Binary_tools/Binary_decimal.php",
            "Decimal to Binary" => "Binary_tools/Decimal_to_Binary.php",
            "Decimal to Octal" => "Binary_tools/decimal_oct.php",
            "Octal to Decimal" => "Binary_tools/oct_dec.php",
            "Binary to Hexadecimal" => "Binary_tools/Binary_Hexa.php",
            "Hexadecimal to Binary" => "Binary_tools/hexa_Binary.php"
        ];
        foreach ($binary_tools as $name => $link) {
            echo '<div class="col-md-3 col-sm-6 mb-4">
                    <div class="tool-card">
                        <a href="' . $link . '">' . $name . '</a>
                    </div>
                  </div>';
        }
        ?>
    </div>

    <!-- Miscellaneous Tools Section -->
    <h4 class="category-title">Miscellaneous Tools</h4>
    <div class="row">
        <?php
        $misc_tools = [
            "Currency Converter" => "Others/Currency Converter.php",
            "Color Code Picker" => "Others/Color_code.php"
        ];
        foreach ($misc_tools as $name => $link) {
            echo '<div class="col-md-3 col-sm-6 mb-4">
                    <div class="tool-card">
                        <a href="' . $link . '">' . $name . '</a>
                    </div>
                  </div>';
        }
        ?>
    </div>

    <!-- Developer Tools Section -->
    <h4 class="category-title">Developer Tools</h4>
    <div class="row">
        <?php
        $developer_tools = [
            "HTML Formatter" => "Developer_tools/HTML_formatter.php",
            "CSS Formatter" => "Developer_tools/CSS_formatter.php",
            "PHP Formatter" => "Developer_tools/PHP_formatter.php",
            "JS Minifier" => "Developer_tools/javascript_minifier.php",
            "SQL Formatter" => "Developer_tools/sql_formatter.php"
        ];
        foreach ($developer_tools as $name => $link) {
            echo '<div class="col-md-3 col-sm-6 mb-4">
                    <div class="tool-card">
                        <a href="' . $link . '">' . $name . '</a>
                    </div>
                  </div>';
        }
        ?>
    </div>
</div>

<script>
    document.getElementById('toolSearch').addEventListener('keyup', function () {
        let searchQuery = this.value.toLowerCase();
        let cards = document.querySelectorAll('.tool-card');

        cards.forEach(function (card) {
            let text = card.textContent.toLowerCase();
            if (text.includes(searchQuery)) {
                card.parentElement.style.display = 'block';
            } else {
                card.parentElement.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
