<?php
// --- DATABASE CONNECTION ---
// !! IMPORTANT: Replace with your actual database credentials !!
$servername = "localhost";
$username = "root"; // Your phpMyAdmin username (use a less privileged user in production!)
$password = ""; // Your phpMyAdmin password (or empty if none)
$dbname = "ecohaven"; // The database containing 'blogpost_tips'

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // In production, log error instead of dying publicly
    // error_log("Database Connection Failed: " . $conn->connect_error);
    die("Connection failed. Please try again later."); // User-friendly message
}
$conn->set_charset("utf8mb4"); // Good practice

// --- GET POST ID ---
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// --- AJAX LIKE HANDLING ---
// Place this *before* fetching main post data if postId is needed, or handle postId inside
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'like') {
    header('Content-Type: application/json'); // Set content type for JSON response

    $ajax_post_id = isset($_POST['postId']) ? intval($_POST['postId']) : 0;

    if ($ajax_post_id > 0) {
        // Simple increment - relies on client-side localStorage to prevent multiple clicks
        $update_sql = "UPDATE blogpost_tips SET like_count = like_count + 1 WHERE id = ?";
        $stmt = $conn->prepare($update_sql);

        if ($stmt) {
            $stmt->bind_param("i", $ajax_post_id);
            if ($stmt->execute()) {
                // Fetch the new like count to potentially send back (optional)
                // $new_count_sql = "SELECT like_count FROM blogpost_tips WHERE id = ?";
                // ... fetch and add to JSON ...
                echo json_encode(['success' => true, 'message' => 'Like recorded!']);
            } else {
                 // error_log("Like update failed: " . $stmt->error);
                echo json_encode(['success' => false, 'message' => 'Failed to record like.']);
            }
            $stmt->close();
        } else {
            // error_log("Like prepare failed: " . $conn->error);
            echo json_encode(['success' => false, 'message' => 'Database error preparing like.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid Post ID for like.']);
    }
    $conn->close(); // Close connection after AJAX handling
    exit(); // Stop script execution after AJAX response
}


// --- FETCH POST DETAILS (if not an AJAX like request) ---
if ($post_id <= 0) {
    // Redirect if ID is invalid or missing for page view
    header("Location: index.html"); // Redirect to homepage or blog list
    exit();
}

// Fetch post details using the correct table and columns
$sql = "SELECT id, title, content, created_at, like_count, short_description
        FROM blogpost_tips
        WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    // error_log("Prepare failed: " . $conn->error);
    die("Error fetching post details.");
}

$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Post not found, redirect
    header("Location: index.html"); // Redirect to homepage or blog list
    exit();
}

$post = $result->fetch_assoc();
$stmt->close();

// Format date from UNIX timestamp (INT)
// Check if created_at is not null or 0 before formatting
$published_date = ($post['created_at'] > 0) ? date("d/m/y", $post['created_at']) : "N/A";

// --- RELATED ARTICLES (Simplified - Fetch 2 other posts, excluding current) ---
$related_posts = [];
$related_sql = "SELECT id, title, short_description
               FROM blogpost_tips
               WHERE id != ?
               ORDER BY created_at DESC
               LIMIT 2"; // Fetch 2 other latest posts
$related_stmt = $conn->prepare($related_sql);

if ($related_stmt) {
    $related_stmt->bind_param("i", $post_id);
    $related_stmt->execute();
    $related_result = $related_stmt->get_result();
    while ($related = $related_result->fetch_assoc()) {
        $related_posts[] = $related;
    }
    $related_stmt->close();
}

$conn->close(); // Close connection after all data is fetched

// --- START HTML OUTPUT ---
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Eco Haven</title>
    <!-- Make sure paths to CSS are correct -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <!-- Add Font Awesome if needed for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($post['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($post['short_description']); // Use short_description ?>">
    <!-- og:image removed as thumbnail doesn't exist in this schema -->
    <!-- Add og:url and og:type for better sharing -->
    <meta property="og:url" content="<?php echo "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:type" content="article">
</head>
<body>
    <!-- Reading Progress Bar -->
    <div id="reading-progress"></div>

    <!-- Header Navigation -->
    <?php // include('includes/header.php'); // Assuming you have a standard header include ?>
    <!-- Placeholder Header Structure -->
    <header>
      <div class="header-bar">
        <img src="Whiteicon.ico" alt="Eco Haven Logo" class="logo">
        <img src="Blackicon.ico" alt="Eco Haven Logo" class="logo2">
        <div class="login"><a href="login.html">Login</a></div>
      </div>
      <div class="header-bar2">
        <nav class="nav">
          <button class="nav-toggle" aria-label="Toggle navigation">☰</button>
          <div class="nav-links">
            <a href="Mainmenu.html">Home</a>
            <a href="product-swap.html">Product Swap</a>
            <a href="#recycling-programs">Recycling Programs</a>
            <div class="dropdown">
              <a href="index.html" class="dropbtn">Energy Tips</a>
              <div class="dropdown-content">
                <a href="Blogpost.html">Articles</a>
                <a href="request_post.html">Submit a Post</a>
              </div>
            </div>
            <a href="Community Garden.html">Community</a>
          </div>
        </nav>
      </div>
    </header>

    <!-- Main Content Area -->
    <main class="content main-content-area">
        <section class="blog-post">

            <div class="post-meta-header">
                <div class="reading-time">
                  <i class="fas fa-clock"></i> 
                  <span class="read-time">Calculating...</span> <!-- JS will fill this -->
                </div>
                <!-- Social Sharing Buttons (structure matching JS) -->
                <div class="share-buttons">
                    <button aria-label="Share on Facebook" class="share-btn facebook js-share-facebook"></button>
                    <button aria-label="Share on X" class="share-btn x js-share-x"></button>
                    <button aria-label="Share on LinkedIn" class="share-btn linkedin js-share-linkedin"></button>
                    <button aria-label="Share via Email" class="share-btn email js-share-email"></button>
                    <button aria-label="Share on WhatsApp" class="share-btn whatsapp js-share-whatsapp"></button>
                    <button aria-label="Share on Instagram" class="share-btn instagram js-share-instagram"></button>
                </div>
            </div>

            <h1 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
            <hr>

            <!-- Featured Image Removed - No thumbnail column -->

            <div class="post-meta">
                <!-- Author hardcoded as no author info in blogpost_tips table -->
                <p class="banner-meta">By EcoHaven Admin Team | Published on <?php echo $published_date; ?></p>
            </div>

            <div class="post-content">
                <?php echo nl2br(htmlspecialchars($post['content'])); // Basic display: Convert newlines, escape HTML ?>
                <?php // OR echo $post['content']; // If content is trusted HTML from an admin editor ?>
            </div>
            <hr>

            <div class="like-buttons">
                <button id="likeBtn" class="like-button">Like</button>
                <span id="likeCount" class="like-counter"><?php echo $post['like_count']; // Display initial count ?></span>
                <!-- Dislike button removed -->
            </div>

            <!-- Related Articles -->
            <?php if (!empty($related_posts)): ?>
            <section class="related-articles">
                <h2>Related Articles</h2>
                <div class="related-grid">
                    <?php foreach ($related_posts as $related): ?>
                    <article class="related-card">
                        <!-- No thumbnail image available -->
                        <h3><?php echo htmlspecialchars($related['title']); ?></h3>
                        <p><?php echo htmlspecialchars($related['short_description']); ?></p>
                         <!-- Link requires ?id= parameter -->
                        <a href="blogposts.php?id=<?php echo $related['id']; ?>">Read More</a>
                    </article>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>

            <p style="margin-top: 2rem;">
                <a href="Blogpost.html" class="back-button"> <!-- Link back to the list page -->
                  ← Back to Articles
                </a>
            </p>
        </section>
    </main>

    <!-- Footer -->
    <?php // include('includes/footer.php'); // Assuming standard footer ?>
    <!-- Placeholder Footer Structure -->
    <footer>
      <div class="footer-content">
        <div class="links">
          <a href="#">Home</a><br><br><br>
          <a href="#">Terms & Conditions</a>
        </div>
        <div class="socials">
          <p>Social Medias</p>
          <img src="facebookicon.ico" alt="facebook pic">
          <img src="instaicon.ico" alt="insta pic">
          <img src="mail.ico" alt="email pic"><br><br>
          <p class="Copyright">2025 Eco Haven. All Rights Reserved.</p>
        </div>
        <div class="services">
          <p>Services</p><br>
          <p>+000-00000-000</p>
          <p>+03-33333-333</p>
        </div>
      </div>
    </footer>

    <!-- Link to the JS file (ensure path is correct) -->
    <script src="blogposts.js" defer></script>
</body>
</html>