<?php

$conn = mysqli_connect('localhost', 'root', '', 'commentsection');

if (!$conn){
    die("connection failed: ".mysqli_connect_error());
}