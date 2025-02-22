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
    <title>Product Swap Admin</title>
    <link rel="stylesheet" href="ps_admin.css">
    <link rel="stylesheer" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Swap Admin</title>
    <link rel="stylesheet" href="r.css">
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
            <h1>Admin Dashboard</h1>
            <p>-Product Swap-</p>
        </section>

    <div class="main_background">
        
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

</body>
</html>