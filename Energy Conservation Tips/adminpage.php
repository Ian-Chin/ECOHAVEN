<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f0f2f5;
        }

        .sidebar {
            width: 250px;
            background-color: rgb(132, 240, 177);
            color: #ecf1ed;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #035013;
        }

        .logo h2 {
            font-weight: 600;
            color: #035013;
        }

        .search-container {
            padding: 15px;
            position: relative;
            border-bottom: 1px solid #035013;
        }

        .search-container input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border: none;
            border-radius: 4px;
            background-color: #fafae9;
            color: #000000;
        }

        .search-container input::placeholder {
            color: #95a5a6;
        }

        .search-container i {
            position: absolute;
            left: 25px;
            top: 24px;
            color: #000000;
        }

        .menu-section {
            padding: 15px 0;
        }

        .menu-section h3 {
            padding: 0 20px 10px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #035013;
        }

        .menu-items {
            list-style: none;
        }

        .menu-items li {
            margin-bottom: 5px;
        }

        .menu-items a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            text-decoration: none;
            color: #000000;
            transition: all 0.3s;
        }

        .menu-items a:hover,
        .menu-items a.active {
            background-color: #1eb65df5;
            border-left: 4px solid #015e09;
        }

        .menu-items a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .admin-main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background-color: rgb(214, 236, 214);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .content-header h1 {
            color: #00461d;
            font-size: 24px;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .admin-card {
            background-color: #fafae9;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .admin-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .admin-card-header h2 {
            font-size: 18px;
            color: #2c3e50;
        }

        .admin-card-header .btn {
            padding: 8px 15px;
            background-color: #036423;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th,
        .user-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background-color: #036423;
            color: white;
        }

        .user-table tr:hover {
            background-color: #f5f5f5;
        }

        .status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
        }

        .active {
            background-color: #e1f5fe;
            color: #027418;
        }

        .inactive {
            background-color: #ffebee;
            color: #f44336;
        }

        .action-icons {
            display: flex;
            gap: 10px;
        }

        .action-icons a {
            color: #2c3e50;
            text-decoration: none;
        }
        
        .actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .edit-btn {
            color: #036423; /* Green color matching your theme */
        }

        .delete-btn {
            color: #d32f2f; /* Red color for delete */
        }

        .action-btn:hover {
            background-color: #f0f0f0;
        }

        .fa-edit, .fa-trash {
            font-size: 16px;
        }
        /* Additional sections styling */
        .tips-list,
        .swap-list,
        .program-list {
            list-style: none;
        }

        .tips-list li,
        .swap-list li,
        .program-list li {
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fafae9;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
        }

        .tips-list li:hover,
        .swap-list li:hover,
        .program-list li:hover {
            background-color: #e3f2fd;
        }

        .swap-list .swap-item {
            display: flex;
            align-items: center;
        }

        .swap-list .swap-item img {
            width: 50px;
            height: 50px;
            border-radius: 4px;
            margin-right: 15px;
            object-fit: cover;
        }

        .program-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .status-active {
            background-color: #99eb9e;
            color: #388e3c;
        }

        .status-pending {
            background-color: #fff7db;
            color: #ffa000;
        }

        /* Tab system */
        .tab-container {
            display: none;
            background-color:rgb(214, 236, 214);
        }

        .tab-container.active {
            display: block;
        }

        .admin-comment-section {
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }

        .admin-comment-section h3 {
            font-size: 16px;
            color: #179e4f;
            margin-bottom: 15px;
            padding-left: 10px;
            border-left: 3px solid #179e4f;
        }

        .admin-comments-container {
            margin-bottom: 15px;
        }

        .admin-comment {
            background-color: #fafae9;
            box-shadow: 0 8px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .admin-comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .admin-comment-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .admin-comment-user-info {
            display: flex;
            flex-direction: column;
        }

        .admin-comment-user-info h4 {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .admin-comment-date {
            font-size: 12px;
            color: #888;
        }

        .admin-comment-text {
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .admin-comment-actions {
            display: flex;
            gap: 15px;
        }

        .admin-comment-actions a {
            font-size: 12px;
            color: #666;
            text-decoration: none;
        }

        .admin-comment-actions a:hover {
            color: #179e4f;
        }

        /* Add comment form styling */
        .admin-add-comment-section {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        .admin-add-comment-section h3 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #179e4f;
        }

        .admin-comment-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .admin-form-control {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .admin-comment-form .btn {
            align-self: flex-end;
            padding: 8px 15px;
            background-color: #036423;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .main_background {
            padding: 20px;
        }

        .create_title_and_calendar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        #create_event_title {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .calendar_container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 300px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header button {
            background-color: #036423;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .monthYear {
            font-weight: bold;
            color: #2c3e50;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            margin-bottom: 10px;
        }

        .day {
            text-align: center;
            font-weight: bold;
            color: #666;
            padding: 5px;
        }

        .dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .create_class {
            margin-bottom: 20px;
        }

        #create_button {
            background-color: #036423;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
        }

        .create_form {
            background-color: #fafae9;
            border-radius: 8px;
            box-shadow: 0 5px 5px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        #create_table {
            width: 100%;
            border-collapse: collapse;
        }

        #create_table th {
            text-align: left;
            padding: 10px;
            width: 25%;
            vertical-align: top;
        }

        #create_table td {
            padding: 10px;
            width: 75%;
        }

        #create_table input[type="text"],
        #create_table input[type="date"],
        #create_table textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        #create_table textarea {
            resize: vertical;
            min-height: 100px;
        }

        .buttons_td_class {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        #create_reset,
        #create_submit {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #create_reset {
            background-color: #f8f9fa;
            color: #2c3e50;
            border: 1px solid #ddd;
        }

        #create_submit {
            background-color: #036423;
            color: white;
        }

        #database_title {
            color: #2c3e50;
            margin: 30px 0 20px;
        }

        #admin_database_table,
        #user_database_table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fafae9;
            border-radius: 8px;
            box-shadow: 0 5px 4px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        #admin_database_table th,
        #user_database_table th {
            background-color: #036423;
            color: #ffffff;
            padding: 12px 15px;
            text-align: left;
        }

        #admin_database_table td,
        #user_database_table td {
            padding: 12px 15px;
            border-top: 1px solid #eee;
        }

        #create_image img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 4px;
        }

        #edit_icon,
        #delete_icon {
            width: 24px;
            height: 24px;
            margin: 0 5px;
            cursor: pointer;
        }

        .dashboard-stats-boxes {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-box {
            background-color: #fafae9;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 30px;
            display: flex;
            align-items: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 65px;
            height: 65px;
            background-color: #e1f5e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }

        .stat-icon i {
            font-size: 32px;
            color: #036423;
        }

        .stat-content h3 {
            font-size: 16px;
            color: #666;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .stat-info {
            font-size: 14px;
            color: #95a5a6;
        }

        /* Activity Feed Styles */
        .activity-feed {
            padding: 10px 0;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            background-color: #e1f5e1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .activity-icon i {
            font-size: 16px;
            color: #036423;
        }

        .activity-content {
            flex: 1;
        }

        .activity-content p {
            margin-bottom: 3px;
            color: #2c3e50;
        }

        .activity-time {
            font-size: 12px;
            color: #95a5a6;
        }

        /* Add a quick stats summary row at the very top of the dashboard */
        .quick-stats-summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
        }

        .quick-stat-item {
            text-align: center;
        }

        .quick-stat-item h4 {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }

        .quick-stat-item p {
            font-size: 18px;
            font-weight: bold;
            color: #036423;
            margin: 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Sidebar Menu -->
    <aside class="sidebar">
        <div class="logo">
            <h2>EcoAdmin</h2>
        </div>
        <div class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search...">
        </div>
        <div class="menu-section">
            <h3>Main Menu</h3>
            <ul class="menu-items">
                <li><a href="#" class="active" onclick="showTab('dashboard')"><img src="pictures/dashboard.ico">&nbsp
                        Dashboard</a></li>
                <li><a href="#" onclick="showTab('user-management')"><img src="pictures/userdetails.ico">&nbsp User
                        Management</a></li>
                <li><a href="#" onclick="showTab('product-swap')"><img src="pictures/transfer.ico">&nbsp Product
                        Swap</a></li>
                <li><a href="#" onclick="showTab('conservation-tips')"><img src="pictures/tips.ico">&nbsp Conservation
                        Tips</a></li>
                <li><a href="#" onclick="showTab('recycle-program')"><img src="pictures/recycle.ico">&nbsp Recycling
                        Program</a></li>
                <li><a href="#" onclick="showTab('community-program')"><img src="pictures/leaf.ico"> &nbsp Community
                        Program</a></li>
            </ul>
        </div>
        <div class="menu-section">
            <h3>Settings</h3>
            <ul class="menu-items">
                <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-main-content">
        <div class="content-header">
            <h1>Admin Dashboard</h1>
            <div class="user-profile">
                <span>Admin User</span>
            </div>
        </div>

        <!-- Dashboard Tab -->
        <div id="dashboard" class="tab-container active">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Dashboard Overview</h2>
                </div>
                <div class="dashboard-stats">
                    <p>Welcome to the EcoAdmin dashboard. Use the sidebar to navigate to different sections.</p>
                </div>
            </div>
            <div class="dashboard-stats-boxes">
                <div class="stat-box">
                    <div class="stat-icon">
                        <img src="pictures/userdetails.ico" alt="User Icon">
                    </div>
                    <div class="stat-content">
                        <h3>Total Users</h3>
                        <p class="stat-number">24</p>
                        <p class="stat-info">5 new this week</p>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">
                        <img src="pictures/recycle.ico" alt="User Icon">
                    </div>
                    <div class="stat-content">
                        <h3>Recycle Events</h3>
                        <p class="stat-number">12</p>
                        <p class="stat-info">2 upcoming events</p>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">
                        <img src="pictures/leaf.ico" alt="User Icon">
                    </div>
                    <div class="stat-content">
                        <h3>Garden Groups</h3>
                        <p class="stat-number">3</p>
                        <p class="stat-info">2 active, 1 pending</p>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon">
                        <img src="pictures/transfer.ico" alt="User Icon">
                    </div>
                    <div class="stat-content">
                        <h3>Product Swaps</h3>
                        <p class="stat-number">18</p>
                        <p class="stat-info">3 added this month</p>
                    </div>
                </div>
            </div>

            <!-- Add this new section with recent activity -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Recent Activity</h2>
                </div>
                <div class="activity-feed">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>New User:</strong> David Wilson joined</p>
                            <span class="activity-time">Today, 10:45 AM</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-comment"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>New Comment:</strong> Emily Chen commented on "Grow Together with Our Community
                                Garden"</p>
                            <span class="activity-time">Yesterday, 4:30 PM</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>New Event:</strong> "Electronics Recycling" scheduled for Feb 22, 2025</p>
                            <span class="activity-time">Feb 19, 2025</span>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>New Tip:</strong> "Reducing Plastic Waste" has been added</p>
                            <span class="activity-time">Feb 18, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management Tab -->
        <div id="user-management" class="tab-container">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>User Management</h2>
                </div>
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th style='text-align: center;'>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Include database connection
                        require_once 'dbh.inc.php';
                        
                        // Query to select all users
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['uid']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['pwd']) ."</td>"; 
                                
                                // Check if role column exists, otherwise use a default
                                $role = isset($row['role']) ? htmlspecialchars($row['role']) : "User";
                                echo "<td>" . $role . "</td>";
                                
                                // Check if status column exists, otherwise use a default
                                $status = isset($row['status']) ? htmlspecialchars($row['status']) : "Active";
                                echo "<td><span class='status-badge status-active'>" . $status . "</span></td>";
                                
                                // Updated tools column with center alignment and styled icons
                                echo "<td style='text-align: center;'>
                                        <a href='#' class='tool-icon edit' data-id='" . $row['userID'] . "'><img src='pictures/pencil.ico'></a>
                                        <a href='#' class='tool-icon delete' data-id='" . $row['userID'] . "'><img src='pictures/trash.ico'></a>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='no-data'>No users found</td></tr>";
                        }
                        
                        // Close connection
                        mysqli_close($conn);
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Product Swap Tab -->   
        <div id="product-swap" class="tab-container">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Product Swap</h2>
                    <button class="btn"><i class="fas fa-plus"></i> Add New Swap</button>
                </div>
                <ul class="swap-list">
                    <!-- <li>
                        <div class="swap-item">
                            <img src="/api/placeholder/50/50" alt="Plastic Bottle">
                            <div>
                                <h3>Plastic Bottles → Reusable Water Bottles</h3>
                                <p>Encourage users to switch to reusable bottles.</p>
                            </div>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li>
                    <li>
                        <div class="swap-item">
                            <img src="/api/placeholder/50/50" alt="Paper Towels">
                            <div>
                                <h3>Paper Towels → Cloth Towels</h3>
                                <p>Benefits of switching to reusable cloth towels.</p>
                            </div>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li>
                    <li>
                        <div class="swap-item">
                            <img src="/api/placeholder/50/50" alt="Plastic Bags">
                            <div>
                                <h3>Plastic Bags → Reusable Bags</h3>
                                <p>Information on reusable shopping bags.</p>
                            </div>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>

        <!-- Conservation Tips Tab -->
        <div id="conservation-tips" class="tab-container">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Conservation Tips</h2>
                    <button class="btn">+ Add New Tip</button>
                </div>
                <ul class="tips-list">
                    <!-- <li>
                        <div>
                            <h3>Reducing Water Usage</h3>
                            <p>Tips for conserving water in daily activities.</p>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>Energy Conservation at Home</h3>
                            <p>Ways to reduce electricity consumption.</p>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>Sustainable Transportation</h3>
                            <p>Eco-friendly alternatives to daily commuting.</p>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>Reducing Plastic Waste</h3>
                            <p>How to minimize plastic consumption in everyday life.</p>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>

        <!-- Recycle Program Tab -->
        <div id="recycle-program" class="tab-container">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Recycling Program Management</h2>
                </div>

                <!-- Content from first document -->
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

                    <div class="create_class">
                        <button type="button" id="create_button" onclick="toggleForm('create_form')">Create</button>
                    </div>

                    <div class="create_form">
                        <form id="create_event_form" action="recycle_admin.php" method="POST"
                            enctype="multipart/form-data">
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
                                    <td><textarea rows="7" name="description" required></textarea></td>
                                </tr>

                                <tr>
                                    <th>Upload an Image:</th>
                                    <td><input type="file" name="image" accept="image/*" onchange="previewImage(event)"
                                            required></td>
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
                                    <th>Modify</th>
                                </tr>

                                <!-- Example data rows (would be populated by PHP in production) -->
                                <tr>
                                    <td id="create_date">2025-02-10</td>
                                    <td id="create_name">Emma Johnson</td>
                                    <td id="create_title">Community Cleanup</td>
                                    <td id="create_description">Join us for a community cleanup day at Central Park.
                                        Bring gloves and comfortable shoes!</td>
                                    <td id="create_image"><img src="pictures/recycle-event-1.png" alt="Event Image"></td>
                                    <td id="modify_recycle_event">
                                        <a href="#">
                                            <img id="edit_icon" src="pictures/pencil.ico" alt="Edit">
                                        </a>
                                        <a href="#"
                                            onclick="return confirm('Are you sure you want to delete this event?');">
                                            <img id="delete_icon" src="pictures/trash.ico" alt="Delete">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="create_date">2025-02-22</td>
                                    <td id="create_name">Michael Smith</td>
                                    <td id="create_title">Electronics Recycling</td>
                                    <td id="create_description">Bring your old electronics for proper recycling. We
                                        accept computers, phones, and small appliances.</td>
                                    <td id="create_image"><img src="pictures/recycle-event-2.png" alt="Event Image"></td>
                                    <td id="modify_recycle_event">
                                        <a href="#">
                                            <img id="edit_icon" src="pictures/pencil.ico" alt="Edit">
                                        </a>
                                        <a href="#"
                                            onclick="return confirm('Are you sure you want to delete this event?');">
                                            <img id="delete_icon" src="pictures/trash.ico" alt="Delete">
                                        </a>
                                    </td>
                                </tr>
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
                                    <th>Modify</th>
                                </tr>

                                <!-- Example data rows (would be populated by PHP in production) -->
                                <tr>
                                    <td id="join_name">Sarah Parker</td>
                                    <td id="join_email">sarah.parker@example.com</td>
                                    <td id="join_phone">555-123-4567</td>
                                    <td id="join_age">32</td>
                                    <td id="join_address">123 Main St, Anytown</td>
                                    <td id="modify_recycle_event">
                                        <a href="#">
                                            <img id="edit_icon" src="pictures/pencil.ico" alt="Edit">
                                        </a>
                                        <a href="#"
                                            onclick="return confirm('Are you sure you want to delete this event?');">
                                            <img id="delete_icon" src="pictures/trash.ico" alt="Delete">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="join_name">David Wilson</td>
                                    <td id="join_email">david.wilson@example.com</td>
                                    <td id="join_phone">555-987-6543</td>
                                    <td id="join_age">45</td>
                                    <td id="join_address">456 Oak Ave, Somewhere</td>
                                    <td id="modify_recycle_event">
                                        <a href="#">
                                            <img id="edit_icon" src="pictures/pencil.ico" alt="Edit">
                                        </a>
                                        <a href="#"
                                            onclick="return confirm('Are you sure you want to delete this event?');">
                                            <img id="delete_icon" src="pictures/trash.ico" alt="Delete">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Community Program Tab -->
        <div id="community-program" class="tab-container">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Community Garden Groups</h2>
                    <button class="btn"><i class="fas fa-plus"></i> Add New Program</button>
                </div>
                <ul class="program-list">
                    <li>
                        <div>
                            <h3>Join Our Community Garden Group!</h3>
                            <p>Group Owner:- Sarah Parker</p><br>
                            <span class="program-status status-active">Active</span>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>Grow Together with Our Community Garden</h3>
                            <p>Group Owner:- James Carter</p><br>
                            <span class="program-status status-active">Active</span>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3>Be Part of Our Gardening Community!</h3>
                            <p>Group Owner:- Lila Hernandez</p><br>
                            <span class="program-status status-pending">Pending</span>
                        </div>
                        <div class="action-icons">
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </div>
                    </li>

                </ul>

            </div>
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2>Community Garden Comments</h2>
                    <button class="btn"><i class="fas fa-sync"></i> Refresh Comments</button>
                </div>

                <!-- Sarah Parker's Garden Comments -->
                <div class="admin-comment-section">
                    <h3>Comments for "Join Our Community Garden Group!"</h3>
                    <div class="admin-comments-container">
                        <div class="admin-comment">
                            <div class="admin-comment-header">
                                <img src="/api/placeholder/30/30" alt="User Avatar" class="admin-comment-avatar">
                                <div class="admin-comment-user-info">
                                    <h4>Jessica Miller</h4>
                                    <span class="admin-comment-date">Feb 24, 2025</span>
                                </div>
                            </div>
                            <p class="admin-comment-text">I'm really enjoying this community garden! The tomatoes
                                are coming along nicely.</p>
                            <div class="admin-comment-actions">
                                <a href="#"><i class="fas fa-reply"></i> Reply</a>
                                <a href="#"><i class="fas fa-flag"></i> Flag</a>
                                <a href="#"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>

                        <div class="admin-comment">
                            <div class="admin-comment-header">
                                <img src="/api/placeholder/30/30" alt="User Avatar" class="admin-comment-avatar">
                                <div class="admin-comment-user-info">
                                    <h4>Michael Johnson</h4>
                                    <span class="admin-comment-date">Feb 22, 2025</span>
                                </div>
                            </div>
                            <p class="admin-comment-text">When is the next community meetup? I'd like to bring some
                                seedlings to share.</p>
                            <div class="admin-comment-actions">
                                <a href="#"><i class="fas fa-reply"></i> Reply</a>
                                <a href="#"><i class="fas fa-flag"></i> Flag</a>
                                <a href="#"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- James Carter's Garden Comments -->
                <div class="admin-comment-section">
                    <h3>Comments for "Grow Together with Our Community Garden"</h3>
                    <div class="admin-comments-container">
                        <div class="admin-comment">
                            <div class="admin-comment-header">
                                <img src="/api/placeholder/30/30" alt="User Avatar" class="admin-comment-avatar">
                                <div class="admin-comment-user-info">
                                    <h4>Emily Chen</h4>
                                    <span class="admin-comment-date">Feb 25, 2025</span>
                                </div>
                            </div>
                            <p class="admin-comment-text">Thanks for organizing the composting workshop last
                                weekend! I learned so much.</p>
                            <div class="admin-comment-actions">
                                <a href="#"><i class="fas fa-reply"></i> Reply</a>
                                <a href="#"><i class="fas fa-flag"></i> Flag</a>
                                <a href="#"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>

                        <div class="admin-comment">
                            <div class="admin-comment-header">
                                <img src="/api/placeholder/30/30" alt="User Avatar" class="admin-comment-avatar">
                                <div class="admin-comment-user-info">
                                    <h4>David Wilson</h4>
                                    <span class="admin-comment-date">Feb 21, 2025</span>
                                </div>
                            </div>
                            <p class="admin-comment-text">Is there any way we can get more water access points in
                                the southern section? It's quite a walk from there to the current spigot.</p>
                            <div class="admin-comment-actions">
                                <a href="#"><i class="fas fa-reply"></i> Reply</a>
                                <a href="#"><i class="fas fa-flag"></i> Flag</a>
                                <a href="#"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lila Hernandez's Garden Comments -->
                <div class="admin-comment-section">
                    <h3>Comments for "Be Part of Our Gardening Community!"</h3>
                    <div class="admin-comments-container">
                        <div class="admin-comment">
                            <div class="admin-comment-header">
                                <img src="/api/placeholder/30/30" alt="User Avatar" class="admin-comment-avatar">
                                <div class="admin-comment-user-info">
                                    <h4>Alex Thompson</h4>
                                    <span class="admin-comment-date">Feb 23, 2025</span>
                                </div>
                            </div>
                            <p class="admin-comment-text">I'm interested in joining this group! When will
                                registration open?</p>
                            <div class="admin-comment-actions">
                                <a href="#"><i class="fas fa-reply"></i> Reply</a>
                                <a href="#"><i class="fas fa-flag"></i> Flag</a>
                                <a href="#"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>

                        <div class="admin-comment">
                            <div class="admin-comment-header">
                                <img src="/api/placeholder/30/30" alt="User Avatar" class="admin-comment-avatar">
                                <div class="admin-comment-user-info">
                                    <h4>Sophia Rodriguez</h4>
                                    <span class="admin-comment-date">Feb 20, 2025</span>
                                </div>
                            </div>
                            <p class="admin-comment-text">Looking forward to this new garden space! Will there be
                                plots for individual families?</p>
                            <div class="admin-comment-actions">
                                <a href="#"><i class="fas fa-reply"></i> Reply</a>
                                <a href="#"><i class="fas fa-flag"></i> Flag</a>
                                <a href="#"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/popup.js"></script>

</body>

</html>
