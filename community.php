<?php
    date_default_timezone_set('Asia/Kuala_Lumpur');
    include 'dbh.inc.php';
    include 'commentsection.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Community</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <header>
        <div class="header-bar">
            <img src="css/pictures/Whiteicon.ico" alt="Eco Haven Logo" class="logo">
            <img src="css/pictures/Blackicon.ico" alt="Eco Haven Logo" class="logo2">
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
                                    group offers a
                                    space for collaboration,<br> learning, and creativity. Whether you're here to
                                    network, exchange
                                    knowledge, or simply meet new friends, this is the perfect<br> place to thrive
                                    together. Come be
                                    part of something meaningful! 🌟</p>
                                <div class="group-owner">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cmFuZG9tJTIwcGVyc29ufGVufDB8fDB8fHww"
                                        alt="userImage 2">
                                    <p>Sophia Miller</p>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        echo "<form method='POST' action='".setComments($conn)."' class='comment-section'>
                            <input type='hidden' name='uid' value='Anonymous'>
                            <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
                            <textarea name='message' id='comment-input' placeholder='Write your comment here...'></textarea>
                            <button type='submit' name='commentSubmit' id='post-comment'>Post Comment</button>
                        </form>";

                        getComments($conn);
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
</body>

</html>