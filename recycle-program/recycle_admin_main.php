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

//Fetch recycle_admin_main create event data
$sql1 = "SELECT * FROM recycle_event";
$result1 = $conn->query($sql1);

//Fetch join_event data
$sql2 = "SELECT * FROM join_event";
$result2 = $conn->query($sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Admin</title>
    <link rel="stylesheet" href="recycle_admin.css">
    <link rel="stylesheer" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="header-bar">
            <img src="Whiteicon.ico" alt="Eco Haven Logo" class="logo">
            <img src="Blackicon.ico" alt="Eco Haven Logo" class="logo2">
            <div class="login"><a href="index.html">Login</a></div>

        </div>
        <div class="header-bar2">
            <nav class="nav">
                <button class="nav-toggle" aria-label="Toggle navigation">☰</button>
                <div class="nav-links">
                    <a href="#home">Home</a>
                    <a href="#product-swap">Product Swap</a>
                    <a href="#recycling-programs">Recycling Programs</a>
                    <a href="#energy-tips">Energy Tips</a>
                    <a href="Community Garden.html">Community</a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <section class="banner">
            <h1>Admin Dashboard</h1>
            <p>-Recycle-</p>
        </section>

    <div class="main_background">
        <div class="create_title_and_calendar">
                <h1 id="create_event_title">Create Recycle Event</h1>

                <div class="calendar_container">
                    <div class="header">
                        <button id="prevBtn">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <div class="monthYear" id="monthYear"></div>
                        <button id="nextBtn">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
    
                    <div class="days">
                        <div class="day">Sun</div>
                        <div class="day">Mon</div>
                        <div class="day">Tue</div>
                        <div class="day">Wed</div>
                        <div class="day">Thu</div>
                        <div class="day">Fri</div>
                        <div class="day">Sat</div>
                    </div>
    
                    <div class="dates" id="dates"></div>
                    
                </div>

        </div>

        <div class="create_and_delete_class">
            <button type=button id="create_button" onclick="toggleForm('create_form')">Create</button>
            <button type=button id="delete_button" onclick="toggleForm('delete_form')">Delete</button>
        </div>

        <div class="create_form">
            <form id=create_event_form action="recycle_admin.php" method="POST" enctype="multipart/form-data">
                <table id="create_table">
                    <tr>
                        <th>Date of Event:</th>
                        <td><input type="date" name="date" required></td>
                    </tr>

                    <tr>
                        <th>Name:</th>
                        <td><input type="text" name="name" placeholder="Sophia Elizabeth" required></td>
                    </tr>

                    <tr>
                        <th>Title:</th>
                        <td><input type="text" name="title" placeholder="Recycle Program" required></td>
                    </tr>

                    <tr>
                        <th>Description:</th>
                        <td><input type="text" name="description" required></td>
                    </tr>

                    <tr>
                        <th>Upload an Image:</th>
                        <td><input type="file" name="image" accept="image/*" onchange="previewImage(event)" required></td>
                    </tr>

                    <tr>
                        <td colspan="2" id="buttons_td">
                            <div class="buttons_td_class">
                                <button type="reset" id="create_reset">Reset</button>
                                <button type="submit" id="create_submit">Submit</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div>
            <div class="delete_form">
                <form id=delete_event_form>
                    <table id="delete_table">
                        <tr>
                            <th>Date of Event:</th>
                            <td><input type="date" name="date" required></td>
                        </tr>

                        <tr>
                            <th>Name:</th>
                            <td><input type="text" name="name" placeholder="Sophia Elizabeth" required></td>
                        </tr>

                        <tr>
                            <th>Title:</th>
                            <td><input type="text" name="title" placeholder="Recycle Program" required></td>
                        </tr>

                        <tr>
                            <td colspan="2" id="buttons_td">
                                <div class=buttons_td_class>
                                    <button type="reset" id="delete_reset">Reset</button>
                                    <button type="submit" id="delete_submit">Submit</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <!--Admin Database-->
        <div class="admin_database_class">
            <h1 id="database_title">Admin Database</h1>

                <div>
                <table id="admin_database_table">
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                    </tr>

                    <?php while ($row = mysqli_fetch_assoc($result1)){ ?>
                        <tr>
                            <td id="create_date"><?php echo htmlspecialchars($row['date']); ?></td>
                            <td id="create_name"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td id="create_title"><?php echo htmlspecialchars($row['title']); ?></td>
                            <td id="create_description"><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
                            <td id="create_image"><?php echo htmlspecialchars($row['image']); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            
        </div>

        <!--User Database-->
        <div class="user_database_class">
            <h1 id="database_title">User Database</h1>
            <div>
                <table id="user_database_table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                        <th>Address</th>
                    </tr>

                    <?php while ($row = mysqli_fetch_assoc($result2)){ ?>
                        <tr>
                            <td id="join_name"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td id="join_email"><?php echo htmlspecialchars($row['email']); ?></td>
                            <td id="join_phone"><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td id="join_age"><?php echo htmlspecialchars($row['age']); ?></td>
                            <td id="join_address"><?php echo htmlspecialchars($row['address']); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        
    </div>

    <script src="calendar.js"></script>
    <script src="popup.js"></script>
    <script src="button.js"></script>

</body>
</html>
