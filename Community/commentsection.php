<?php
// group 1
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
        $userID = $row['uid'];
        $sql2 = "SELECT * FROM users WHERE userID='$userID'";
        $result2 = $conn->query($sql);
        if($row2 = $result2->fetch_assoc()){
            echo "<div class='comment'><p>";
            echo $row2['uid']."<br>";
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


// group 2
function setComments2($conn) {
    if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        // Check if comment already exists
        $sql = "SELECT * FROM comments2 WHERE uid='$uid' AND date='$date' AND message='$message'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) { 
            $sql = "INSERT INTO comments2 (uid, date, message) VALUES ('$uid', '$date', '$message')";
            $conn->query($sql);
        }

        // Redirect to prevent duplicate insertion on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

function getComments2($conn) {
    $sql = "SELECT * FROM comments2 ORDER BY date DESC"; // Sort latest comments first
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='comment'><p>";
        echo $row['uid']."<br>";
        echo $row['date']."<br>";
        echo nl2br($row['message']);
        echo "</p>
            <form class='delete-form' method='POST' action='".deleteComments2($conn)."'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                <button type='submit' name='commentDelete'>Delete</button>
            </form>
            <form class='edit-form' method='POST' action='editcomment2.php'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                <input type='hidden' name='uid' value='".$row['uid']."'>
                <input type='hidden' name='date' value='".$row['date']."'>
                <input type='hidden' name='message' value='".$row['message']."'>
                <button>Edit</button>
            </form>
        </div>";
    }
}

function editComments2($conn) {
    if (isset($_POST['commentSubmit'])) {
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $sql = "UPDATE comments2 SET message='$message' WHERE cid='$cid'";
        $result = $conn->query($sql);

        header("Location: community2.php" );
    }
}

function deleteComments2($conn) {
    if (isset($_POST['commentDelete'])) {
        $cid = $_POST['cid'];
        
        $sql = "DELETE FROM comments2 WHERE cid='$cid'";
        $result = $conn->query($sql);
        header("Location: community2.php" );
    }
}


// group 3
function setComments3($conn) {
    if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        // Check if comment already exists
        $sql = "SELECT * FROM comments3 WHERE uid='$uid' AND date='$date' AND message='$message'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) { 
            $sql = "INSERT INTO comments3 (uid, date, message) VALUES ('$uid', '$date', '$message')";
            $conn->query($sql);
        }

        // Redirect to prevent duplicate insertion on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

function getComments3($conn) {
    $sql = "SELECT * FROM comments3 ORDER BY date DESC"; // Sort latest comments first
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='comment'><p>";
        echo $row['uid']."<br>";
        echo $row['date']."<br>";
        echo nl2br($row['message']);
        echo "</p>
            <form class='delete-form' method='POST' action='".deleteComments3($conn)."'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                <button type='submit' name='commentDelete'>Delete</button>
            </form>
            <form class='edit-form' method='POST' action='editcomment3.php'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                <input type='hidden' name='uid' value='".$row['uid']."'>
                <input type='hidden' name='date' value='".$row['date']."'>
                <input type='hidden' name='message' value='".$row['message']."'>
                <button>Edit</button>
            </form>
        </div>";
    }
}

function editComments3($conn) {
    if (isset($_POST['commentSubmit'])) {
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $sql = "UPDATE comments3 SET message='$message' WHERE cid='$cid'";
        $result = $conn->query($sql);

        header("Location: community3.php" );
    }
}

function deleteComments3($conn) {
    if (isset($_POST['commentDelete'])) {
        $cid = $_POST['cid'];
        
        $sql = "DELETE FROM comments3 WHERE cid='$cid'";
        $result = $conn->query($sql);
        header("Location: community3.php" );
    }
}

