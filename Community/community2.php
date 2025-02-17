<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Community</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <header>
        <div class="header-bar">
            <img src="pictures/Whiteicon.ico" alt="Eco Haven Logo" class="logo">
            <img src="pictures/Blackicon.ico" alt="Eco Haven Logo" class="logo2">
            <div class="login"><a href="login.html">Login</a></div>
        </div>
        <div class="header-bar2">
            <nav class="nav">
                <button class="nav-toggle" aria-label="Toggle navigation">☰</button>
                <div class="nav-links">
                    <a href="#home">Home</a>
                    <a href="#product-swap">Product Swap</a>
                    <a href="#recycling-programs">Recycling Programs</a>
                    <a href="#energy-tips">Energy Tips</a>
                    <a href="Community Garden.html">Community</a>
                </div>
            </nav>
        </div>
    </header>
    
    <main>
        <section class="community-section">
            <div class="your-community">
                <h2>YOUR COMMUNITY</h2>
                <div class="community-cards-container">
                    <div class="community-card">
                        <div class="card-header">
                            <img src="pictures/group2pic.jpg" class="G-img" alt="Garden Image 2">
                            <div class="card-content">
                                <h3>Welcome to the Family!!</h3>
                                <p>Looking to connect, share ideas, and grow alongside like-minded individuals? 
                                    Our group offers a space for collaboration, learning, and creativity. Whether 
                                    you're here to network, exchange knowledge, or simply meet new friends, this is 
                                    the perfect place to thrive together. Come be part of something meaningful! 🌟
                                </p>
                                <div class="group-owner">
                                    <img src="pictures/person2.jpg" alt="userImage 2">
                                    <p>James Carter</p>
                                </div>
                            </div>
                        </div>

                        <!-- Comments Section (Handled by PHP) -->
                        <div class="comment-section">
                            <?php include 'comments2.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="links">
                <a href="#">Home</a>
                <br><br><br>
                <a href="#">Terms & Conditions</a>
            </div>
            <div class="socials">
                <p>Social Media</p>
                <i class='bx bxl-facebook-circle'></i>
                <i class='bx bxl-instagram-alt'></i>
                <i class='bx bxs-envelope'></i>
                <br><br>
                <p class="Copyright">Copyright 2025</p>
            </div>
            <div class="services">
                <p>Services</p>
                <br>
                <p>+000-00000-000</p>
                <p>+03-33333-333</p>
            </div>
        </div>
    </footer>

    <script src="js/popup.js"></script>
</body>

</html>
