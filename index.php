<?php include('settings.php');

?>
<?php
// You can define variables here if needed (for example, for dynamic titles or menus)
$title = "QuantumAxis Engineering";
?>
<!DOCTYPE html>
<?php include('header.inc'); ?>
<body>
</head>
<body>
    <?php include('nav.inc'); ?>

    <!-- Services Section -->
    <section id="services">
        <h2 class="index-h2">Our Services</h2>
        <p>We offer a range of engineering solutions including:</p>
        <ul>
            <li><i class="fas fa-shield-alt"></i> Cybersecurity Analyst</li>
            <li><i class="fas fa-robot"></i> Artificial Intelligence Engineering</li>
            <li><i class="fas fa-line"></i> Data Scientist</li>
        </ul>
    </section>

    <!-- About Section -->
 <!-- About Section -->
<section id="about">
    <h2 class="index-h2">About Us</h2>
    <div class="index-container">
        <div class="index-card index-commitment">
            <h2><i class="fas fa-handshake"></i> Our Commitment</h2>
            <p>QuantumAxis Engineering delivers innovative solutions with a team committed to excellence and customer satisfaction.</p>
        </div>
        <div class="index-card index-mission">
            <h2><i class="fas fa-bullseye"></i> Our Mission</h2>
            <p>Our mission is to innovate engineering solutions that empower businesses worldwide.</p>
        </div>
        <div class="index-card index-vision">
            <h2><i class="fas fa-eye"></i> Our Vision</h2>
            <p>We envision a future where technology and engineering create sustainable, smart environments.</p>
        </div>
    </div>
</section>


    <!-- Contact / Social Section -->
    <section id="socials">
        <h2 class="index-h2">Contact Information</h2>
        <div class="contact-map-wrapper">
            <nav class="contact-info">
                <h3><strong>QuantumAxis Engineering</strong></h3>
                <p><i class="fas fa-map-marker-alt"></i> 1st Floor, Block E, Level 2, Bandar Utama, No.2, 50480 Petaling Jaya, Selangor, Malaysia</p>
                <p><i class="fas fa-clock"></i> Mon - Fri: 9:00 AM - 6:00 PM</p>
                <p><i class="fas fa-phone"></i> 016-334 7378</p>
                <p><i class="fas fa-envelope"></i> quantumaxis212@gmail.com</p>
            </nav>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31870.689739193207!2d101.58995965955819!3d3.1379230493765613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4ecc065cadbd%3A0xab7aa02c2f4d2a7e!2sBandar%20Utama%2C%20Petaling%20Jaya%2C%20Selangor!5e0!3m2!1sen!2smy!4v1757596928945!5m2!1sen!2smy" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Connect Section -->
    <section id="contact">
        <h2 class="index-h2">Connect With Us</h2>
    
        <a href="https://maps.app.goo.gl/a1SAxyQLcRd1dVuU7" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> Our Location</a>
        <a href="mailto:quantumaxis212@gmail.com"><i class="fas fa-envelope"></i> Email Us</a>
        <a href="tel:+60163347378"><i class="fas fa-phone"></i> 016-334 7378</a>
    </section>

    <!-- Next Button -->
    <div class="next-button">
        <a href="jobs.php"><i class="fas fa-arrow-right"></i> Explore Our Job Opportunities</a>
    </div>

    <?php include('footer.inc'); ?>
</body>
</html>