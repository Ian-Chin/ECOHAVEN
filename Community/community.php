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
                            <img src="https://media.istockphoto.com/id/157482648/photo/colorful-garden-landscape-and-grassy-lawn.jpg?s=612x612&w=0&k=20&c=aIGBhJzc6uNZw_0dukq8lZcwhfAvN5nT8WjWJwe0TJY="
                                alt="Community Image">
                            <div class="card-content">
                                <h3>Welcome to the Family!!</h3>
                                <p>Looking to connect, share ideas, and grow alongside like-minded individuals? Our
                                    group offers a space for collaboration,<br> learning, and creativity. Whether you're here to network, exchange
                                    knowledge, or simply meet new friends, this is the perfect<br> place to thrive together. Come be
                                    part of something meaningful! 🌟</p>
                                <div class="group-owner">
                                    <img src="pictures/person1.jpg" alt="userImage 1">
                                    <p>Sophia Miller</p>
                                </div>
                            </div>
                        </div>

                        <!-- Include the PHP file -->
                        <iframe src="comments.php" style="width:100%; height:300px; border:none;"></iframe>

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
                <p>Social Medias</p>
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
