<?php
function setComments($conn) {
    if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        // Check if comment already exists
        $sql = "SELECT * FROM comments WHERE uid='$uid' AND date='$date' AND message='$message'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) { 
            $sql = "INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";
            $conn->query($sql);
        }

        // Redirect to prevent duplicate insertion on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

function getComments($conn) {
    $sql = "SELECT * FROM comments ORDER BY date DESC"; // Sort latest comments first
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='comment'><p>";
        echo $row['uid']."<br>";
        echo $row['date']."<br>";
        echo nl2br($row['message']);
        echo "</p>
            <form class='delete-form' method='POST' action='".deleteComments($conn)."'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                <button type='submit' name='commentDelete'>Delete</button>
            </form>
            <form class='edit-form' method='POST' action='editcomment.php'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                <input type='hidden' name='uid' value='".$row['uid']."'>
                <input type='hidden' name='date' value='".$row['date']."'>
                <input type='hidden' name='message' value='".$row['message']."'>
                <button>Edit</button>
            </form>
        </div>";
    }
}

function editComments($conn) {
    if (isset($_POST['commentSubmit'])) {
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $sql = "UPDATE comments SET message='$message' WHERE cid='$cid'";
        $result = $conn->query($sql);

        header("Location: community.php" );
    }
}

function deleteComments($conn) {
    if (isset($_POST['commentDelete'])) {
        $cid = $_POST['cid'];
        
        $sql = "DELETE FROM comments WHERE cid='$cid'";
        $result = $conn->query($sql);
        header("Location: community.php" );
    }
}

