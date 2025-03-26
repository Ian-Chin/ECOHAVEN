<?php
include 'conn.php';

// Get event_id from URL
$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;

// Fetch event details
$eventQuery = "SELECT * FROM recycle_event WHERE event_id = ?";
$stmt = mysqli_prepare($conn, $eventQuery);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    echo "<script>alert('Event not found!'); window.location.href='index.php';</script>";
    exit();
}

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Recycle Program</title>
    <link rel="stylesheet" href="join.css">
    <link rel="stylesheet" href="responsive.css">
</head>

<body>
    <!-- <header>
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
        </section> -->

    <div class="main_background">
        <div class="join_event_content">
        <h1 id="join_title">Join Recycle Event - <?php echo htmlspecialchars($event['title']); ?></h1>

            <div class="join_form">
            <!--Event id hidden-->
                <form id="join_event_form" action="join.php" method="POST">
                    <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event_id); ?>">
                    <table id="join_table">
                        <tr>
                            <th>Full Name:</th>
                            <td><input type="text" name="fname" required></td>
                        </tr>

                        <tr>
                            <th>Email Address:</th>
                            <td><input type="email" name="email" required></td>
                        </tr>

                        <tr>
                            <th>Phone Number:</th>
                            <td><input type="number" name="phone"  required></td>
                        </tr>

                        <tr>
                            <th>Age:</th>
                            <td><input type="number" name="age"  required></td>
                        </tr>

                        <tr>
                            <th>Address:</th>
                            <td><textarea rows="3" name="address" required></textarea></td>
                        </tr>

                        <tr>
                            <td colspan="2" id="join_buttons_td">
                                <div class="join_rs_class">
                                    <button type="reset" id="join_reset">Reset</button>
                                    <button type="submit" id="join_submit">Submit</button>
                                </div>
                            </td>
                        </tr>

                    </table>

                </form>
            </div>

            <!--Previous Page Button-->

            <div class="previuos_button_class">
                <a href="collection_schedules.php"><img id=previous_page_button src="RecyclingImages/back-button.ico" alt="Previous Button"></a>
            </div>
        </div>

    </div>

    <script src="button.js"></script>
    <script src="popup.js"></script>

</body>
</html>