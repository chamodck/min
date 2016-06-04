<?php

$servername = 'localhost';//mysql.hostinger.in
$username = 'root';//u249740641_min
$password = '';//minproject
$dbname = 'project';//u249740641_min


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>