<?php

// Database connection
include 'conn.php';

// Check if id is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure id is an integer

    // Fetch the record from the database using event_id
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
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
    <title>Edit Product Swap</title>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="responsive.css">
</head>
<body>

    <div class="main_background">
        <div class="edit_product_content">
            <h1 id="edit_products_title">Edit Product Swap</h1>

            <div class="edit_products_form">
                <!-- The form posts to edit_recycle_event.php for processing the update -->
                <form id="edit_products_form" action="edit.php" method="POST" enctype="multipart/form-data">
                    <!-- Single hidden field for the event ID -->
                    <input type="hidden" name="type" value="product">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <table id="edit_products_table">
                        <tr>
                            <th>Full Name:</th>
                            <td><input type="text" name="full_name" value="<?php echo htmlspecialchars($row['full_name']); ?>" required></td>
                        </tr>

                        <tr>
                            <th>Product Name:</th>
                            <td><input type="text" name="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>" required></td>
                        </tr>

                        <tr>
                            <th>Category:</th>
                            <td><input type="text" name="category" value="<?php echo htmlspecialchars($row['category']); ?>" required></td>
                        </tr>

                        <tr>
                            <th>Product Condition:</th>
                            <td><input type="text" name="product_condition" value="<?php echo htmlspecialchars($row['product_condition']); ?>" required></td>
                        </tr>

                        <tr>
                            <th>Location:</th>
                            <td><input type="text" name="location" value="<?php echo htmlspecialchars($row['location']); ?>" required></td>
                        </tr>

                        <tr>
                            <td colspan="2" id="products_buttons_td">
                                <div class="products_buttons_td_class">
                                    <button type="reset" id="edit_products_reset">Reset</button>
                                    <button type="submit" id="edit_products_submit">Submit</button>
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
</main>

<script src="button.js"></script>
<script src="popup.js"></script>

</body>
</html>
