<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "indian_premium";

// Create connection
$con = new mysqli($server, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    
}
?>
