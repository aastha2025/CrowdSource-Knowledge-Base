<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crowdsource_database"; // Change to your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname , 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
