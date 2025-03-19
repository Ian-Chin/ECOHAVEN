

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Swap</title>
    <link rel="stylesheet" href="edit_products.css">
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
        <h1>Product Swap</h1>
        <p>This platform connects community members to exchange eco friendly items.<br>Exchange your eco-friendly products here!
        </p>
        <img src="RecyclingImages/theme-background.jpeg" alt="Recycle Background" class="bg">
    </section>

    <div class="main_background">
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
