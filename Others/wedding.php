<?php
// wedding_invitation_generator.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wedding Invitation Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display&family=Roboto:wght@300;400&family=Dancing+Script&family=Montserrat&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .card {
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .invitation-card {
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin-top: 20px;
            min-height: 500px;
            transition: all 0.3s ease;
        }
        .template-selector {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        .template-btn {
            padding: 5px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .template-btn.active {
            background: #007bff;
            color: white;
        }
        
        /* Template Styles */
        .classic {
            background: linear-gradient(135deg, #f3e7e9 0%, #e3eeff 100%);
            font-family: 'Playfair Display', serif;
        }
        .modern {
            background: linear-gradient(45deg, #000000 0%, #434343 100%);
            color: white;
            font-family: 'Roboto', sans-serif;
        }
        .romantic {
            background: linear-gradient(to right, #ff758c 0%, #ff7eb3 100%);
            color: white;
            font-family: 'Great Vibes', cursive;
        }
        .rustic {
            background: url('https://www.transparenttextures.com/patterns/wood-pattern.png'), #8B4513;
            color: #FFE4C4;
            font-family: 'Playfair Display', serif;
        }
        .elegant {
            background: linear-gradient(135deg, #000000 0%, #434343 100%);
            color: #FFD700;
            font-family: 'Great Vibes', cursive;
        }
        .garden {
            background: url('https://www.transparenttextures.com/patterns/flowers.png'), #90EE90;
            font-family: 'Playfair Display', serif;
        }
        .minimalist {
            background: #ffffff;
            border: 1px solid #ddd;
            font-family: 'Roboto', sans-serif;
        }
        .vintage {
            background: url('https://www.transparenttextures.com/patterns/paper.png'), #F5DEB3;
            font-family: 'Playfair Display', serif;
        }
        .beach {
            background: linear-gradient(135deg, #00B4DB 0%, #0083B0 100%);
            color: white;
            font-family: 'Roboto', sans-serif;
        }
        .royal {
            background: linear-gradient(135deg, #141E30 0%, #243B55 100%);
            color: #FFD700;
            font-family: 'Great Vibes', cursive;
        }
        .bohemian {
            background: url('https://www.transparenttextures.com/patterns/natural-paper.png'), #D2B48C;
            font-family: 'Dancing Script', cursive;
            color: #4A4A4A;
        }
        .celestial {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: #E0E0E0;
            font-family: 'Montserrat', sans-serif;
        }
        .art-deco {
            background: linear-gradient(45deg, #2C3E50, #3498DB);
            color: #F1C40F;
            font-family: 'Great Vibes', cursive;
        }
        .tropical {
            background: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
            font-family: 'Dancing Script', cursive;
        }
        .winter {
            background: linear-gradient(to right, #e6dada, #274046);
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="ad-space">[ Your Top Advertisement Here ]</div>

    <h1 class="text-center mb-4">Wedding Invitation Generator</h1>

    <div class="template-selector">
        <button class="btn template-btn active" data-template="classic">Classic</button>
        <button class="btn template-btn" data-template="modern">Modern</button>
        <button class="btn template-btn" data-template="romantic">Romantic</button>
        <button class="btn template-btn" data-template="rustic">Rustic</button>
        <button class="btn template-btn" data-template="elegant">Elegant</button>
        <button class="btn template-btn" data-template="garden">Garden</button>
        <button class="btn template-btn" data-template="minimalist">Minimalist</button>
        <button class="btn template-btn" data-template="vintage">Vintage</button>
        <button class="btn template-btn" data-template="beach">Beach</button>
        <button class="btn template-btn" data-template="royal">Royal</button>
        <button class="btn template-btn" data-template="bohemian">Bohemian</button>
        <button class="btn template-btn" data-template="celestial">Celestial</button>
        <button class="btn template-btn" data-template="art-deco">Art Deco</button>
        <button class="btn template-btn" data-template="tropical">Tropical</button>
        <button class="btn template-btn" data-template="winter">Winter</button>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <form id="invitationForm">
                    <div class="mb-3">
                        <label class="form-label">Bride's Name</label>
                        <input type="text" class="form-control" id="bride" placeholder="Enter Bride's Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Groom's Name</label>
                        <input type="text" class="form-control" id="groom" placeholder="Enter Groom's Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Wedding Date</label>
                        <input type="date" class="form-control" id="date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Wedding Time</label>
                        <input type="time" class="form-control" id="time" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Venue</label>
                        <input type="text" class="form-control" id="venue" placeholder="Enter Venue" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Custom Message</label>
                        <textarea class="form-control" id="message" rows="3" placeholder="Write a lovely message..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Generate Invitation</button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="invitation-card classic" id="invitationPreview">
                <h2 id="previewBride">Bride's Name</h2>
                <h4>&</h4>
                <h2 id="previewGroom">Groom's Name</h2>
                <p id="previewDate">Date: </p>
                <p id="previewTime">Time: </p>
                <p id="previewVenue">Venue: </p>
                <p id="previewMessage">Your beautiful message will appear here!</p>
            </div>
        </div>
    </div>

    <div class="ad-space">[ Your Bottom Advertisement Here ]</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('invitationForm').addEventListener('input', function() {
    document.getElementById('previewBride').innerText = document.getElementById('bride').value || "Bride's Name";
    document.getElementById('previewGroom').innerText = document.getElementById('groom').value || "Groom's Name";
    document.getElementById('previewDate').innerText = "Date: " + (document.getElementById('date').value || "");
    document.getElementById('previewTime').innerText = "Time: " + (document.getElementById('time').value || "");
    document.getElementById('previewVenue').innerText = "Venue: " + (document.getElementById('venue').value || "");
    document.getElementById('previewMessage').innerText = document.getElementById('message').value || "Your beautiful message will appear here!";
});

document.getElementById('invitationForm').addEventListener('submit', function(e){
    e.preventDefault();
});

// Template Switching
document.querySelectorAll('.template-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.template-btn').forEach(btn => btn.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');
        
        // Remove all template classes from preview
        const preview = document.getElementById('invitationPreview');
        preview.className = 'invitation-card ' + this.dataset.template;
    });
});
</script>

</body>
</html>
