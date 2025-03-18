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
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <div class="header-bar">
        <img src="pictures/Whiteicon.ico" alt="Eco Haven Logo" class="logo">
        <img src="pictures/Blackicon.ico" alt="Eco Haven Logo" class="logo2">
    </div>
    <div class="header-bar2">
        <nav class="nav">
            <button class="nav-toggle" aria-label="Toggle navigation">☰</button>
            <div class="nav-links">
                <a href="Mainmenu.php">Home</a>
                <a href="#product-swap">Product Swap</a>
                <a href="#recycling-programs">Recycling Programs</a>
                <a href="#energy-tips">Energy Tips</a>
                <a href="Community Garden.html">Community</a>
            </div>
        </nav>
    </div>
    <div class="background">
        <video autoplay muted loop id="myVideo">
            <source src="pictures/green-leaves.1920x1080.mp4" type="video/mp4">
        </video>
    </div>

    <div class="content-container">
        <div class="welcome-section">
            <h1><span>Welcome to EcoHaven</span></h1>
            <p>Your trusted platform for sustainable living and eco-friendly solutions.</p>
        </div>
        <div class="divider"></div>
        <div class="wrapper">
        <?php
            echo "<form method='POST' action='".getLogin($conn)."'>
                <h1>LOGIN</h1>
                <div class='input-box'>
                    <input type='text' name='uid' placeholder='Username or Email' required>
                    <img src='pictures/user.ico'>
                </div>
                <div class='input-box'>
                    <input type='password' name='pwd' placeholder='Password' required>
                    <img src='pictures/lock.ico'>
                </div>
                <div class='remember-forgot'>
                    <label>
                        <input type='checkbox'> Remember me
                    </label>
                    <a href='#'>Forgot Password?</a>
                </div>
                
                <button type='submit' name='loginSubmit' class='btn'>Login</button>";
        ?>
                <div class='register-link'>
                    <p>Dont have an account? <a href='signup.php'>Register</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src='js/popup.js'></script>
</body>

</html>
