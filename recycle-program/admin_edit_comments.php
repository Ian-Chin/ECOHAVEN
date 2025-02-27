<?php

// Database connection
include 'conn.php';

// Check if id is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure id is an integer

    // Fetch the record from the database using event_id
    $stmt = $conn->prepare("SELECT * FROM comments WHERE cid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found with that ID.";
        exit;
    }
    $stmt->close();
} else {
    echo "No ID specified.";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comments</title>
    <link rel="stylesheet" href="edit_comments.css">
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
        <h1>Community Garden</h1>
        <p>Join our community to grow plants, share tips, and connect with fellow gardeners.<br>Let's grow together!
        </p>
        <img src="RecyclingImages/theme-background.jpeg" alt="Recycle Background" class="bg">
    </section>

    <div class="main_background">
        <h1 id="edit_comments_title">Edit Comments</h1>

        <div class="edit_comments_form">
            <!-- The form posts to edit_recycle_event.php for processing the update -->
            <form id="edit_comments_form" action="edit_comments.php" method="POST" enctype="multipart/form-data">
                <!-- Single hidden field for the event ID -->
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['cid']); ?>">    
                <table id="edit_comments_table">
                    <tr>
                        <th>Date:</th>
                        <td><input type="date" name="date" value="<?php echo htmlspecialchars($row['date']); ?>" required></td>
                    </tr>

                    <tr>
                        <th>Message:</th>
                        <td>
                            <textarea rows="3" name="message" required><?php echo htmlspecialchars($row['message']); ?></textarea>
                        </td>
                    </tr>
                   
                    <tr>
                        <td colspan="2" id="comments_buttons_td">
                            <div class="comments_buttons_td_class">
                                <button type="reset" id="edit_comments_reset">Reset</button>
                                <button type="submit" id="edit_comments_submit">Submit</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <!-- Previous Page Button -->
        <div class="previuos_button_class">
            <a href="recycle_admin_main.php">
                <img id="previous_page_button" src="RecyclingImages/back-button.ico" alt="Previous Button">
            </a>
        </div>

    </div>
</main>

<script src="button.js"></script>
<script src="popup.js"></script>

</body>
</html>
