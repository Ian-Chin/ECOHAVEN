<?php

//Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecohaven";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if($conn->connect_error){
    die("Connection failed: " .$conn->connect_error);
}

// Use to hide the event which has passed
// Get today's date in 'YYYY-MM-DD' format
$today = date('Y-m-d');

// SQL query to select events where the event date is today or in the future
$sql = "SELECT * FROM recycle_event WHERE date >= '$today'";
$result = $conn->query($sql); // Execute the query and store the result

// Check if there are any upcoming events (true if there are, false if none)
$hasUpcomingEvent = mysqli_num_rows($result) > 0;

mysqli_close($conn);
?>

<!--HTML-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Schedules</title>
    <link rel="stylesheet" href="collection_schedules.css">
    <link rel="stylesheet" href="responsive.css">
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
                    <a href="product-swap.html">Product Swap</a>
                    <a href="#recycling-programs">Recycling Programs</a>
                    <a href="#energy-tips">Energy Tips</a>
                    <a href="Community Garden.html">Community</a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <section class="banner">
            <h1>Recycle</h1>
            <p>Let's make our planet green!</p>
            <img src="RecyclingImages/theme-background.jpeg" alt="Recycle Background" class="bg">
        </section>

        <!--Recycle Program Button-->

        <div class="main_background">

            <nav class="menu">
                <a href="recycle.html" id="LRP" class="menu-button">Recycle Program</a>
            </nav>
    
            <!--Collection Schedules-->

            <div class="CS_class">
                <h1 id="CS_title">Collection Schedules
                    <img id=calendar_image src="RecyclingImages/calendar.ico" alt="Calendar Image">
                </h1>
            </div>
                
            <div class="section">
                <h1 id="EH_table_des">Our company Eco-Haven have provide some recycling program based on the schedule below:</h1>
            </div>
    
            <div class="all_EH_table_class section">
                <table id="EH_table">
                    <tr>
                        <th id="area">Area</th>
                        <th id="mon">Mon</th>
                        <th id="tue">Tue</th>
                        <th id="wed">Wed</th>
                        <th id="thu">Thu</th>
                        <th id="fri">Fri</th>
                        <th id="sat">Sat</th>
                        <th id="sun">Sun</th>
                    </tr>
                    
                    <tr>
                        <td id="johor">Johor</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                    </tr>
    
                    <tr>
                        <td id="kedah">Kedah</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                    </tr>
    
                    <tr>
                        <td id="kelantan">Kelantan</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                    </tr>
    
                    <tr>
                        <td id="malacca">Malacca</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                    </tr>
    
                    <tr>
                        <td id="ns">Negeri Sembilan</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                    </tr>
    
                    <tr>
                        <td id="pahang">Pahang</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                    </tr>
    
                    <tr>
                        <td id="penang">Penang</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                    </tr>
    
                    <tr>
                        <td id="perak">Perak</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                    </tr>
    
                    <tr>
                        <td id="perlis">Perlis</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                    </tr>
    
                    <tr>
                        <td id="sabah">Sabah</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                    </tr>
    
                    <tr>
                        <td id="sarawak">Sarawak</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                    </tr>
    
                    <tr>
                        <td id="selangor">Selangor</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                        <td id="pls">Pls</td>
                    </tr>
    
                    <tr>
                        <td id="terengganu">Terengganu</td>
                        <td id="pls">Pls</td>
                        <td id="alu">Alu</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="all">ALL</td>
                        <td id="pp">Pp</td>
                        <td id="gls">Gls</td>
                    </tr>
                </table>
            </div>

            <!--Shortcut-->

            <div class="shortcut">
                <ul>
                    <li>Pp - Paper</li>
                    <li>Gls - Glass</li>
                    <li>Alu - Aluminium</li>
                    <li>Pls - Plastic</li>
                </ul>
            </div>

            <!--Notice-->
    
            <div class="notice_class">
                <h1 id="notice_title">Notice:</h1>
                <ul>
                    <li id="notice_one">Put the rubbish at garbage center that near to your area.</li>
                </ul>
            </div>
    
            <!--Participate-->
            <!--Important of Recycle-->
            
            <div class="imp_recycle">
                <h1 id="imp_recycle_title">Importants of Recycle
                    <img id=imp_image src="RecyclingImages/important-icon.ico" alt="exclamation mark">
                </h1>
            </div>
    
            <div class="greenhouse_class">
                <img id=greenhouse_image src="RecyclingImages/greenhouse-effect.jpg" alt="Greenhouse Gas Emissions Image">
                <div>
                    <h2 id="greenhouse_title">Decreases Greenhouse Gas Emissions</h2>
                    <p id="greenhouse_p">By reducing the need for raw material extraction and processing, recycling helps reduce the emissions of greenhouse gases, which contribute to global warming and climate change.</p>
                </div>
            </div>
    
            <div class="community_class">
                <img id=community_image src="RecyclingImages/community-health.jpg" alt="Community Image">
                <div>
                    <h2 id="community_title">Improves Community Health</h2>
                    <p id="community_p">Proper waste management and recycling reduce exposure to harmful chemicals in the environment, such as heavy metals from e-waste or plastics, which can harm both the ecosystem and human health.</p>
                </div>
            </div>
    
            <div class="economy_class">
                <img id=economy_image src="RecyclingImages/economy.avif" alt="Economy Image">
                <div>
                    <h2 id="economy_title">Supports the Economy</h2>
                    <p id="economy_p">Recycling creates jobs in various sectors, including collection, sorting, processing, and selling of recycled materials. This contributes to the circular economy, where materials are reused and value is retained.</p>
                </div>
            </div>
    
            <!--Join Community-->
    
            <div class="join_community">
                <h1 id="join_community_title">Join Recycle Program</h1>

                <!-- Check if there is any upcoming events-->
                <?php if ($hasUpcomingEvent): ?>
                    <!-- Loop through each upcoming event and display its details -->
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="join_recycle_card">
                            <div class="join_recycle_content">
                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>

                                <div class="join_event_date">
                                    <p>Event Date: <?php echo htmlspecialchars($row['date']); ?></p>
                                </div>

                                <div class="join_recycle_owner">
                                    <p>By: <?php echo htmlspecialchars($row['name']); ?></p>
                                </div>

                                <div class="join_button_class">
                                    <a href="join.html" id="join_button">Join</a>
                                </div>
                            </div>
                            <img id="card_image" src="uploadImage/<?php echo htmlspecialchars($row['image']); ?>" alt="Event Image">
                        </div>
                    <?php endwhile; ?>
                    <!-- If there are no upcoming events, show this message -->
                <?php else: ?>
                    <p id="no_event">No upcoming events at the moment.</p>
                <?php endif; ?>
            </div>

            
            <!--Previous Page Button-->

            <div class="previuos_button_class">
                <a href="recycle.html"><img id=previous_page_button src="RecyclingImages/back-button.ico" alt="Previous Page Button"></a>
            </div>

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

        </div>
    
        <script src="popup.js"></script>

</body>
</html>