<?php

$conn = mysqli_connect("localhost", "root", "", "ecohaven");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>