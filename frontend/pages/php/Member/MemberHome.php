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
    <title>Full Responsive Fitness Website Design Tutorial</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../../css/Member/style.css">
    
    <!-- jQuery -->
    <script src="../jquery.js"></script>

    <!-- Optional Bootstrap (for button styling) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

    <!-- Header Section Start -->
    <header>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#feature">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="./MemberProfile.php">Member Profile</a></li>
                <li><a href="../Authentication/logout.php">Logout</a></li>
                <li><a href="#footer">Footer</a></li>
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
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h1 class="gym-name-home">Power Fit</h1>
                <p>Transform your fitness journey with expert trainers and top-class equipment.</p>
            </div>
            <div class="col-md-6 position-relative">
                <img src="../../../assets/images/home_builder.png" alt="Man with dumbbells" class="img-fluid">
            </div>
        </div>
    </section>
    <!-- Home Section End -->

    <!-- Feature Section Start -->
    <section id="feature">
        <h1>Features</h1>
        <div class="card-container">
            <div class="card">
                <img src="/gym_management_system/frontend/assets/images/heavyweight.jpg" alt="Heavy Weight">
                <div class="content">
                    <h1>Heavy Weights</h1>
                    <p>Our gym offers a wide range of heavy weights to help you build strength and muscle.</p>
                </div>
            </div>

            <div class="card">
                <img src="/gym_management_system/frontend/assets/images/experttraimer.jpg" alt="Expert Trainer">
                <div class="content">
                    <h1>Expert Trainers</h1>
                    <p>Our team of certified trainers creates personalized workout plans to help you succeed.</p>
                </div>
            </div>

            <div class="card">
                <img src="/gym_management_system/frontend/assets/images/ecoenvironment.jpg" alt="Eco Environment">
                <div class="content">
                    <h1>Eco Environment</h1>
                    <p>Sound-absorbing materials ensure a calm and welcoming atmosphere for your workout.</p>
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
            <p>We offer expert trainers, top-class equipment, and a supportive fitness environment.</p>

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
            <div class="image">
                <img src="/gym_management_system/frontend/assets/images/product01.jpg" alt="Product">
                <div class="info"><button>status= working</button></div>
            </div>
            <div class="image">
                <img src="/gym_management_system/frontend/assets/images/product02.jpg" alt="Product">
                <div class="info"><button>status = under maintenance</button></div>
            </div>
            <div class="image">
                <img src="/gym_management_system/frontend/assets/images/product03.jpg" alt="Product">
                <div class="info"><button>status= working</button></div>
            </div>
            <div class="image">
                <img src="/gym_management_system/frontend/assets/images/product04.jpg" alt="Product">
                <div class="info"><button>status= working</button></div>
            </div>
            <div class="image">
                <img src="/gym_management_system/frontend/assets/images/product05.jpg" alt="Product">
                <div class="info"><button>status= working</button></div>
            </div>
            <div class="image">
                <img src="/gym_management_system/frontend/assets/images/product06.jpg" alt="Product">
                <div class="info"><button>status= working</button></div>
            </div>
        </div>
    </section>
    <!-- Gallery Section End -->

    <!-- Contact Section Start -->
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
            <img src="/gym_management_system/frontend/assets/images/message.jpg" alt="Message">
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Feedback Button Section Start -->
    <section id="feedback" class="text-center my-5">
    <a href="../../html/comment.html">
            <button class="btn btn-warning btn-lg">Give Feedback</button>
        </a>
    </section>
    <!-- Feedback Button Section End -->

    <!-- Footer Section Start -->
    <section id="footer">
        <div class="footer-container">
            <div class="brand">
                <div class="logo">
                    <a href="#"><h1><span>Power</span>Fit</h1></a>
                </div>
            </div>
            <div class="contact-info">
                <div class="info">
                    <a href="#" class="fas fa-map-marker-alt" data-text="XYZ Address"></a>
                    <a href="#" class="fas fa-envelope" data-text="example@gmail.com"></a>
                    <a href="#" class="fas fa-phone" data-text="+9100000000"></a>
                </div>
            </div>
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
        $(document).ready(function () {
            $('.fa-bars').click(function () {
                $(this).toggleClass('fa-times');
                $('nav').toggleClass('nav-toggle');
            });

            $('nav ul li a').click(function () {
                $('.fa-bars').removeClass('fa-times');
                $('nav').removeClass('nav-toggle');
            });

            $(window).scroll(function () {
                if ($(window).scrollTop() >= 20) {
                    $('header').addClass('active');
                } else {
                    $('header').removeClass('active');
                }
            });
        });
    </script>
    <!-- Script Section End -->

</body>

</html>
