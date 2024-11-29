<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Homepage</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            const prevButton = document.getElementById('prev');
            const nextButton = document.getElementById('next');
            const slider = document.querySelector('.image-slider');
            let currentIndex = 0;

            function showSlide(index) {
                currentIndex = (index + slides.length) % slides.length;
                const offset = -currentIndex * 100;
                slider.style.transform = `translateX(${offset}%)`;
            }

            prevButton.addEventListener('click', function() {
                showSlide(currentIndex - 1);
            });

            nextButton.addEventListener('click', function() {
                showSlide(currentIndex + 1);
            });

            setInterval(function() {
                showSlide(currentIndex + 1);
            }, 5000);
        });
    </script>
</head>
<body>
    <header>
        <nav class="Navbar">
            <ul>
                <li><img src="events.jfif" alt="Logo" class="logo"></li>
                <li><a href="#">HOME</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="service.html">SERVICES</a></li>
                <li><a href="#">GALLERY</a></li>
                <li><a href="#">CONTACT</a></li>
                <?php
                    // Check if the user is logged in
                    if (isset($_SESSION['email'])) {
                        echo '<li><a href="logout.php">LOGOUT</a></li>';  // Show logout link
                    } else {
                        echo '<li><a href="index.php">LOGIN</a></li>';  // Show login link
                    }
                ?>
                <li class="search">
                    <input type="text" placeholder="Search...">
                    <button type="submit">Search</button>
                </li>
            </ul>
        </nav>
    </header>

    <div class="slider-container">
        <div class="image-slider">
            <img src="images7.jfif" class="slide" alt="image1">
            <div class="banner-text">
                <h4>Welcome <br> to EVENTOPIA</h4>
                <p>The Biggest Event Management company of <br> Pakistan with versatile skills and services</p>
            </div>
            
            <div class="slide-container">
                <img src="fireworks2.png" class="slide" alt="image2">
                <div class="banner-text">
                    <h4>SINDH PUNJAB<br> BALOCHISTAN KPK</h4>
                    <p>Eventopia operates across Pakistan wherever you are we will be there</p>
                </div>
            </div>

            <div class="slide-container">
                <img src="passport6.png" class="slide" alt="image3">
                <div class="banner-text">
                    <h4>DESTINATION<br>WEDDINGS</h4>
                    <p>Whether it is Thailand or Sri Lanka, Turkey or Azerbaijan, Eventopia can</p>
                    <p>plan a fabulous wedding, miles away for you</p>
                </div>
            </div>

            <div class="slide-container">
                <img src="dream1.png" class="slide" alt="image4">
                <div class="banner-text">
                    <h4>WE DESIGN<br>YOUR DREAMS</h4>
                    <p>At Eventopia we take your event as our personal adventure because we believe your story is ours</p>
                </div>
            </div>
        </div>
        <div class="arrow left" id="prev">&lt;</div>
        <div class="arrow right" id="next">&gt;</div>
    </div>
    
    <main>
    <section class="features" id="features">
            <h1 class="heading">Our <span>Features</span></h1>
            <div class="box-container">
                <div class="box">
                    <i class="fas fa-calendar-check"></i> <!-- Icon -->
                    <h3>Event Creation and Management</h3>
                    <p>Effortlessly create and manage events, define details, and track progress.</p>
                    <button class="feature-btn">Learn More</button>
                </div>
                <div class="box">
                    <i class="fas fa-user-friends"></i> <!-- Icon -->
                    <h3>Guest Management</h3>
                    <p>Manage guest lists, track attendance, and simplify check-ins.</p>
                    <button class="feature-btn">Learn More</button>
                </div>
                <div class="box">
                    <i class="fas fa-boxes"></i> <!-- Icon -->
                    <h3>Resource Management</h3>
                    <p>Organize venues, equipment, and personnel efficiently.</p>
                    <button class="feature-btn">Learn More</button>
                </div>
                <div class="box">
                    <i class="fas fa-wallet"></i> <!-- Icon -->
                    <h3>Budget Management</h3>
                    <p>Track expenses and maintain a balanced event budget.</p>
                    <button class="feature-btn">Learn More</button>
                </div>
                <div class="box">
                    <i class="fas fa-comments"></i> <!-- Icon -->
                    <h3>Communication and Collaboration</h3>
                    <p>Seamless team communication with messaging and task tools.</p>
                    <button class="feature-btn">Learn More</button>
                </div>
                <div class="box">
                    <i class="fas fa-chart-line"></i> <!-- Icon -->
                    <h3>Reporting and Analytics</h3>
                    <p>Generate insightful reports on attendance, finances, and feedback.</p>
                    <button class="feature-btn">Learn More</button>
                </div>
                <div class="box">
                    <i class="fas fa-credit-card"></i> <!-- Icon -->
                    <h3>Payment Processing</h3>
                    <p>Secure online payments for event registrations.</p>
                    <button class="feature-btn">Learn More</button>
                </div>
                <div class="box">
                    <i class="fas fa-cogs"></i> <!-- Icon -->
                    <h3>Customization</h3>
                    <p>Tailor the platform to suit specific event needs.</p>
                    <button class="feature-btn">Learn More</button>
                </div>
                <div class="box">
                    <i class="fas fa-mobile-alt"></i> <!-- Icon -->
                    <h3>Mobile Access</h3>
                    <p>Manage events on-the-go with mobile-friendly tools.</p>
                    <button class="feature-btn">Learn More</button>
                </div>
            </div>
        </section>

        <section class="partition" id="partitons">
            <div class="part">
                <h4>Eventopia is a one window solution for your Events</h4>
            </div>
        </section>
        <section class="about-us" id="about">
            <h1 class="heading">ABOUT <span>US</span></h1>
            <div class="about-container">
                <div class="about-image">
                    <img src="ourstory.jpeg" alt="About Us Image">
                </div>
                <div class="about-description">
                    <h2 class="sub-heading">WE WILL GIVE A VERY SPECIAL <br> CELEBRATION FOR YOU</h2>
                    <p>
                        Welcome to Eventopia, the leading event management company in Pakistan.
                        We<br> specialize in planning and executing events that reflect your vision and style.
                    </p>
                    <p>
                        With operations spanning across Pakistan and beyond, we pride ourselves 
                        on <br> our ability to turn dreams into reality. Let Eventopia be a part of your story!
                    </p>
                </div>
            </div>
        </section>
        <footer>
        <p>&copy; 2024 Event Platform</p>
                </footer>
    </main>
</body>
</html>
