<?php
// font-generator.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Font Generator - Preview & Download</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts (Loaded in bulk) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Poppins&family=Pacifico&family=Monoton&family=Lobster&family=Oswald&family=Playfair+Display&family=Raleway&family=Rubik&family=Orbitron&family=Indie+Flower&family=Shadows+Into+Light&family=Fjalla+One&family=Quicksand&family=PT+Sans&family=Merriweather&family=Bebas+Neue&family=Caveat&family=Great+Vibes&family=Anton&family=Fredoka&family=Signika&family=Baloo+2&family=Barlow&family=Mukta&family=Titillium+Web&family=Yanone+Kaffeesatz&family=Source+Sans+Pro&family=Amatic+SC&family=Abel&family=Courgette&family=Kaushan+Script&family=Alfa+Slab+One&family=Satisfy&family=Coming+Soon&family=Arvo&family=Crete+Round&family=Josefin+Sans&family=Libre+Baskerville&family=Zilla+Slab&family=Ubuntu&family=Varela+Round&family=Cabin&family=Righteous&family=Abril+Fatface&family=Permanent+Marker&family=Yantramanav&family=Patrick+Hand&family=Sacramento&family=Archivo+Black&family=Chewy&family=Gloria+Hallelujah&family=Short+Stack&family=Unica+One&family=Poiret+One&family=Special+Elite&family=Overpass&family=Exo+2&family=Prompt&family=Teko&family=Manrope&family=Mukta+Vaani&family=Kanit&family=Oxygen&family=Nanum+Gothic&family=Noticia+Text&family=Asap&family=Arimo&family=Glegoo&family=Domine&family=Mali&family=Viga&family=Francois+One&family=Hind&family=Kumbh+Sans&family=Work+Sans&family=PT+Serif&family=Archivo&family=Assistant&family=Didact+Gothic&family=Heebo&family=Lexend&family=Oleo+Script&family=Chivo&family=Bitter&family=DM+Sans&family=Slabo+27px&family=Mada&family=Bellota&family=Grandstander&family=Kalam&family=Noto+Sans&family=Baloo+Chettan+2&family=Eczar&family=Neuton&family=Syne&family=Tajawal&family=Zen+Kaku+Gothic+Antique&family=Yatra+One&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .ads-space {
            background: #e9ecef;
            border: 2px dashed #ced4da;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: #6c757d;
        }
        .preview-box {
            min-height: 200px;
            background: #ffffff;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 30px;
            font-size: 2rem;
            margin-top: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }
        footer {
            margin-top: 40px;
            padding: 20px;
            background: #343a40;
            color: #ffffff;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- Top Ads Space -->
<div class="container">
    <div class="ads-space">
        Top Advertisement Space (728x90)
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <h1 class="text-center mb-4">🖋️ Font Generator & Preview Tool</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="fontForm">
                <div class="mb-3">
                    <label for="textInput" class="form-label">Enter Your Text:</label>
                    <textarea class="form-control" id="textInput" rows="3" placeholder="Type here..."></textarea>
                </div>
                <div class="mb-3">
                    <label for="fontSelect" class="form-label">Choose a Font:</label>
                    <select class="form-select" id="fontSelect">
                        <option value="'Poppins', sans-serif">Poppins (Default)</option>
                        <option value="'Roboto', sans-serif">Roboto</option>
                        <option value="'Pacifico', cursive">Pacifico</option>
                        <option value="'Monoton', cursive">Monoton</option>
                        <option value="'Lobster', cursive">Lobster</option>
                        <option value="'Oswald', sans-serif">Oswald</option>
                        <option value="'Playfair Display', serif">Playfair Display</option>
                        <option value="'Raleway', sans-serif">Raleway</option>
                        <option value="'Rubik', sans-serif">Rubik</option>
                        <option value="'Orbitron', sans-serif">Orbitron</option>
                        <option value="'Indie Flower', cursive">Indie Flower</option>
                        <option value="'Shadows Into Light', cursive">Shadows Into Light</option>
                        <option value="'Fjalla One', sans-serif">Fjalla One</option>
                        <option value="'Quicksand', sans-serif">Quicksand</option>
                        <option value="'PT Sans', sans-serif">PT Sans</option>
                        <option value="'Merriweather', serif">Merriweather</option>
                        <option value="'Bebas Neue', sans-serif">Bebas Neue</option>
                        <option value="'Caveat', cursive">Caveat</option>
                        <option value="'Great Vibes', cursive">Great Vibes</option>
                        <option value="'Anton', sans-serif">Anton</option>
                        <option value="'Fredoka', sans-serif">Fredoka</option>
                        <option value="'Signika', sans-serif">Signika</option>
                        <option value="'Baloo 2', cursive">Baloo 2</option>
                        <option value="'Barlow', sans-serif">Barlow</option>
                        <option value="'Mukta', sans-serif">Mukta</option>
                        <option value="'Titillium Web', sans-serif">Titillium Web</option>
                        <option value="'Yanone Kaffeesatz', sans-serif">Yanone Kaffeesatz</option>
                        <option value="'Source Sans Pro', sans-serif">Source Sans Pro</option>
                        <option value="'Amatic SC', cursive">Amatic SC</option>
                        <option value="'Abel', sans-serif">Abel</option>
                        <option value="'Courgette', cursive">Courgette</option>
                        <option value="'Kaushan Script', cursive">Kaushan Script</option>
                        <option value="'Alfa Slab One', cursive">Alfa Slab One</option>
                        <option value="'Satisfy', cursive">Satisfy</option>
                        <option value="'Coming Soon', cursive">Coming Soon</option>
                        <option value="'Arvo', serif">Arvo</option>
                        <option value="'Crete Round', serif">Crete Round</option>
                        <option value="'Josefin Sans', sans-serif">Josefin Sans</option>
                        <option value="'Libre Baskerville', serif">Libre Baskerville</option>
                        <option value="'Zilla Slab', serif">Zilla Slab</option>
                        <option value="'Ubuntu', sans-serif">Ubuntu</option>
                        <option value="'Varela Round', sans-serif">Varela Round</option>
                        <option value="'Cabin', sans-serif">Cabin</option>
                        <option value="'Righteous', cursive">Righteous</option>
                        <option value="'Abril Fatface', cursive">Abril Fatface</option>
                        <option value="'Permanent Marker', cursive">Permanent Marker</option>
                        <option value="'Yantramanav', sans-serif">Yantramanav</option>
                        <option value="'Patrick Hand', cursive">Patrick Hand</option>
                        <option value="'Sacramento', cursive">Sacramento</option>
                        <option value="'Archivo Black', sans-serif">Archivo Black</option>
                        <option value="'Chewy', cursive">Chewy</option>
                        <option value="'Gloria Hallelujah', cursive">Gloria Hallelujah</option>
                        <option value="'Short Stack', cursive">Short Stack</option>
                        <option value="'Unica One', sans-serif">Unica One</option>
                        <option value="'Poiret One', cursive">Poiret One</option>
                        <option value="'Special Elite', cursive">Special Elite</option>
                        <option value="'Overpass', sans-serif">Overpass</option>
                        <option value="'Exo 2', sans-serif">Exo 2</option>
                        <option value="'Prompt', sans-serif">Prompt</option>
                        <option value="'Teko', sans-serif">Teko</option>
                        <option value="'Manrope', sans-serif">Manrope</option>
                        <option value="'Mukta Vaani', sans-serif">Mukta Vaani</option>
                        <option value="'Kanit', sans-serif">Kanit</option>
                        <option value="'Oxygen', sans-serif">Oxygen</option>
                        <option value="'Nanum Gothic', sans-serif">Nanum Gothic</option>
                        <option value="'Noticia Text', serif">Noticia Text</option>
                        <option value="'Asap', sans-serif">Asap</option>
                        <option value="'Arimo', sans-serif">Arimo</option>
                        <option value="'Glegoo', serif">Glegoo</option>
                        <option value="'Domine', serif">Domine</option>
                        <option value="'Mali', cursive">Mali</option>
                        <option value="'Viga', sans-serif">Viga</option>
                        <option value="'Francois One', sans-serif">Francois One</option>
                        <option value="'Hind', sans-serif">Hind</option>
                        <option value="'Kumbh Sans', sans-serif">Kumbh Sans</option>
                        <option value="'Work Sans', sans-serif">Work Sans</option>
                        <option value="'PT Serif', serif">PT Serif</option>
                        <option value="'Archivo', sans-serif">Archivo</option>
                        <option value="'Assistant', sans-serif">Assistant</option>
                        <option value="'Didact Gothic', sans-serif">Didact Gothic</option>
                        <option value="'Heebo', sans-serif">Heebo</option>
                        <option value="'Lexend', sans-serif">Lexend</option>
                        <option value="'Oleo Script', cursive">Oleo Script</option>
                        <option value="'Chivo', sans-serif">Chivo</option>
                        <option value="'Bitter', serif">Bitter</option>
                        <option value="'DM Sans', sans-serif">DM Sans</option>
                        <option value="'Slabo 27px', serif">Slabo 27px</option>
                        <option value="'Mada', sans-serif">Mada</option>
                        <option value="'Bellota', cursive">Bellota</option>
                        <option value="'Grandstander', cursive">Grandstander</option>
                        <option value="'Kalam', cursive">Kalam</option>
                        <option value="'Noto Sans', sans-serif">Noto Sans</option>
                        <option value="'Baloo Chettan 2', cursive">Baloo Chettan 2</option>
                        <option value="'Eczar', serif">Eczar</option>
                        <option value="'Neuton', serif">Neuton</option>
                        <option value="'Syne', sans-serif">Syne</option>
                        <option value="'Tajawal', sans-serif">Tajawal</option>
                        <option value="'Zen Kaku Gothic Antique', sans-serif">Zen Kaku Gothic Antique</option>
                        <option value="'Yatra One', cursive">Yatra One</option>
                    </select>
                </div>
            </form>

            <div id="preview" class="preview-box">
                Your text preview will appear here!
            </div>
        </div>
    </div>
</div>

<!-- Bottom Ads Space -->
<div class="container mt-5">
    <div class="ads-space">
        Bottom Advertisement Space (728x90)
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; 2025 Font Generator | Made with ❤️ in PHP, Bootstrap & JavaScript
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script>
    const textInput = document.getElementById('textInput');
    const fontSelect = document.getElementById('fontSelect');
    const preview = document.getElementById('preview');

    function updatePreview() {
        preview.style.fontFamily = fontSelect.value;
        preview.textContent = textInput.value || 'Your text preview will appear here!';
    }

    textInput.addEventListener('input', updatePreview);
    fontSelect.addEventListener('change', updatePreview);
</script>

</body>
</html>
