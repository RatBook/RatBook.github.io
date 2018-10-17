<?php
$servername = "den1.mysql1.gear.host";
$username = "ratbook";
$password = "Uf7Sz93CJ5!!";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>