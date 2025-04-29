<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Authentication/Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/Member/style.css">
    <script src="../jquery.js"></script>
    <title>Full Responsive Fitness Website Design Tutorial</title>
</head>

<body>

    <!-- Header Section Start -->
    <header>
        <nav>
            <ul>
                <!-- These anchor links will scroll the page to the corresponding section -->
                <li><a href="#home">Home</a></li>
                <li><a href="#feature">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#membership">Schedules</a></li>
                <li><a href="./MemberProfile.php">Member Profile</a></li>
                <li><a href="../Authentication/logout.php">Logout</a></li>
                
            </ul>
        </nav>

        <div class="fas fa-bars"></div>

        <div class="logo">
            <a href="#"><h1><span>Power</span>Fit</h1></a>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Home Section Start -->
    <section id="home" class="hero-section container-fluid">
    <div class="row">
        <!-- First Column for Text -->
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <h1 class="gym-name-home">Power Fit</h1>
            <p>Transform your fitness journey with expert trainers and top-class equipment.</p>
        </div>
        <!-- Second Column for Image -->
        <div class="col-md-6 position-relative">
            <img src="../../../assets/images/home_builder.png" alt="Man with dumbbells" class="img-fluid">
            <h1 class="gym-name-home text-overlay">Power Fit</h1>
        </div>
    </div>
</section>


    <!-- Home Section End -->

    <!-- Feature Section Start -->
    <section id="feature">
        <h1>Features</h1>
        <div class="card-container">
            <!-- Card 1 -->
            <div class="card">
            <img src="/gym_management_system/frontend/assets/images/heavyweight.jpg" alt="Heavy Weight">
                <div class="content">
                    <h1>Heavy Weights</h1>
                    <p>Our gym offers a wide range of heavy weights to help you build strength and muscle. Whether you are a beginner or an experienced lifter, you’ll find the equipment you need for your workouts. Train safely and effectively with our high-quality weights and supportive environment.</p>
                    
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card">
            <img src="/gym_management_system/frontend/assets/images/experttraimer.jpg" alt="Expert Trainer">
    <div class="content">
        <h1>Expert Trainers</h1>
        <p>Our gym is proud to have a team of expert trainers who are dedicated to guiding you every step of the way. With years of experience and professional certifications, our trainers create personalized workout plans and provide constant support to help you reach your fitness goals safely and effectively. Whether you need motivation, advice, or a new challenge, our trainers are always here to help you succeed.</p>
        
    </div>
</div>

            <!-- Card 3 -->
            <div class="card">
            <img src="/gym_management_system/frontend/assets/images/ecoenvironment.jpg" alt="Eco Environment">
                <div class="content">
                    <h1>Eco Environment</h1>
                    <p>Our gym features an echo-friendly environment designed for your comfort. We use special sound-absorbing materials like rubber flooring and acoustic panels to reduce noise and echoes, making workouts quieter and more enjoyable for everyone. This helps you focus better during your sessions and creates a calm, welcoming space for all members.</p>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Feature Section End -->

    <!-- About Section Start -->
    <section id="about">
        <div class="image">
            <img src="pic.png" alt="">
        </div>

        <div class="content">
            <h1>Why You Should Choose Us?</h1>
            <p>
            At our gym, we’re committed to helping you achieve your fitness goals in a friendly and motivating environment. Our state-of-the-art equipment, experienced trainers, and flexible membership plans make it easy for everyone to get started and stay on track. Whether you’re a beginner or a seasoned athlete, we offer personalized support and a wide range of classes to keep you inspired. Choose us for a healthier, happier you!
              
            </p>

            <h1>Our Gym Includes</h1>
            <div class="buttons">
                <a href="#"><button>Training</button></a>
                <a href="#"><button>Exercise</button></a>
                <a href="#"><button>Bicycle</button></a>
                <a href="#"><button>Treadmill</button></a>
                <a href="#"><button>Dumbbell</button></a>
                <a href="#"><button>Barbell</button></a>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Gallery Section Start -->
    <section id="gallery">
        <h1>Our Latest Products</h1>
        <div class="image-container">
            <!-- Gallery Images -->
            <div class="image">
            <img src="/gym_management_system/frontend/assets/images/product01.jpg" alt="Eco Environment">
                <div class="info">
                    <a ><button>status= working</button></a>
                </div>
            </div>

            <div class="image">
            <img src="/gym_management_system/frontend/assets/images/product02.jpg" alt="Eco Environment">
                <div class="info">
                    <a href="#"><button>status = under maintenence</button></a>
                </div>
            </div>

            <div class="image">
            <img src="/gym_management_system/frontend/assets/images/product03.jpg" alt="Eco Environment">
                <div class="info">
                    <a href="#"><button>status= working</button></a>
                </div>
            </div>

            <div class="image">
            <img src="/gym_management_system/frontend/assets/images/product04.jpg" alt="Eco Environment">
                <div class="info">
                    <a href="#"><button>status= working</button></a>
                </div>
            </div>

            <div class="image">
            <img src="/gym_management_system/frontend/assets/images/product05.jpg" alt="Eco Environment">
                <div class="info">
                    <a href="#"><button>status= working</button></a>
                </div>
            </div>

            <div class="image">
            <img src="/gym_management_system/frontend/assets/images/product06.jpg" alt="Eco Environment">
                <div class="info">
                    <a href="#"><button>status= working</button></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Section End -->

    <!-- Contact Us Section Start -->
    <section id="contact">
        <form action="">
            <h1>Get In Touch</h1>
            <input type="text" placeholder="Full Name">
            <input type="email" placeholder="E-mail">
            <input type="number" placeholder="Phone">
            <textarea placeholder="Message" cols="30" rows="10"></textarea>
            <input type="submit" value="Send">
        </form>

        <div class="image">
        <img src="/gym_management_system/frontend/assets/images/message.jpg" alt="Eco Environment">
        </div>
    </section>
    <!-- Contact Us Section End -->

    <section id="membership">
    <div class="container">
        <h1 class="section-title">Workout Schedules</h1>
        <table class="workout-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>User ID</th>
                </tr>
            </thead>
            <tbody id="workoutTableBody">
                <!-- Workout rows will be inserted here -->
            </tbody>
        </table>
    </div>
</section>

    <!-- Footer Section Start -->
    <section id="footer">
        <div class="footer-container">
            <!-- Brand -->
            <div class="brand">
                <div class="logo">
                    <a href="#"><h1><span>Power</span>Fit</h1></a>
                </div>
                
            </div>

            <!-- Contact Info -->
            <div class="contact-info">
                <div class="info">
                    <a href="#" class="fas fa-map-marker-alt" data-text="XYZ Address"></a>
                    <a href="#" class="fas fa-envelope" data-text="example@gmail.com"></a>
                    <a href="#" class="fas fa-phone" data-text="+9100000000"></a>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="letter">
                <h1>Newsletter</h1>
                <p>Submit your e-mail for latest updates</p>
                <input type="email" placeholder="E-mail">
                <input type="submit" value="Subscribe">
            </div>
        </div>
    </section>
    <!-- Footer Section End -->

    <!-- Script Section Start -->
    <script>
document.addEventListener('DOMContentLoaded', () => {
    // Navbar toggle
    const menuToggle = document.querySelector('.fa-bars');
    const nav = document.querySelector('nav');
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('fa-times');
        nav.classList.toggle('nav-toggle');
    });

    // Collapse nav on link click
    const navLinks = document.querySelectorAll('nav ul li a');
    navLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            // Check if the link href is pointing to an internal section
            if (link.getAttribute("href").startsWith("#")) {
                // Prevent default anchor behavior
                event.preventDefault();
                
                const targetId = link.getAttribute("href").substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: "smooth" });
                }
            }
        });
    });
});
    // Header scroll effect
    window.addEventListener('scroll', () => {
        if (window.scrollY >= 20) {
            document.querySelector('header').classList.add('active');
        } else {
            document.querySelector('header').classList.remove('active');
        }
    });

    // Load workouts when "Schedules" is clicked
    const scheduleLink = document.querySelector("a[href='#membership']");
    scheduleLink.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default anchor behavior

        // Log to verify the event is triggered
        console.log("Schedules link clicked!");

        const container = document.getElementById("workoutTableBody");
        
        // Ensure the container exists
        if (!container) {
            console.error("Table container not found!");
            return;
        }

        // Prevent multiple loads
        if (container.dataset.loaded === "true") return;

        // Check if the fetch is being called
        console.log("Fetching workouts...");

        fetch("../../../../../backend/controllers/Trainer/getAllWorkout.php")
            .then(response => {
                console.log("Response received!");
                return response.json();
            })
            .then(data => {
                console.log("Data loaded:", data);
                container.innerHTML = ""; // Clear old content

                // Handle error from backend
                if (data.error) {
                    container.innerHTML = `<tr><td colspan="3">${data.error}</td></tr>`;
                    return;
                }

                // Handle message (e.g. "No workouts available.")
                if (data.message) {
                    container.innerHTML = `<tr><td colspan="3">${data.message}</td></tr>`;
                    return;
                }

                // Generate table rows
                data.forEach(workout => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${workout.title}</td>
                        <td>${workout.description}</td>
                        <td>${workout.user_ID}</td>
                    `;
                    container.appendChild(row);
                });

                container.dataset.loaded = "true";
            })
            .catch(error => {
                console.error("Fetch failed:", error);
                container.innerHTML = `<tr><td colspan="3">Error loading workouts: ${error.message}</td></tr>`;
            });

        // Smooth scroll to the section
        document.getElementById("membership").scrollIntoView({ behavior: "smooth" });
    });
});

</script>


</body>

</html>
