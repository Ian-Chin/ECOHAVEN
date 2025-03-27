<?php
// Database connection
include 'dbh.inc.php';

// Check if id is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure id is an integer

    // Fetch the tip from the database
    $stmt = $conn->prepare("SELECT * FROM blogpost_tips WHERE post_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No tip found with that ID.";
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
    <title>Edit Conservation Tip</title>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>
    <div class="main_background">
        <div class="edit_tip_content">
            <h1 id="edit_tip_title">Edit Conservation Tip</h1>

            <div class="edit_form">
                <form id="edit_event_form" action="edit.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="tip">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['post_id']); ?>">    
                    <table id="edit_table">
                        <tr>
                            <th>Title:</th>
                            <td><input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required></td>
                        </tr>

                        <tr>
                            <th>Short Description:</th>
                            <td>
                                <textarea rows="3" name="short_description" required><?php echo htmlspecialchars($row['short_description']); ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <th>Content:</th>
                            <td>
                                <textarea rows="7" name="content" required><?php echo htmlspecialchars($row['content']); ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <th>Thumbnail:</th>
                            <td>
                                <input type="file" name="thumbnail" accept="image/*">
                                <?php if (!empty($row['thumbnail_url'])): ?>
                                    <p>Current: <?php echo htmlspecialchars($row['thumbnail_url']); ?></p>
                                <?php endif; ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" id="tips_buttons_td">
                                <div class="tips_buttons_td_class">
                                    <button type="reset" id="edit_tips_reset">Reset</button>
                                    <button type="submit" id="edit_tips_submit">Submit</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <!-- Previous Page Button -->
            <div class="previuos_button_class">
                <a href="adminpage.php">
                    <img id="previous_page_button" src="RecyclingImages/back-button.ico" alt="Previous Button">
                </a>
            </div>
        </div>
    </div>

    <script src="js/popup.js"></script>
</body>
</html>