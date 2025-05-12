<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Builder</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            padding-top: 50px;
        }
        .container {
            max-width: 1200px;
        }
        .form-container, .resume-preview {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .section-heading {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #007bff;
        }
        .form-control, .form-group {
            margin-bottom: 15px;
        }
        .resume-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .resume-preview h3 {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-top: 20px;
        }
        .resume-content {
            margin-top: 30px;
        }
        .ad-space {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            margin: 20px 0;
        }
        .ad-space a {
            text-decoration: none;
            color: #333;
            font-size: 1.2rem;
        }
        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1rem;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>

<!-- Ad Space at the Top -->
<div class="ad-space">
    <p>Ad Space - Promote Your Brand Here</p>
</div>

<!-- Main Container -->
<div class="container">

    <!-- Resume Builder Form -->
    <div class="row">
        <div class="col-md-6 form-container">
            <h2 class="text-center">Create Your Resume</h2>
            <form id="resumeForm">
                <!-- Personal Details Section -->
                <div class="section-heading">Personal Details</div>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number">
                </div>

                <!-- Job Title -->
                <div class="form-group">
                    <label for="jobTitle">Job Title</label>
                    <input type="text" class="form-control" id="jobTitle" placeholder="Enter Job Title">
                </div>

                <!-- Upload Profile Photo -->
                <div class="form-group">
                    <label for="profilePhoto">Upload Photo</label>
                    <input type="file" class="form-control" id="profilePhoto" accept="image/*">
                </div>

                <!-- About Me Section -->
                <div class="section-heading">About Me</div>
                <div class="form-group">
                    <textarea class="form-control" id="aboutMe" rows="4" placeholder="Tell us about yourself"></textarea>
                </div>

                <!-- Skills Section -->
                <div class="section-heading">Skills</div>
                <div class="form-group">
                    <textarea class="form-control" id="skills" rows="4" placeholder="Enter Skills (comma separated)"></textarea>
                </div>

                <!-- Experience Section -->
                <div class="section-heading">Experience</div>
                <div class="form-group">
                    <textarea class="form-control" id="experience" rows="4" placeholder="Enter Your Work Experience"></textarea>
                </div>

                <!-- Education Section -->
                <div class="section-heading">Education</div>
                <div class="form-group">
                    <textarea class="form-control" id="education" rows="4" placeholder="Enter Your Education Details"></textarea>
                </div>

                <!-- Hobbies Section -->
                <div class="section-heading">Hobbies</div>
                <div class="form-group">
                    <textarea class="form-control" id="hobbies" rows="4" placeholder="Enter Your Hobbies"></textarea>
                </div>

                <button type="button" class="btn btn-primary" onclick="generateResume()">Generate Resume</button>
            </form>
        </div>

        <!-- Resume Preview -->
        <div class="col-md-6 form-container resume-preview">
            <h3>Resume Preview</h3>
            <div class="resume-header">
                <img id="previewPhoto" class="profile-photo" src="https://via.placeholder.com/100" alt="Profile Photo">
                <h4 id="previewName">John Doe</h4>
                <p id="previewJobTitle">Software Developer</p>
                <p id="previewContact">Email: john.doe@example.com | Phone: 123-456-7890</p>
            </div>
            <div class="resume-content">
                <h5>About Me</h5>
                <p id="previewAboutMe">A passionate software developer with a knack for problem-solving.</p>
                <h5>Skills</h5>
                <ul id="previewSkills">
                    <li>JavaScript</li>
                    <li>PHP</li>
                    <li>React.js</li>
                </ul>
                <h5>Experience</h5>
                <p id="previewExperience">Worked as a Full Stack Developer at XYZ Company.</p>
                <h5>Education</h5>
                <p id="previewEducation">Bachelor's Degree in Computer Science from ABC University.</p>
                <h5>Hobbies</h5>
                <p id="previewHobbies">Reading, Traveling, Coding</p>
            </div>
        </div>
    </div>

</div>

<!-- Ad Space at the Bottom -->
<div class="ad-space">
    <p>Ad Space - Promote Your Brand Here</p>
</div>

<!-- Bootstrap JS & jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for Dynamic Resume Preview -->
<script>
    function generateResume() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var jobTitle = document.getElementById("jobTitle").value;
        var aboutMe = document.getElementById("aboutMe").value;
        var skills = document.getElementById("skills").value;
        var experience = document.getElementById("experience").value;
        var education = document.getElementById("education").value;
        var hobbies = document.getElementById("hobbies").value;
        var photo = document.getElementById("profilePhoto").files[0];

        // Update the preview with the entered data
        document.getElementById("previewName").textContent = name || "John Doe";
        document.getElementById("previewJobTitle").textContent = jobTitle || "Software Developer";
        document.getElementById("previewContact").textContent = "Email: " + (email || "john.doe@example.com") + " | Phone: " + (phone || "123-456-7890");
        document.getElementById("previewAboutMe").textContent = aboutMe || "A passionate software developer with a knack for problem-solving.";

        // Skills (comma separated)
        var skillList = skills.split(',').map(function(skill) {
            return '<li>' + skill.trim() + '</li>';
        }).join('');
        document.getElementById("previewSkills").innerHTML = skillList || "<li>JavaScript</li><li>PHP</li><li>React.js</li>";

        document.getElementById("previewExperience").textContent = experience || "Worked as a Full Stack Developer at XYZ Company.";
        document.getElementById("previewEducation").textContent = education || "Bachelor's Degree in Computer Science from ABC University.";
        document.getElementById("previewHobbies").textContent = hobbies || "Reading, Traveling, Coding";

        // Display Photo
        if (photo) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("previewPhoto").src = e.target.result;
            };
            reader.readAsDataURL(photo);
        }
    }
</script>

</body>
</html>
