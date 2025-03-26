<?php
// edit.php

// Database connection
include 'conn.php';

// Check if id is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure id is an integer

    // Fetch the record from the database using event_id
    $stmt = $conn->prepare("SELECT * FROM recycle_event WHERE event_id = ?");
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
    <title>Edit Recycle Event</title>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>

    <div class="main_background">
        <div class="edit_event_content">
            <h1 id="edit_title">Edit Recycle Event</h1>

            <div class="edit_form">
                <!-- The form posts to edit_recycle_event.php for processing the update -->
                <form id="edit_event_form" action="edit.php" method="POST" enctype="multipart/form-data">
                    <!-- Single hidden field for the event ID -->
                    <input type="hidden" name="type" value="recycle_event">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['event_id']); ?>">    
                    <table id="edit_table">
                        <tr>
                            <th>Date of Event:</th>
                            <td><input type="date" name="date" value="<?php echo htmlspecialchars($row['date']); ?>" required></td>
                        </tr>

                        <tr>
                            <th>Name:</th>
                            <td><input type="text" name="name" placeholder="Sophia Elizabeth" value="<?php echo htmlspecialchars($row['name']); ?>" required></td>
                        </tr>

                        <tr>
                            <th>Title:</th>
                            <td><input type="text" name="title" placeholder="Recycle Program" value="<?php echo htmlspecialchars($row['title']); ?>" required></td>
                        </tr>

                        <tr>
                            <th>Description:</th>
                            <td>
                                <textarea rows="7" name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" id="buttons_td">
                                <div class="buttons_td_class">
                                    <button type="reset" id="edit_reset">Reset</button>
                                    <button type="submit" id="edit_submit">Submit</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <!-- Previous Page Button -->
        <div class="previuos_button_class">
            <a href="adminpage.php">
                <img id="previous_page_button" src="RecyclingImages/back-button.ico" alt="Previous Button">
            </a>
        </div>
    </div>
    </div>
</main>

<script src="button.js"></script>
<script src="popup.js"></script>

</body>
</html>
