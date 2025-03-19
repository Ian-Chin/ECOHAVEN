<?php 
// edit.php

// Database connection
include 'conn.php';

// Check if id is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure id is an integer

    // Fetch the record from the database using join_id (since that is the primary key)
    $stmt = $conn->prepare("SELECT * FROM join_event WHERE join_id = ?");
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
    <title>Edit User Join Recycle Event</title>
    <link rel="stylesheet" href="edit_join.css">
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

    <div class="main_background">
        <h1 id="edit_join_title">Edit Join Recycle Event</h1>

        <div class="edit_join_form">
            <form id="edit_join_event_form" action="edit.php" method="POST">
            <!-- Single hidden field for the event ID -->
            <input type="hidden" name="type" value="join_event">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['join_id']); ?>">
                <table id="edit_join_table">
                    <tr>
                        <th>Full Name:</th>
                        <td><input type="text" name="fname" value="<?php echo htmlspecialchars($row['name']); ?>" required></td>
                    </tr>

                    <tr>
                        <th>Email Address:</th>
                        <td><input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required></td>
                    </tr>

                    <tr>
                        <th>Phone Number:</th>
                        <td><input type="number" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required></td>
                    </tr>

                    <tr>
                        <th>Age:</th>
                        <td><input type="number" name="age" value="<?php echo htmlspecialchars($row['age']); ?>" required></td>
                    </tr>

                    <tr>
                        <th>Address:</th>
                        <td>
                            <textarea rows="3" name="address" required><?php echo htmlspecialchars($row['address']); ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" id="edit_join_buttons_td">
                            <div class="edit_join_rs_class">
                                <button type="reset" id="edit_join_reset">Reset</button>
                                <button type="submit" id="edit_join_submit">Submit</button>
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
