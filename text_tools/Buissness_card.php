<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Card Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            padding-top: 50px;
        }

        .card-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-preview {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
        }

        .card-preview h3 {
            margin: 0;
            font-size: 2rem;
        }

        .card-preview p {
            margin: 0;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
        }

        .ad-space {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            margin: 15px 0;
        }

        .ad-space p {
            color: #333;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.8rem;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<!-- Top Ad Space -->
<div class="ad-space">
    <p>Advertise Here - Your ad space</p>
</div>

<!-- Business Card Generator -->
<div class="container card-container">
    <h2 class="text-center">Business Card Generator</h2>

    <div class="card-preview" id="cardPreview">
        <h3 id="cardName">John Doe</h3>
        <p id="cardTitle">Web Developer</p>
        <p id="cardEmail">email@example.com</p>
        <p id="cardPhone">+123 456 789</p>
        <p id="cardWebsite">www.johndoe.com</p>
    </div>

    <form id="cardForm">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="title">Job Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter your job title">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
        </div>
        <div class="form-group">
            <label for="website">Website:</label>
            <input type="text" class="form-control" id="website" placeholder="Enter your website">
        </div>

        <button type="submit" class="btn btn-primary w-100">Generate Business Card</button>
    </form>
</div>

<!-- Bottom Ad Space -->
<div class="ad-space">
    <p>Advertise Here - Your ad space</p>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2025 Business Card Generator. All rights reserved.</p>
</div>

<!-- JavaScript -->
<script>
    // Preview the business card
    document.getElementById('cardForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const title = document.getElementById('title').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const website = document.getElementById('website').value;

        document.getElementById('cardName').innerText = name || 'John Doe';
        document.getElementById('cardTitle').innerText = title || 'Web Developer';
        document.getElementById('cardEmail').innerText = email || 'email@example.com';
        document.getElementById('cardPhone').innerText = phone || '+123 456 789';
        document.getElementById('cardWebsite').innerText = website || 'www.johndoe.com';
    });
</script>

</body>
</html>
