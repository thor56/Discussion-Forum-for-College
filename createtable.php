<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "theforum";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "";

if (mysqli_query($conn, $sql)) {
    echo "Table ______ created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>