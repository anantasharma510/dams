

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctor Appointment Management System</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    </head>
  
</head>

<body>
<header>
    <div class="header-container">
        <div class="logo">
            <img src="sam.png" alt="Sam Logo">
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about_us">About Us</a></li>
                <!-- <li><a href="#gallery">Gallery</a></li> -->
                <li><a href="#contact_us">Contact Us</a></li>
                <li><a href="#logins">Logins</a></li>
            </ul>
        </nav>
        <a class="appointment-button" href="dams/patient/index.html">Book an Appointment</a>
        <div class="hamburger">
        <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </div>
</header>


    <!-- ################# Slider Starts Here #######################--->
   <!-- ################# Slider Starts Here #######################--->
<div class="slider">
    <div class="slider-wrapper">
        <img src="assets/images/slider2.png" alt="Slider Image">
        <img src="assets/images/slider1.png" alt="Slider Image">
        <img src="assets/images/slider3.png" alt="Slider Image">
    </div>
   
    <button class="slider-arrow left-arrow">&lt;</button>
    <button class="slider-arrow right-arrow">&gt;</button>
</div>
<br>
    <br>
    <br>
<br>
<br>
    <!--  ************************* Logins ************************** -->
    <section id="logins" class=" login-section">
        <div class="login-container">
            <div class="login-item">
                <img src="assets/images/patient.png" alt="Patient">
                <h6>Patient Login</h6><br>
                <a href="dams/patient/index.html" target="_blank">
                    <button>Click Here</button>
                </a>
            </div>
            <div class="login-item">
                <img src="assets/images/doctor.png" alt="Doctor">
                <h6>Doctors Login</h6><br>
                <a href="dams/doctor/index.php" target="_blank">
                    <button>Click Here</button>
                </a>
            </div>
            <div class="login-item">
                <img src="assets/images/admin.png" alt="Admin">
                <h6>Admin Login</h6>
                <br>
                <a href="dams/admin/index.php" target="_blank">
                    <button>Click Here</button>
                </a>
            </div>
        </div>
    </section>
    <br>
    <br>
    <br>

    <!-- ################# Our Services Starts Here #######################--->
     <div id="services">
    <section class="key-features-section">
        <div class="container">
            <div class="intro-text">
                <h2>Our Key Features</h2>
                <p>Take a look at some of our key features</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                            <path d="M3.22 12H9.5l.5-1 2 4.5 2-7 1.5 3.5h5.27"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>24/7 Medical Care</h3>
                        <p>Our healthcare services are available around the clock to ensure you receive the care you need, whenever you need it.</p>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Personalized Treatment</h3>
                        <p>Our team of healthcare professionals work closely with you to develop a personalized treatment plan tailored to your specific needs.</p>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Secure Data Privacy</h3>
                        <p>We take the security and privacy of your medical data seriously, ensuring it is protected with the highest standards of encryption and access control.</p>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 18h8"></path>
                            <path d="M3 22h18"></path>
                            <path d="M14 22a7 7 0 1 0 0-14h-1"></path>
                            <path d="M9 14h2"></path>
                            <path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"></path>
                            <path d="M12 6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Advanced Diagnostics</h3>
                        <p>Our state-of-the-art diagnostic equipment and experienced medical staff ensure accurate and comprehensive testing to provide you with the best possible care.</p>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m10.5 20.5 10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7Z"></path>
                            <path d="m8.5 8.5 7 7"></path>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Comprehensive Treatments</h3>
                        <p>Our healthcare services cover a wide range of treatments, from preventative care to specialized procedures, ensuring you receive the comprehensive care you need.</p>
                    </div>
                </div>

                <div class="feature-card">
                    <div class="icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 10H6"></path>
                            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"></path>
                            <path d="M19 18h2a1 1 0 0 0 1-1v-3.28a1 1 0 0 0-.684-.948l-1.923-.641a1 1 0 0 1-.578-.502l-1.539-3.076A1 1 0 0 0 16.382 8H14"></path>
                            <path d="M8 8v4"></path>
                            <path d="M9 18h6"></path>
                            <circle cx="17" cy="18" r="2"></circle>
                            <circle cx="7" cy="18" r="2"></circle>
                        </svg>
                    </div>
                    <div class="feature-content">
                        <h3>Emergency Services</h3>
                        <p>In case of emergencies, our dedicated team is ready to provide immediate and efficient medical care to ensure your safety.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
<!-- ################# About Us Section Starts Here #######################--->
<section id="about_us" class="about-us-section">
    <div class="about-us-container">
        <div class="about-us-content">
            <h2 class="about-us-title">About Us</h2>
            <p class="about-us-text">
                At <strong class="about-us-text">Doctor Appointment System</strong>, we believe that healthcare should be accessible, efficient, and patient-centered. Our Doctor Appointment Management System is designed to streamline the appointment scheduling process, making it easier for patients to connect with their healthcare providers.
            </p>
            <p class="about-us-text">
                With a commitment to excellence, we provide top-tier medical services facilitated by a state-of-the-art online platform. Our system ensures that patients can book appointments, access medical records, and communicate with doctors all in one place.
            </p>
            <p class="about-us-text">
                Our dedicated team of professionals is here to offer you personalized care, backed by the latest in medical technology. Whether you're seeking routine check-ups, specialized consultations, or emergency services, we're here to ensure that your healthcare experience is as smooth and convenient as possible.
            </p>
            <p class="about-us-text">
                Join us in our mission to enhance the quality of healthcare by leveraging technology to meet your medical needs. Your health is our priority, and we're here to support you every step of the way.
            </p>
        </div>
    </div>
</section>

    <br>
    <br>
    <!--  ************************* Contact Us Starts Here ************************** -->
    <section id="contact_us" class="section contact-container">
    <div class="map">
        <iframe src="https://maps.google.com/maps?q=Pokhara%20Nepal&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen></iframe>
    </div>
    <div class="form-container">
    <h2>Contact Us</h2>
    <form id="contactForm" action="contact.php" method="POST" >
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Name" required>
        </div>
        <div class="form-group">
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="phone">Your Phone</label>
            <input type="tel" id="phone" name="phone" placeholder="Phone" required pattern="[0-9]{10}">
        </div>
        <div class="form-group">
            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="5" placeholder="Message" required></textarea>
        </div>
        <button type="submit">Send</button>
    </form>
</div>



   

    </div>
</section>

<br>
<br>
<br>
<br>
<br>



    <!-- ################# Footer Starts Here #######################--->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h5>Navigate</h5>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#about_us">About Us</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#contact_us">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h5>Services</h5>
                <ul>
                    <li><a href="#">Emergency Help</a></li>
                    <li><a href="#">Doctors</a></li>
                    <li><a href="#">Appointment</a></li>
                    <li><a href="#">Surgery</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h5>Contact</h5>
                <ul>
                    <li><a href="#">Kathmandu, Nepal</a></li>
                    <li><a href="#">Phone: +01 9876543210</a></li>
                    <li><a href="#">Email: info@hms.com</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h5>Stay Connected</h5>
                <ul>
    <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a></li>
    <li><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i> Twitter</a></li>
    <li><a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a></li>
    <li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
    <li><a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i> YouTube</a></li>
</ul>


        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Doctor Appointment Management System. All Rights Reserved.</p>
        </div>
    </footer>

</body>
<script src="assets/js/script.js"></script>
</html>
