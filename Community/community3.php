<?php
    session_start();
    date_default_timezone_set('Asia/Kuala_Lumpur');
    include 'dbh.inc.php';
    include 'commentsection.php';
    include 'functions.php';
?>


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
                    <a href="MainMenu.php">Home</a>
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
                            <img src="pictures/group3pic.jpg" alt="Community Image">
                            <div class="card-content">
                                <h3>Welcome to The Change Makers!</h3>
                                <p>You’ve just joined a community of passionate individuals committed to making a real difference. Whether it’s through innovation, activism, or everyday choices, we’re here to support and inspire each other. Let’s create a better future together! 🌍✨</p>
                                <div class="group-owner">
                                    <p>Group Owner: Sophia Miller</p>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <?php
                        if (isset($_SESSION['userID'])) {
                            echo "<form method='POST' action='".setComments3($conn)."' class='comment-section'>
                            <input type='hidden' name='uid' value='Anonymous'>
                            <input type='hidden' name='date' value='".date('Y-m-d H:i:s ')."'>
                            <textarea name='message' id='comment-input' placeholder='Write your comment here...'></textarea>
                            <button type='submit' name='commentSubmit' id='post-comment'>Post Comment</button>
                            </form>";
                        } else {
                            echo "You need to be logged in to post a comment.
                            <br><br>";
                        }
                        
                        getComments3($conn);
                        ?>
                    </div>
                </div>
            </div>

            </div>

        </section>
    </main>
    <footer>
        <div class="footer-content">
            <div class="links">
                <a href="Mainmenu.html">Home</a>
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
