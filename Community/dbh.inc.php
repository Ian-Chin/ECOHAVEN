<?php

$conn = mysqli_connect('localhost', 'root', '', 'ecohaven');

if (!$conn){
    die("connection failed: ".mysqli_connect_error());
}