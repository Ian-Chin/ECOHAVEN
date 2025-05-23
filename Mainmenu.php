<?php
session_start();
include 'functions.php';
include 'dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌱 ECOHAVEN</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <header>
        <div class="header-bar">
            <img src="pictures/Whiteicon.ico" alt="Eco Haven Logo" class="logo">
            <img src="pictures/Blackicon.ico" alt="Eco Haven Logo" class="logo2">
            <div class="login">
            <?php
               displayLogin();
            ?>
            </div>

        </div>
        <div class="header-bar2">
            <nav class="nav">
                <button class="nav-toggle" aria-label="Toggle navigation">☰</button>
                <div class="nav-links"> 
                    <a href="Mainmenu.php">Home</a>
                    <a href="product-swap.html">Product Swap</a>
                    <a href="recycle.html">Recycling Programs</a>
                    <a href="#energy-tips">Energy Tips</a>
                    <a href="Community Garden.html">Community</a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <section class="main-banner">
            <h1>ECOHAVEN</h1>
            <p>💚🌱Building a Greener Future, One Sustainable Choice at a Time!"🌱💚</p>
            <button class="explore">EXPLORE</button>
            <img src="pictures/mainmenu.gif" alt="Community Garden Background" class="bg">
        </section>
        <section class="main-content">
            <br><br><br><br><br><br>
            <div class="main-container">
                <h1>EXPLORE NOW</h1>
                <br><br><br>
                <div class="destinations">
                    <div class="destination-card">
                        <img src="pictures/productswap.png" alt="tab 1">
                        <div class="destination-content">
                            <h3>Product Swap</h3>
                            <p>Experience the city of love with its iconic landmarks and romantic atmosphere.</p>
                            <a href="product-swap.html" class="go-now-btn">Go Now</a>
                        </div>
                    </div>

                    <div class="destination-card">
                        <img src="pictures/recyclingprogram.png" alt="tab 2">
                        <div class="destination-content">
                            <h3>Recycling Programs</h3>
                            <p>Discover tropical paradise with beautiful beaches and rich culture.</p>
                            <a href="#" class="go-now-btn">Go Now</a>
                        </div>
                    </div>

                    <div class="destination-card">
                        <img src="pictures/energytips.png" alt="tab 3">
                        <div class="destination-content">
                            <h3>Energy Tips</h3>
                            <p>Explore the city that never sleeps with its vibrant energy and diversity.</p>
                            <a href="#" class="go-now-btn">Go Now</a>
                        </div>
                    </div>

                    <div class="destination-card">
                        <img src="pictures/Communitygarden.png" alt="tab 4">
                        <div class="destination-content">
                            <h3>Community Garden</h3>
                            <p>Experience the perfect blend of tradition and modern technology.</p>
                            <a href="Community Garden.html" class="go-now-btn">Go Now</a>
                        </div>
                    </div>
                </div>
                <div class="achievements-section">
                    <h1>OUR IMPACT</h1>
                    <div class="achievements-grid">
                        <div class="achievement-card">
                            <h3>5000+</h3>
                            <p>Active Community Members</p>
                        </div>
                        <div class="achievement-card">
                            <h3>100+</h3>
                            <p>Local Gardens Created</p>
                        </div>
                        <div class="achievement-card">
                            <h3>2000+</h3>
                            <p>Products Swapped</p>
                        </div>
                        <div class="achievement-card">
                            <h3>50%</h3>
                            <p>Average Energy Savings</p>
                        </div>
                    </div>
                </div>
                <br><br><br><br>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7098.921806881355!2d101.69963660579452!3d3.0585021367893654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4abb795025d9%3A0x1c37182a714ba968!2sAsia%20Pacific%20University%20of%20Technology%20%26%20Innovation%20(APU)!5e0!3m2!1sen!2smy!4v1739807779893!5m2!1sen!2smy"
                    width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="about-container">
                    <div class="about-us">
                        <br><br>
                        <h1>ABOUT US</h1>
                        <br><br>
                        <p>ECOHAVEN is a web application dedicated to promoting sustainable living through education,
                            engagement, and community action. We provide resources on local recycling programs, energy
                            conservation, community gardening, and eco-friendly product swaps to help individuals adopt
                            greener habits.</p>
                    </div>
                </div>
                <br><br><br><br>
                <h1>MEET THE TEAM</h1>
                <div class="reviews-container">
                    <div class="review-card">
                        <img src="pictures/Bowie.png" alt="Reviewer 1" class="review-image">
                        <h4>Bowie Chong Yu Shin<br>TP076486</h4>
                        <p>"ECOHAVEN has made sustainable living so much easier! I’ve learned how to recycle properly,
                            cut down on energy waste, and even joined a local gardening project. The eco-friendly
                            product swap is a great way to find and share sustainable items. I love how this platform
                            brings the community together for a greener future!"</p>
                    </div>

                    <div class="review-card">
                        <img src="pictures/ZhiLin.png" alt="Reviewer 2" class="review-image">
                        <h4>Cheang Zhi Lin<br>TP077477</h4>
                        <p>"This website is a fantastic resource! The energy-saving tips helped me lower my electricity
                            bill, and the community gardening section connected me with other local gardeners. It’s
                            user-friendly, informative, and a great way to get involved in eco-friendly living!"
                        </p>
                    </div>

                    <div class="review-card">
                        <img src="pictures/Ian.png" alt="Reviewer 3" class="review-image">
                        <h4>Ian Chin Jun Sheng<br>TP076218</h4>
                        <p>"ECOHAVEN is the perfect place to start living more sustainably! From recycling info to
                            product swaps, it offers so many helpful tools. I’ve met like-minded people and found easy
                            ways to reduce waste. Highly recommend!"</p>
                    </div>

                    <div class="review-card">
                        <img src="pictures/Ritchie.png" alt="Reviewer 3" class="review-image">
                        <h4>Ritchie Boon Win Yew<br>TP076487</h4>
                        <p>"ECOHAVEN is an incredible platform for anyone wanting to live more sustainably. The
                            recycling guides are super helpful, and the product swap feature has helped me reduce waste
                            while finding great eco-friendly items. It’s a great way to connect with like-minded people
                            and make a real impact!"</p>
                    </div>
                </div>
            </div>
            <br><br><br><br><br>
            <div class="newsletter-section">
                <div class="newsletter-content">
                    <h2>Stay Green, Stay Informed</h2>
                    <p>Subscribe to our newsletter for the latest eco-friendly tips, community updates, and exclusive
                        sustainable living guides.</p>
                    <div class="newsletter-form">
                        <input type="email" placeholder="Enter your email address">
                        <button type="submit">Subscribe</button>
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
                <img src="pictures/facebookicon.ico" alt="facebook pic">
                <img src="pictures/instaicon.ico" alt="insta pic">
                <img src="pictures/mail.ico" alt="email pic">
                <br><br>
                <p class="Copyright">2025 Eco Haven. All Rights Reserved.</p>
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
