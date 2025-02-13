<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Fit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="../../css/Home.css" rel="stylesheet">
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Power Fit</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section id="home" class="hero-section container-fluid">

        <div class="row">
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h1 class="gym-name-home">Power Fit</h1>
                <p>Transform your fitness journey with expert trainers and top-class equipment.</p>
            </div>
            <div class="col-md-6">
                <img src="../../assets/images/home_builder.png" alt="Man with dumbles">
            </div>
        </div>
    </section>


    <section id="about" class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="../../assets/images/about_builder.png" alt="Gym Workout" class="about-img">
                </div>
                <div class="col-md-5">
                    <h2 class="section-title">About <span>Power Fit</span></h2> <br><br>
                    <p class="section-para">
                        At <strong>Power Fit</strong>, we are committed to transforming your fitness journey. Our state-of-the-art gym provides world-class equipment, experienced trainers, and a supportive environment to help you achieve your fitness goals. Whether you're looking to build strength, lose weight, or improve endurance, we have the perfect program for you!
                    </p>
                    <!-- <ul class="about-list">
                        <li>🏋️‍♂️ Advanced Strength Training</li>
                        <li>💪 Personalized Fitness Programs</li>
                        <li>🔥 High-Intensity Cardio Sessions</li>
                        <li>🥗 Nutrition & Wellness Guidance</li>
                    </ul> -->
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="services-section py-5">
        <div class="container">
            <h2 class="text-center mb-4 servicetxt">Our <span>Services</span></h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-4 text-center">
                        <h4>💪 Strength Training</h4>
                        <p>Build muscle and increase endurance with our expert trainers.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 text-center">
                        <h4>🔥 Cardio Workouts</h4>
                        <p>High-intensity workouts to burn calories and improve heart health.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 text-center">
                        <h4>🥗 Nutrition Guidance</h4>
                        <p>Get personalized meal plans for a healthier lifestyle.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section py-5">
        <div class="container">
            <h2 class="text-center mb-4 contacttxt">Contact <span>Us</span></h2>
            <form action="../../../backend/controllers/Contact.php" method="POST" class="mx-auto w-50">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Message</button>
            </form>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
