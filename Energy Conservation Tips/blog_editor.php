<?php
// Include database configuration
require_once('../config/database.php');

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Get database connection
$conn = getAdminDbConnection();
if (!$conn) {
    die("Database connection failed");
}

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$admin_id = $_SESSION['admin_id'];
$success_message = 'Login successful';
$error_message = 'Login unsuccessful';

// Fetch categories from blog database
$blog_conn = getBlogDbConnection();
if (!$blog_conn) {
    die("Blog database connection failed");
}


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = $_POST['content'];
    
    // Custom read time calculation based on actual content
    $stripped_content = strip_tags($content);
    $word_count = str_word_count($stripped_content);
    $read_time = max(1, ceil($word_count / 200)); // Assuming 200 words per minute
    
    // Validate input
    if (empty($title) || empty($content) || $category_id <= 0) {
        $error_message = "Please complete all required fields.";
    } else {
        // Handle thumbnail upload with improved security
        $thumbnail = '';
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
            // Allowed file types
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $max_size = 2 * 1024 * 1024; // 2MB
            
            if (!in_array($_FILES['thumbnail']['type'], $allowed_types)) {
                $error_message = "Invalid file type. Only JPG, PNG, GIF, and WEBP images are allowed.";
            } elseif ($_FILES['thumbnail']['size'] > $max_size) {
                $error_message = "File size too large. Maximum size is 2MB.";
            } else {
                $upload_dir = '../uploads/';
                
                // Create directory if it doesn't exist
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // Generate a secure filename
                $file_extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                $file_name = uniqid('thumbnail_') . '.' . $file_extension;
                $target_file = $upload_dir . $file_name;
                
                // Move the uploaded file
                if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file)) {
                    $thumbnail = 'uploads/' . $file_name;
                } else {
                    $error_message = "Failed to upload thumbnail.";
                }
            }
        } elseif ($post_id > 0) {
            // Keep existing thumbnail if editing
            $get_thumbnail_sql = "SELECT thumbnail FROM posts WHERE id = ?";
            $get_thumbnail_stmt = $blog_conn->prepare($get_thumbnail_sql);
            $get_thumbnail_stmt->bind_param("i", $post_id);
            $get_thumbnail_stmt->execute();
            $get_thumbnail_result = $get_thumbnail_stmt->get_result();
            $existing_post = $get_thumbnail_result->fetch_assoc();
            $thumbnail = $existing_post['thumbnail'];
        }
        
        // If no errors, proceed with database operation
        if (empty($error_message)) {
            if ($post_id > 0) {
                // Update existing post
                $sql = "UPDATE posts SET 
                        post_id = ?,
                        title = ?, 
                        short_description = ?,
                        content = ?, 
                        thumbnail_url = ?,
                        date_created = ?, 
                        date_updated = ?, 
                        modified_date = NOW() 
                        " . (!empty($thumbnail) ? ", thumbnail = ?" : "") . "
                        WHERE id = ? AND admin_id = ?";
                
                if (!empty($thumbnail)) {
                    $stmt = $blog_conn->prepare($sql);
                    $stmt->bind_param("issssssi", $post_id, $title, $short_description, $content, $thumbnail_url, $date_created, $date_updated, $like_count);
                } else {
                    $stmt = $blog_conn->prepare($sql);
                    $stmt->bind_param("issssssi", $post_id, $title, $short_description, $content, $thumbnail_url, $date_created, $date_updated, $like_count);
                }
                
                if ($stmt->execute()) {
                    $success_message = "Post updated successfully!";
                } else {
                    $error_message = "Error updating post: " . $stmt->error;
                }
            } else {
                // Insert new post
                $sql = "INSERT INTO blogpost_tips (post_id, title, short_description, content, thumbnail_url, date_created, date_updated, like_count) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $blog_conn->prepare($sql);
                $stmt->bind_param("ssiiss", $post_id, $title, $short_description, $content, $thumbnail_url, $date_created, $date_updated, $like_count);
                
                if ($stmt->execute()) {
                    $post_id = $stmt->insert_id;
                    $success_message = "Post created successfully!";
                } else {
                    $error_message = "Error creating post: " . $stmt->error;
                }
            }
        }
    }
}

// Fetch post data if editing
$post = null;
if ($post_id > 0) {
    $post_sql = "SELECT * FROM posts WHERE post_id = ?";
    $post_stmt = $blog_conn->prepare($post_sql);
    $post_stmt->bind_param("i", $post_id,);
    $post_stmt->execute();
    $post_result = $post_stmt->get_result();
    
    if ($post_result->num_rows > 0) {
        $post = $post_result->fetch_assoc();
    } else {
        // Post not found or doesn't belong to this admin
        header("Location: posts.php");
        exit();
    }
}
?>