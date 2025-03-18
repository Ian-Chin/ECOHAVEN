<?php

function getLogin($conn) {
    if (isset($_POST['loginSubmit'])) {
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];

        $sql = "SELECT * FROM users WHERE uid = '$uid' OR pwd = '$pwd'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            if ($row = $result->fetch_assoc()) {
                $_SESSION['userID'] = $row['userID']; 
                $_SESSION['uid'] = $row['uid'];
                header("Location: Mainmenu.php?loginsucess");
                exit();
            }
        } else {
            header("Location: login.php?loginfailed");
            exit();
        }
    }
}

function userLogout(){
    if (isset($_POST['logoutSubmit'])) {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
