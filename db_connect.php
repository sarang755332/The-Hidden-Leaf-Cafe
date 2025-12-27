<?php
// Database connection details
// IMPORTANT: Replace with your actual database credentials
$servername = "localhost"; // Usually 'localhost'
$username = "root";     // Your database username (e.g., 'root' for XAMPP/WAMP)
$password = "";         // Your database password (empty for 'root' on XAMPP/WAMP by default)
$dbname = "cafe";       // The name of your database (which contains 'reservation' and 'users' tables)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // For development, display the error.
    // In production, you might want to log this and show a generic error message.
    die("Connection failed: " . $conn->connect_error);
}
?>